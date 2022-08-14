@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',381)->first()->custom_text }}</title>
@endsection

@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.my.listing') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('id',368)->first()->custom_text }} </a></h1>
    <div class="row">
        <div class="col-md-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',97)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.listing.new.logo') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',128)->first()->custom_text }}</label>
                            <div class="listing-logo">
                                <img src="{{ $listing->logo ? asset($listing->logo) : '' }}" alt="listing logo">
                            </div>

                            <label for="logo" class="mt-2">{{ $websiteLang->where('id',97)->first()->custom_text }}</label>
                            <input required type="file" name="logo" id="logo" class="form-control-file">
                            <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        </div>
                        <button class="btn btn-success" type="submit">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                    </form>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',98)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.listing.new.thumbnail') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',129)->first()->custom_text }}</label>
                            <div>
                                <img src="{{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }}" alt="listing logo" class="cat_img_w">

                            </div>

                            <label for="thumbnail_image" class="mt-2">{{ $websiteLang->where('id',98)->first()->custom_text }}</label>
                            <input required type="file" name="thumbnail_image" id="thumbnail_image" class="form-control-file">
                            <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        </div>
                        <button class="btn btn-success" type="submit">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',168)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.listing.new.banner') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',283)->first()->custom_text }}</label>
                            <div class="listing-banner-image">
                                <img  src="{{ $listing->banner_image ? asset($listing->banner_image) : '' }}" alt="">

                            </div>

                            <label for="banner_image" class="mt-2">{{ $websiteLang->where('id',168)->first()->custom_text }}</label>
                            <input required type="file" name="banner_image" id="banner_image" class="form-control-file">
                            <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        </div>
                        <button class="btn btn-success" type="submit">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                    </form>
                </div>
            </div>


        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',383)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">
                    @if ($listing->listingImages->count()>0)
                        <table class="table table-bordered">
                            @foreach ($listing->listingImages as $image)
                            <tr>
                                <td><img class="listing-slider-image" src="{{ $image->image ? asset($image->image) : '' }}" alt="listing image" class="custom_img_width"></td>
                                <td>
                                    <a onclick="return confirm ('{{ $confirmNotify }}')" href="{{ route('admin.delete.listing.image',$image->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        <h4 class="text-danger">{{ $websiteLang->where('id',384)->first()->custom_text }}</h4>
                    @endif


                    <form action="{{ route('admin.listing.new.image') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row" id="image-row">
                            <div class="col-md-12">
                                <label for="">{{ $websiteLang->where('id',121)->first()->custom_text }} <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="file" class="form-control" name="images[]">
                                    </div>
                                    <div class="col-md-2">
                                        <button id="addListingImageRow" type="button" class="btn btn-success btn-sm"><i class="fas fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">

                        <button class="btn btn-success mt-3" type="submit">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {

            // start imag row
            $("#addListingImageRow").on("click",function(){
                var html="";
                html +='<div class="col-md-12 mt-2 removeImageRow">';
                html +='<label for="">{{ $websiteLang->where("id",121)->first()->custom_text }}</label>';
                html +='<div class="row">';
                html +='<div class="col-md-10">';
                html +='<input type="file" class="form-control" name="images[]">';
                html +='</div>';
                html +='<div class="col-md-2">';
                html +='<button type="button" class="btn btn-danger btn-sm removeListingImageRow"><i class="fas fa-trash" aria-hidden="true"></i></button>';
                html +='</div>';
                html +='</div>';
                html +='</div>';
                $("#image-row").append(html)
            })
            $(document).on('click', '.removeListingImageRow', function () {
                $(this).closest('.removeImageRow').remove();
            });


        });

        })(jQuery);


    </script>

@endsection
