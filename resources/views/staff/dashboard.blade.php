@extends('layouts.staff.layout')
@section('title')
<title>{{ $websiteLang->where('id',68)->first()->custom_text }}</title>
@endsection
@section('staff-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ $websiteLang->where('id',68)->first()->custom_text }}</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',370)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th width="5%">{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('id',90)->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('id',125)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',92)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',372)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',135)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listings as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->location->location }}</td>
                            <td>{{ $item->listingCategory->name }}</td>
                            <td>
                                <a href="{{ route('staff.listing.image',$item->id) }}">{{ $websiteLang->where('id',373)->first()->custom_text }}</a><br>
                                <a href="{{ route('staff.listing.video',$item->id) }}">{{ $websiteLang->where('id',374)->first()->custom_text }}</a><br>
                                <a href="{{ route('staff.listing.schedule',$item->id) }}">{{ $websiteLang->where('id',375)->first()->custom_text }}</a>
                            </td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="listingStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="listingStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="{{ route('staff.listing.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit    "></i></a>
                                <a target="_blank" href="{{ route('listing.show',$item->slug) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>



                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("staff/listing/") }}'+"/"+id)
        }

        function listingStatus(id){

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
                url:"{{url('/staff/listing-status/')}}"+"/"+id,
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
