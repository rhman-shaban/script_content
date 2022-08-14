@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',51)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.listing-category.create') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('id',362)->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',363)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',92)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',91)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',287)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',121)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',135)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->slug }}</td>
                            <td><i class="{{ $item->icon }}"></i></td>
                            <td><img src="{{ $item->image ? url($item->image) : '' }}" alt="listing category image" class="cat_img_w"></td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="listingCategoryStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="listingCategoryStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.listing-category.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit    "></i></a>

                                @php
                                    $isCategory=$listings->where('listing_category_id',$item->id)->count();
                                @endphp
                                @if ($isCategory==0)
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>
                                @endif




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
            $("#deleteForm").attr("action",'{{ url("admin/listing-category/") }}'+"/"+id)
        }

        function listingCategoryStatus(id){
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
                url:"{{url('/admin/listing-category-status/')}}"+"/"+id,
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
