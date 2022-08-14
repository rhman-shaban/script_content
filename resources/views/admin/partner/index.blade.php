@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',282)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="#" data-toggle="modal" data-target="#createFeature" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('id',301)->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',302)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('id',121)->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('id',303)->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('id',135)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partners as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td><img class="cat_img_w" src="{{ url($item->image) }}" alt="blog image"></td>
                            <td><a href="{{ $item->link }}">{{ $item->link }}</a></td>

                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="partnerStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="partnerStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#updateFeature-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit  "></i></a>
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>


                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- create feature Modal -->
    <div class="modal fade" id="createFeature" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $websiteLang->where('id',304)->first()->custom_text }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">

                    <form action="{{ route('admin.partner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="image"> {{ $websiteLang->where('id',121)->first()->custom_text }}</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                    <div class="form-group">
                        <label for="link">{{ $websiteLang->where('id',303)->first()->custom_text }}</label>
                        <input type="text" name="link" class="form-control" id="link" value="{{ old('link') }}">
                    </div>

                    <div class="form-group">
                        <label for="status">{{ $websiteLang->where('id',135)->first()->custom_text }}</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">{{ $websiteLang->where('id',140)->first()->custom_text }}</option>
                            <option value="0">{{ $websiteLang->where('id',141)->first()->custom_text }}</option>
                        </select>
                    </div>


                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('id',7)->first()->custom_text }}</button>
                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',117)->first()->custom_text }}</button>
                    </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- create feature Modal -->
    @foreach ($partners as $item)
        <div class="modal fade" id="updateFeature-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">{{ $websiteLang->where('id',304)->first()->custom_text }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <form action="{{ route('admin.partner.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="image">{{ $websiteLang->where('id',126)->first()->custom_text }}</label>
                                    <div class="my-2">
                                        <img src="{{ url($item->image) }}" alt="partner image" class="cat_img_w">
                                    </div>
                                    <label for="image">{{ $websiteLang->where('id',121)->first()->custom_text }}</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>

                                <div class="form-group">
                                    <label for="link">{{ $websiteLang->where('id',303)->first()->custom_text }}</label>
                                    <input type="text" name="link" class="form-control" id="link" value="{{ $item->link }}">
                                </div>

                            <div class="form-group">
                                <label for="status">{{ $websiteLang->where('id',135)->first()->custom_text }}</label>
                                <select name="status" id="status" class="form-control">
                                    <option {{ $item->status==1 ? 'selected' : '' }} value="1">{{ $websiteLang->where('id',140)->first()->custom_text }}</option>
                                    <option {{ $item->status==0 ? 'selected' : '' }} value="0">{{ $websiteLang->where('id',141)->first()->custom_text }}</option>
                                </select>
                            </div>


                                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('id',7)->first()->custom_text }}</button>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach



    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/partner/") }}'+"/"+id)
        }

        function partnerStatus(id){

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
                url:"{{url('/admin/partner-status/')}}"+"/"+id,
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
