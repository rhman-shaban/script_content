@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',51)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.listing-category.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('id',364)->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',365)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.listing-category.update',$listingCategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="name">{{ $websiteLang->where('id',37)->first()->custom_text }}</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $listingCategory->name }}">
                        </div>
                        <div class="form-group">
                            <label for="slug">{{ $websiteLang->where('id',91)->first()->custom_text }}</label>
                            <input type="text" name="slug" class="form-control" id="slug" value="{{ $listingCategory->slug }}">
                        </div>


                        <div class="form-group">
                            <label for="icon">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                            <input type="text" name="icon" class="form-control custom-icon-picker" id="icon" value="{{ $listingCategory->icon }}">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div> <p>{{ $websiteLang->where('id',126)->first()->custom_text }}:</p> </div>
                                <div class="my-2">
                                    <img src="{{ $listingCategory->image ?  url($listingCategory->image) : '' }}" class="custom_img_width" alt="old image">
                                </div>
                                <div class="form-group">
                                    <label for="image">{{ $websiteLang->where('id',121)->first()->custom_text }}</label>
                                    <input type="file" name="image" id="image" class="form-control-file">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">{{ $websiteLang->where('id',135)->first()->custom_text }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $listingCategory->status==1 ? 'selected' : '' }} value="1">{{ $websiteLang->where('id',140)->first()->custom_text }}</option>
                                        <option {{ $listingCategory->status==0 ? 'selected' : '' }}  value="0">{{ $websiteLang->where('id',141)->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $("#name").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })
        });

        })(jQuery);

        function convertToSlug(Text)
            {
                return Text
                    .toLowerCase()
                    .replace(/[^\w ]+/g,'')
                    .replace(/ +/g,'-');
            }
    </script>

@endsection
