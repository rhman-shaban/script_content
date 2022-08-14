@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',371)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.my.listing') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('id',368)->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',379)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.listing.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">{{ $websiteLang->where('id',90)->first()->custom_text }} <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="slug">{{ $websiteLang->where('id',91)->first()->custom_text }} <span class="text-danger">*</span></label>
                            <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug') }}">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">{{ $websiteLang->where('id',92)->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">{{ $websiteLang->where('id',119)->first()->custom_text }}</option>
                                        @foreach ($listingCategories as $item)
                                        <option {{ old('category')==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location">{{ $websiteLang->where('id',125)->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="location" id="location" class="form-control">
                                        <option value="">{{ $websiteLang->where('id',120)->first()->custom_text }}</option>
                                        @foreach ($locations as $item)
                                        <option {{ old('location')==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">{{ $websiteLang->where('id',55)->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{ $websiteLang->where('id',39)->first()->custom_text }}</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ $websiteLang->where('id',38)->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website">{{ $websiteLang->where('id',93)->first()->custom_text }}</label>
                                    <input type="url" name="website" value="{{ old('website') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook">{{ $websiteLang->where('id',106)->first()->custom_text }}</label>
                                    <input type="text" name="facebook" value="{{ old('facebook') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter">{{ $websiteLang->where('id',107)->first()->custom_text }}</label>
                                    <input type="text" name="twitter" value="{{ old('twitter') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin">{{ $websiteLang->where('id',108)->first()->custom_text }}</label>
                                    <input type="text" name="linkedin" value="{{ old('linkedin') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="whatsapp">{{ $websiteLang->where('id',109)->first()->custom_text }}</label>
                                    <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="instagram">{{ $websiteLang->where('id',110)->first()->custom_text }}</label>
                                    <input type="text" name="instagram" value="{{ old('instagram') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pinterest">{{ $websiteLang->where('id',111)->first()->custom_text }}</label>
                                    <input type="text" name="pinterest" value="{{ old('pinterest') }}" class="form-control">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tumblr">{{ $websiteLang->where('id',112)->first()->custom_text }}</label>
                                    <input type="text" name="tumblr" value="{{ old('tumblr') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="youtube">{{ $websiteLang->where('id',113)->first()->custom_text }}</label>
                                    <input type="text" name="youtube" value="{{ old('youtube') }}" class="form-control">
                                </div>
                            </div>


                        </div>

                        {{-- file section --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo">{{ $websiteLang->where('id',97)->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="file" name="logo" id="logo" class="form-control-file">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="thumbnail_image">{{ $websiteLang->where('id',98)->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="file" name="thumbnail_image" id="thumbnail_image" class="form-control-file">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="banner_image">{{ $websiteLang->where('id',168)->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="file" name="banner_image" id="banner_image" class="form-control-file">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file">{{ $websiteLang->where('id',99)->first()->custom_text }}</label>
                                    <input type="file" name="file" id="file" class="form-control-file">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row" id="image-row">
                                    <div class="col-md-12">
                                        <label for="">{{ $websiteLang->where('id',121)->first()->custom_text }} <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="file" class="form-control" name="image[]">
                                            </div>
                                            <div class="col-md-2">
                                                <button id="addListingImageRow" type="button" class="btn btn-success btn-sm"><i class="fas fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row" id="video-row">
                                    <div class="col-md-12">
                                        <label for="">{{ $websiteLang->where('id',122)->first()->custom_text }}</label>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="video[]">
                                            </div>
                                            <div class="col-md-2">
                                                <button id="addListingVideoRow" type="button" class="btn btn-success btn-sm"><i class="fas fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',104)->first()->custom_text }}</label>
                                    <div>
                                        @foreach ($aminities as $aminity)
                                            @if (old('aminities'))
                                                @php
                                                    $isChecked=false;
                                                @endphp
                                                @foreach (old('aminities') as $old_aminity)
                                                    @if ($aminity->id==$old_aminity)
                                                    @php
                                                    $isChecked=true;
                                                @endphp
                                                    @endif
                                                @endforeach
                                                <input id="{{ $aminity->slug }}" {{ $isChecked ? 'checked' :'' }} value="{{ $aminity->id }}" type="checkbox" name="aminities[]" >
                                                <label class="mx-1" for="{{ $aminity->slug }}">{{ $aminity->aminity }}</label>

                                            @else
                                                <input value="{{ $aminity->id }}" type="checkbox" name="aminities[]" id="{{ $aminity->slug }}">
                                                <label class="mx-1" for="{{ $aminity->slug }}">{{ $aminity->aminity }}</label>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',254)->first()->custom_text }} <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="5" name="google_map_embed_code">{{ old('google_map_embed_code') }}</textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="sort_description">{{ $websiteLang->where('id',102)->first()->custom_text }} <span class="text-danger">*</span></label>
                            <textarea class="form-control" cols="30" rows="5" id="sort_description" name="sort_description">{{ old('sort_description') }}</textarea>
                        </div>

                        <div class="form-group mt-3">
                            <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }} <span class="text-danger">*</span></label>
                            <textarea class="summernote" id="description" name="description">{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">{{ $websiteLang->where('id',135)->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control">
                                        <option  value="1">{{ $websiteLang->where('id',140)->first()->custom_text }}</option>
                                        <option  value="0">{{ $websiteLang->where('id',141)->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="feature">{{ $websiteLang->where('id',114)->first()->custom_text }}</label>
                                    <select name="feature" id="feature" class="form-control">
                                        <option {{ old('feature')==0 ? 'selected': '' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                        <option {{ old('feature')==1 ? 'selected': '' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="verified">{{ $websiteLang->where('id',380)->first()->custom_text }}</label>
                                    <select name="verified" id="verified" class="form-control">
                                        <option value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="form-group">
                            <label for="seo_title">{{ $websiteLang->where('id',115)->first()->custom_text }}</label>
                            <input type="text" name="seo_title" class="form-control" id="seo_title" value="{{ old('seo_title') }}">
                        </div>
                        <div class="form-group">
                            <label for="seo_description">{{ $websiteLang->where('id',116)->first()->custom_text }}</label>
                            <textarea name="seo_description" id="seo_description" cols="30" rows="3" class="form-control" >{{ old('seo_description') }}</textarea>
                        </div>


                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',117)->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $("#title").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })

            // start imag row
            $("#addListingImageRow").on("click",function(){
                var html="";
                html +='<div class="col-md-12 mt-2 removeImageRow">';
                html +='<label for="">'+'{{ $websiteLang->where("id",121)->first()->custom_text }}'+'</label>';
                html +='<div class="row">';
                html +='<div class="col-md-10">';
                html +='<input type="file" class="form-control" name="image[]">';
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

            // end image row

            // start video row
            $("#addListingVideoRow").on("click",function(){
                var html="";
                html +='<div class="col-md-12 mt-2 removeVideoRow">';
                html +='<label for="">{{ $websiteLang->where("id",122)->first()->custom_text }}</label>';
                html +='<div class="row">';
                html +='<div class="col-md-10">';
                html +='<input type="text" class="form-control" name="video[]">';
                html +='</div>';
                html +='<div class="col-md-2">';
                html +='<button type="button" class="btn btn-danger btn-sm removeListingVideoRow"><i class="fas fa-trash" aria-hidden="true"></i></button>';
                html +='</div>';
                html +='</div>';
                html +='</div>';
                $("#video-row").append(html)
            })
            $(document).on('click', '.removeListingVideoRow', function () {
                $(this).closest('.removeVideoRow').remove();
            });

            // end video row

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
