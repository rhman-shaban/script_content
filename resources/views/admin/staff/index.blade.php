@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',324)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.create-staff') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('id',325)->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',328)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('id',37)->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('id',38)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',121)->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('id',326)->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('id',135)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffs as $index => $staff)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $staff->name }}</td>
                            <td>{{ $staff->email }}</td>
                            <td> <img src="{{  $staff->image ? asset( $staff->image) : ''}}" alt="" class="blog_img_width"> </td>
                            <td>
                                @php
                                    $author=$admins->where('id',$staff->author_id)->first();
                                @endphp
                                {{ $author->name }}
                            </td>


                            <td>
                                @if ($staff->status==1)
                                <a href="" onclick="featureStatus({{ $staff->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="featureStatus({{ $staff->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>


                                <a data-toggle="modal" data-target="#staffDelete-{{ $staff->id }}" href="javascript:;" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>


                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @foreach ($staffs as $staff)
    <!-- Modal -->
    <div class="modal fade" id="staffDelete-{{ $staff->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <h4>Are You sure want to delete this item ?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="{{ route('admin.delete-staff',$staff->id) }}" class="btn btn-primary">Delete</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach



    <script>

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
                url:"{{url('/admin/staff-status/')}}"+"/"+id,
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
