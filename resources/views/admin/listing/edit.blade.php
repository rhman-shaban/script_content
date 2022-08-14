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

                    <form action="{{ route('admin.listing.update',$listing->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="title">{{ $websiteLang->where('id',90)->first()->custom_text }} <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ $listing->title }}">
                        </div>
                        <div class="form-group">
                            <label for="slug">{{ $websiteLang->where('id',91)->first()->custom_text }} <span class="text-danger">*</span></label>
                            <input type="text" name="slug" class="form-control" id="slug" value="{{ $listing->slug }}">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">{{ $websiteLang->where('id',92)->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">{{ $websiteLang->where('id',119)->first()->custom_text }}</option>
                                        @foreach ($listingCategories as $item)
                                        <option {{ $listing->listing_category_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
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
                                        <option {{ $listing->location_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">{{ $websiteLang->where('id',55)->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="text" name="address" value="{{ $listing->address }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{ $websiteLang->where('id',39)->first()->custom_text }}</label>
                                    <input type="text" name="phone" value="{{ $listing->phone }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ $websiteLang->where('id',38)->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ $listing->email }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website">{{ $websiteLang->where('id',93)->first()->custom_text }}</label>
                                    <input type="url" name="website" value="{{ $listing->website }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook">{{ $websiteLang->where('id',106)->first()->custom_text }}</label>
                                    <input type="text" name="facebook" value="{{ $listing->facebook }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter">{{ $websiteLang->where('id',107)->first()->custom_text }}</label>
                                    <input type="text" name="twitter" value="{{ $listing->twitter }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin">{{ $websiteLang->where('id',108)->first()->custom_text }}</label>
                                    <input type="text" name="linkedin" value="{{ $listing->linkedin }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="whatsapp">{{ $websiteLang->where('id',109)->first()->custom_text }}</label>
                                    <input type="text" name="whatsapp" value="{{ $listing->whatsapp }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="instagram">{{ $websiteLang->where('id',110)->first()->custom_text }}</label>
                                    <input type="text" name="instagram" value="{{ $listing->instagram }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pinterest">{{ $websiteLang->where('id',111)->first()->custom_text }}</label>
                                    <input type="text" name="pinterest" value="{{ $listing->pinterest }}" class="form-control">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tumblr">{{ $websiteLang->where('id',112)->first()->custom_text }}</label>
                                    <input type="text" name="tumblr" value="{{ $listing->tumblr }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="youtube">{{ $websiteLang->where('id',113)->first()->custom_text }}</label>
                                    <input type="text" name="youtube" value="{{ $listing->youtube }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if ($listing->file)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="file">{{ $websiteLang->where('id',440)->first()->custom_text }} : </label>

                                    <div>
                                        <a href="{{ route('download-listing-file',$listing->file) }}">{{ $listing->file }}</a> <a onclick="return confirm('{{ $confirmNotify }}')" href="{{ route('admin.delete-file',$listing->id) }}" class="text-danger ml-3"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="file">{{ $websiteLang->where('id',99)->first()->custom_text }}</label>
                                    <input type="file" name="file" id="file" class="form-control-file">
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',104)->first()->custom_text }}</label>
                                    <div>
                                        @foreach ($aminities as $aminity)
                                            @php
                                                $isChecked=false;
                                            @endphp
                                            @foreach ($listing->listingAminities as $old_aminity)
                                                @if ($aminity->id==$old_aminity->aminity_id)
                                                    @php
                                                        $isChecked=true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <input {{ $isChecked ? 'checked' :'' }} value="{{ $aminity->id }}" type="checkbox" name="aminities[]" id="{{ $aminity->slug }}">
                                            <label class="mx-1" for="{{ $aminity->slug }}">{{ $aminity->aminity }}</label>
                                        @endforeach
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',254)->first()->custom_text }} <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="5" name="google_map_embed_code">{{ $listing->google_map_embed_code }}</textarea>
                        </div>

                        <div class="form-group mt-3">
                            <label for="sort_description">{{ $websiteLang->where('id',102)->first()->custom_text }} <span class="text-danger">*</span></label>
                            <textarea class="form-control" cols="30" rows="5" id="sort_description" name="sort_description">{{ $listing->sort_description }}</textarea>
                        </div>

                        <div class="form-group mt-3">
                            <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }} <span class="text-danger">*</span></label>
                            <textarea class="summernote" id="description" name="description">{{ $listing->description }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">{{ $websiteLang->where('id',135)->first()->custom_text }} <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $listing->status==1 ? 'selected': '' }}  value="1">{{ $websiteLang->where('id',140)->first()->custom_text }}</option>
                                        <option {{ $listing->status==0 ? 'selected': '' }}  value="0">{{ $websiteLang->where('id',141)->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="feature">{{ $websiteLang->where('id',114)->first()->custom_text }}</label>
                                    <select name="feature" id="feature" class="form-control">
                                        <option {{ $listing->is_featured==0 ? 'selected': '' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                        <option {{ $listing->is_featured==1 ? 'selected': '' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="verified">{{ $websiteLang->where('id',380)->first()->custom_text }}</label>
                                    <select name="verified" id="verified" class="form-control">
                                        <option {{ $listing->verified==1 ? 'selected' : '' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $listing->verified==0 ? 'selected' : '' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="seo_title">{{ $websiteLang->where('id',115)->first()->custom_text }}</label>
                            <input type="text" name="seo_title" class="form-control" id="seo_title" value="{{ $listing->seo_title }}">
                        </div>
                        <div class="form-group">
                            <label for="seo_description">{{ $websiteLang->where('id',116)->first()->custom_text }}</label>
                            <textarea name="seo_description" id="seo_description" cols="30" rows="3" class="form-control" >{{ $listing->seo_description }}</textarea>
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
            $("#title").on("focusout",function(e){
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
