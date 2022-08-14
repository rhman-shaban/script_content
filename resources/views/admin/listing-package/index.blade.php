@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',86)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.listing-package.create') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('id',336)->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',337)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('id',343)->first()->custom_text }}</th>
                            <th width="30%">{{ $websiteLang->where('id',338)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',344)->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('id',135)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $index => $package)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $package->package_name }}</td>
                            <td>{{ $package->package_type == 1 ? 'Paid' : 'Free' }}</td>
                            <td>{{ $currency->currency_icon }}{{ $package->price }}</td>
                            <td>
                                @if ($package->status==1)
                                <a href="" onclick="featureStatus({{ $package->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="featureStatus({{ $package->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.listing-package.edit',$package->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit  "></i></a>

                                <a href="javascript:;" data-toggle="modal" data-target="#packageId-{{ $package->id }}" class="btn btn-success btn-sm"><i class="fas fa-eye" aria-hidden="true"></i></a>

                                @php
                                    $isPackage=$orders->where('listing_package_id',$package->id)->count();
                                @endphp

                                @if ($isPackage==0)
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $package->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                @endif


                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($packages as $item)
    <!-- Modal -->
    <div class="modal fade" id="packageId-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $websiteLang->where('id',417)->first()->custom_text }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <table class="table table-bordered">
                            <tr>
                                <td>{{ $websiteLang->where('id',338)->first()->custom_text }}</td>
                                <td>{{ $item->package_type==1 ? 'Paid' : 'Free' }}</td>
                            </tr>
                            <tr>
                                <td>{{ $websiteLang->where('id',343)->first()->custom_text }}</td>
                                <td>{{ $item->package_name }}</td>
                            </tr>
                            <tr>
                                <td>{{ $websiteLang->where('id',344)->first()->custom_text }}</td>
                                <td>{{ $currency->currency_icon }}{{ $item->price }}</td>
                            </tr>
                            <tr>
                                <td>{{ $websiteLang->where('id',345)->first()->custom_text }}</td>
                                <td>{{ $item->number_of_days }}</td>
                            </tr>
                            <tr>
                                <td>{{ $websiteLang->where('id',346)->first()->custom_text }}</td>
                                <td>{{ $item->number_of_aminities }}</td>
                            </tr>
                            <tr>
                                <td>{{ $websiteLang->where('id',347)->first()->custom_text }}</td>
                                <td>{{ $item->number_of_photo }}</td>
                            </tr>
                            <tr>
                                <td>{{ $websiteLang->where('id',348)->first()->custom_text }}</td>
                                <td>{{ $item->number_of_video }}</td>
                            </tr>
                            <tr>
                                <td>{{ $websiteLang->where('id',349)->first()->custom_text }}</td>
                                <td>{{ $item->number_of_listing }}</td>
                            </tr>



                            <tr>
                                <td>{{ $websiteLang->where('id',350)->first()->custom_text }}</td>
                                <td>{{ $item->is_featured ==1 ? $websiteLang->where('id',123)->first()->custom_text : $websiteLang->where('id',124)->first()->custom_text }}</td>
                            </tr>

                            <tr>
                                <td>{{ $websiteLang->where('id',351)->first()->custom_text }}</td>
                                <td>{{ $item->number_of_feature_listing }}</td>
                            </tr>
                            <tr>
                                <td>{{ $websiteLang->where('id',135)->first()->custom_text }}</td>
                                <td>
                                    @if ($item->status==1)
                                    <span class="badge badge-success">{{ $websiteLang->where('id',140)->first()->custom_text }}</span>
                                    @else
                                    <span class="badge badge-danger">{{ $websiteLang->where('id',141)->first()->custom_text }}</span>
                                    @endif

                            </tr>


                        </table>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">{{ $websiteLang->where('id',7)->first()->custom_text }}</button>
                </div>

            </div>
        </div>
    </div>

    @endforeach


    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/listing-package/") }}'+"/"+id)
        }

        function featureStatus(id){
            // project demo mode check
         var isDemo="{{ env('PROJECT_MODE') }}"
         var demoNotify="{{ env('NOTIFY_TEXT') }}"
         if(isDemo==0){
             toastr.error(demoNotify);
             return;
         }
         // end

            $.ajax({
                type:"get",
                url:"{{url('/admin/listing-package-status/')}}"+"/"+id,
                success:function(response){
                   toastr.success(response)
                },
                error:function(err){
                    console.log(err);

                }
            })
        }
    </script>
@endsection
