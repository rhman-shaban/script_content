@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',69)->first()->custom_text }}</title>
@endsection

@section('user-dashboard')
<!-- Page Content Holder -->
<div id="content">

    <div class="row">
        <div class="col-xl-9 col-xxl-10 ms-auto">
            <div class="dashboard_content">
              <div class="row">
                <div class="col-xl-12">
                  <div class="dashboard_breadcrumb">
                    <span>{{ $websiteLang->where('id',70)->first()->custom_text }}</span>
                    <ul>
                      <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }} <i class="fas fa-caret-right"></i></a></li>
                      <li><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }} <i class="fas fa-caret-right"></i></a></li>
                      <li><a class="bread_active" href="javascript::void">{{ $websiteLang->where('id',69)->first()->custom_text }}</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <form action="{{ route('user.listing.update',$listing->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

              <div class="my_listing">
                <h4>{{ $websiteLang->where('id',89)->first()->custom_text }}</h4>
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',90)->first()->custom_text }}<span class="text-danger">*</span></label>
                        <div class="input_area">
                        <input name="title" id="title" type="text" value="{{ $listing->title }}">
                        <i class="fal fa-edit"></i>
                        </div>
                    </div>
                    </div>
                    <input type="hidden" name="package_id" value="{{ $package->id }}">

                    <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',91)->first()->custom_text }}<span class="text-danger">*</span></label>
                        <div class="input_area">
                        <input id="slug" name="slug" type="text" value="{{ $listing->slug }}">
                        <i class="fal fa-edit"></i>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',92)->first()->custom_text }}<span class="text-danger">*</span></label>
                        <div class="input_area">
                        <div class="wsus__search_area">
                            <i class="fal fa-edit"></i>
                            <select class="select_2" name="category">
                            <option class="bs-title-option" value="">{{ $websiteLang->where('id',119)->first()->custom_text }}</option>
                            @foreach ($listingCategories as $category)
                                <option {{ $listing->listing_category_id==$category->id ? 'selected' : '' }} value="{{ $category->id }}" class="bs-title-option" value="">{{ $category->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',125)->first()->custom_text }}<span class="text-danger">*</span></label>
                        <div class="input_area">
                        <div class="wsus__search_area">
                            <i class="fas fa-map-marker-alt"></i>
                            <select class="select_2" name="location">
                            <option class="bs-title-option" value="">{{ $websiteLang->where('id',120)->first()->custom_text }}</option>
                            @foreach ($locations as $location)
                            <option {{ $listing->location_id==$location->id ? 'selected' : '' }} class="" value="{{ $location->id }}">{{ $location->location }}</option>
                            @endforeach
                        </select>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',55)->first()->custom_text }}<span class="text-danger">*</span></label>
                        <div class="input_area">
                        <input name="address" type="text" value="{{ $listing->address }}">
                        <i class="fas fa-street-view"></i>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',39)->first()->custom_text }}</label>
                        <div class="input_area">
                        <input name="phone" type="text" value="{{ $listing->phone }}">
                        <i class="fas fa-phone-alt"></i>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',38)->first()->custom_text }} <span class="text-danger">*</span></label>
                        <div class="input_area">
                        <input name="email" type="email" value="{{ $listing->email }}">
                        <i class="fal fa-envelope"></i>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',93)->first()->custom_text }}</label>
                        <div class="input_area">
                        <input name="website" type="text" value="{{ $listing->website }}">
                        <i class="fal fa-globe"></i>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-12">
                    <div class="my_listing_single mar_bottom">
                        <label>{{ $websiteLang->where('id',254)->first()->custom_text }} <span class="text-danger">*</span></label>
                        <div class="input_area">
                        <textarea cols="3" rows="5" name="google_map_embed_code">{{ $listing->google_map_embed_code }}</textarea>
                        <i class="fal fa-location"></i>
                        </div>
                    </div>
                    </div>
                </div>
              </div>
              <div class="my_listing list_mar list_padding">
                <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                    <label for="name">{{ $websiteLang->where('id',383)->first()->custom_text }}</label>
                    @if ($listing->listingImages->count()>0)
                        <table class="table-bordered">
                            @foreach ($listing->listingImages as $image)
                                <tr>
                                    <td width="90%"><img  class="old_image_class" src="{{ $image->image ? asset($image->image) : '' }}" alt="" ></td>
                                    <td width="10%"><a href="{{ route('user.delete-listing-image',$image->id) }}" onclick="return confirm('{{ $notify }}')" class="btn btn-danger btn-sm custom_btn_style"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                        <table class="table-bordered">
                            <tr>
                                <td><h5 class="text-danger text-center">{{ $websiteLang->where('id',384)->first()->custom_text }}</h5></td>
                            </tr>
                        </table>
                        @endif
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                    <label for="name">{{ $websiteLang->where('id',127)->first()->custom_text }}</label>
                    @if ($listing->listingVideos->count()>0)
                        <table class="table-bordered">
                            @foreach ($listing->listingVideos as $video)
                                <tr>
                                    @php
                                        $video_id=explode("=",$video->video_link);
                                    @endphp

                                    <td width="90%"><iframe class="old_image_class" width="380" height="235"
                                        src="https://www.youtube.com/embed/{{ $video_id[1] }}">
                                        </iframe></td>

                                    <td width="10%">
                                        <a href="{{ route('user.listing-video-delete',$video->id) }}" onclick="return confirm('{{ $notify }}')" class="btn btn-danger btn-sm custom_btn_style"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                            <table class="table-bordered">
                                <tr>
                                    <td><h5 class="text-danger text-center">{{ $websiteLang->where('id',386)->first()->custom_text }}</h5></td>
                                </tr>
                            </table>

                        @endif
                    </div>
                </div>

                @php
                    $existImage=$listing->listingImages->count();
                    $packageImage=$package->number_of_photo;
                    $availableImage=$packageImage - $existImage ;

                    $existVideo=$listing->listingVideos->count();
                    $packageVideo=$package->number_of_video;
                    $availableVideo=$packageVideo - $existVideo;
                @endphp

                  @if ($package->number_of_photo== -1)
                  <div class="col-xl-6 col-md-6">


                    <div id="medicine_row">
                      <label for="name">{{ $websiteLang->where('id',121)->first()->custom_text }} <span class="text-danger qty-alert">({{ $websiteLang->where('id',425)->first()->custom_text }})</span></label>
                        <div class="medicine_row_input">
                            <input type="file" name="image[]">
                          <button type="button" id="unlimited_add_row"><i class="fas fa-plus" aria-hidden="true"></i></button>
                        </div>
                    </div>
                  </div>
                  @else
                    @php
                        $existImage=$listing->listingImages->count();
                        $packageImage=$package->number_of_photo;
                        $availableImage=$packageImage - $existImage ;
                    @endphp

                    @if ($availableImage > 0)
                        <div class="col-xl-6 col-md-6">
                            <div id="medicine_row">
                            <label for="name">{{ $websiteLang->where('id',121)->first()->custom_text }} <span class="text-danger qty-alert">({{ $websiteLang->where('id',432)->first()->custom_text }}-{{ $availableImage }})</span></span></label>
                                <div class="medicine_row_input">
                                <input type="file" name="image[]">
                                <button type="button" id="add_row"><i class="fas fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    @endif
                  @endif

                  @if ($package->number_of_video==-1)
                    <div class="col-xl-6 col-md-6">
                        <div id="medicine_row2">
                        <label for="name">{{ $websiteLang->where('id',122)->first()->custom_text }} <span class="text-danger qty-alert">({{  $websiteLang->where('id',425)->first()->custom_text  }})</span></label>
                            <div class="medicine_row_input inpiut_pad">
                            <input type="text" name="video[]" >
                            <button type="button" id="unlimited_add_row2"><i class="fas fa-plus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                  @else

                    @php
                        $existVideo=$listing->listingVideos->count();
                        $packageVideo=$package->number_of_video;
                        $availableVideo=$packageVideo - $existVideo;
                    @endphp

                    @if ($availableVideo >0)
                        <div class="col-xl-6 col-md-6">
                            <div id="medicine_row2">
                            <label for="name">{{ $websiteLang->where('id',122)->first()->custom_text }} <span class="text-danger qty-alert">({{ $websiteLang->where('id',433)->first()->custom_text }}-{{ $availableVideo }})</span></label>
                                <div class="medicine_row_input inpiut_pad">
                                <input type="text" name="video[]">
                                <button type="button" id="add_row2"><i class="fas fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    @endif
                  @endif
                </div>
              </div>

              <div class="my_listing list_mar list_padding">
                <h4>{{ $websiteLang->where('id',437)->first()->custom_text }}</h4>
                <div class="row">
                    @if ($listing->file)
                        <div class="col-12">
                            <div class="my_listing_single">
                            <label>{{ $websiteLang->where('id',440)->first()->custom_text }}</label>
                            <div>
                                <a href="{{ route('download-listing-file',$listing->file) }}">{{ $listing->file }}</a> <a onclick="return confirm('{{ $notify }}')" href="{{ route('user.delete-file',$listing->id) }}" class="text-danger custom_btn_style"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                            </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-xl-6 col-md-6">
                        <div class="my_listing_single">
                          <label>{{ $websiteLang->where('id',99)->first()->custom_text }}</label>
                          <div class="input_area input_area_2">
                            <input type="file" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="file">
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                      </div>

                    <div class="col-xl-6 col-md-6">
                        <div class="my_listing_single">

                            <label for="">{{ $websiteLang->where('id',128)->first()->custom_text }}</label>
                            <div class="mb-3 listing-edit-logo">
                                <img width="120px" src="{{ $listing->logo ? asset($listing->logo) : '' }}" alt="">
                            </div>

                        <label>{{ $websiteLang->where('id',97)->first()->custom_text }} <span class="text-danger">*</span></label>
                        <div class="input_area input_area_2">
                            <input type="file" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="logo">
                        </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6">
                    </div>


                  <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label for="">{{ $websiteLang->where('id',129)->first()->custom_text }}</label>
                        <div class="mb-3">
                            <img width="200px" src="{{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }}" alt="" class="banner_custom_w">
                        </div>

                        <label>{{ $websiteLang->where('id',98)->first()->custom_text }}<span class="text-danger">*</span></label>
                      <div class="input_area input_area_2">
                        <input id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="thumbnail_image" type="file">
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label for="">{{ $websiteLang->where('id',283)->first()->custom_text }}</label>
                        <div class="mb-3 banner-image">
                            <img width="200px"  src="{{ $listing->banner_image ? asset($listing->banner_image) : '' }}" alt="" class="banner_custom_w">
                        </div>
                        <label for="banner_image">{{ $websiteLang->where('id',168)->first()->custom_text }} <span class="text-danger">*</span></label>
                      <div class="input_area input_area_2">
                        <input type="file" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="banner_image">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="my_listing list_mar list_padding">
                <h4>{{ $websiteLang->where('id',101)->first()->custom_text }}</h4>
                <div class="row">
                  <div class="col-xl-12">
                    <div class="my_listing_single list_mar">
                      <label><label>{{ $websiteLang->where('id',102)->first()->custom_text }} <span class="text-danger">*</span></label></label>
                      <div class="input_area input_area_2">
                        <textarea cols="3" rows="5" name="sort_description">{{ $listing->sort_description }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',103)->first()->custom_text }} <span class="text-danger">*</span></label>
                      <textarea class="form-control summer_note"name="description">{{ $listing->description }}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              @if ($package->number_of_aminities==-1)
                <div class="my_listing list_mar list_padding">
                    <h4>{{ $websiteLang->where('id',104)->first()->custom_text }} <span class="text-danger qty-alert" >({{ $websiteLang->where('id',425)->first()->custom_text }})</span></h4>
                    <div class="row">
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
                            <div class="col-xl-6 col-xxl-4 col-md-6">
                                <div class="amenities_check_area">
                                <div class="wsus__pro_check">
                                    <div class="form-check">
                                        <input {{ $isChecked ? 'checked' :'' }} class="form-check-input unlim-is-check" type="checkbox" id="aminity-{{ $aminity->id }}" name="aminities[]" value="{{ $aminity->id }}">
                                        <label class="form-check-label" for="aminity-{{ $aminity->id }}">{{ $aminity->aminity }}
                                        </label>
                                    </div>
                                </div>
                                <i class="{{ $aminity->icon }}"></i>
                                </div>
                            </div>
                        @endforeach

                        @php
                            $aminityList=[];
                            foreach ($aminities as $index => $aminity) {
                                $aminityList[]=$aminity->id;
                            }
                        @endphp

                    </div>
                </div>
              @else
                <div class="my_listing list_mar list_padding">
                    <h4>{{ $websiteLang->where('id',104)->first()->custom_text }} <small class="text-danger qty-alert" >({{ $websiteLang->where('id',434)->first()->custom_text }}-{{ $package->number_of_aminities }})</span></h4>
                    <div class="row">
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
                            <div class="col-xl-6 col-xxl-4 col-md-6">
                                <div class="amenities_check_area">
                                <div class="wsus__pro_check">
                                    <div class="form-check">
                                        <input {{ $isChecked ? 'checked' :'' }} class="form-check-input is-check" type="checkbox" id="aminity-{{ $aminity->id }}" name="aminities[]" value="{{ $aminity->id }}">
                                        <label class="form-check-label" for="aminity-{{ $aminity->id }}">{{ $aminity->aminity }}
                                        </label>
                                    </div>
                                </div>
                                <i class="{{ $aminity->icon }}"></i>
                                </div>
                            </div>
                            @endforeach

                            @php
                                $aminityList=[];
                                foreach ($aminities as $index => $aminity) {
                                    $aminityList[]=$aminity->id;
                                }
                            @endphp

                    </div>
                </div>
              @endif
              <div class="my_listing list_mar list_padding">
                <h4>{{ $websiteLang->where('id',105)->first()->custom_text }}</h4>
                <div class="row">
                  <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                      <label>{{ $websiteLang->where('id',106)->first()->custom_text }}</label>
                      <div class="input_area">
                        <input name="facebook" type="text" value="{{ $listing->facebook }}">
                        <i class="fab fa-facebook-f"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',107)->first()->custom_text }}</label>
                      <div class="input_area">
                        <input name="twitter" value="{{ $listing->twitter }}" type="text">
                        <i class="fab fa-twitter"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',108)->first()->custom_text }}</label>
                      <div class="input_area">
                        <input type="text" name="linkedin" type="text" value="{{ $listing->linkedin }}">
                        <i class="fab fa-linkedin-in"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',109)->first()->custom_text }}</label>
                      <div class="input_area">
                        <input name="whatsapp" type="text"  value="{{ $listing->whatsapp }}">
                        <i class="fab fa-whatsapp"></i>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',110)->first()->custom_text }}</label>
                      <div class="input_area">
                        <input name="instagram" type="text" value="{{ $listing->instagram }}">
                        <i class="fab fa-instagram"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',111)->first()->custom_text }}</label>
                      <div class="input_area">
                        <input name="pinterest" type="text" value="{{ $listing->pinterest }}">
                        <i class="fab fa-pinterest"></i>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                      <label>{{ $websiteLang->where('id',113)->first()->custom_text }}</label>
                      <div class="input_area">
                        <input name="youtube" type="text" value="{{ $listing->youtube }}">
                        <i class="fab fa-youtube"></i>
                      </div>
                    </div>
                  </div>




               </div>
              </div>
              <div class="my_listing list_mar">
                <div class="row">
                    @if ($package->is_featured)
                        @if ($package->number_of_feature_listing==-1)
                            <div class="col-12">
                                <div class="my_listing_single">
                                <label>{{ $websiteLang->where('id',114)->first()->custom_text }}</label>
                                <div class="input_area">
                                    <div class="wsus__search_area">
                                    <i class="fal fa-smile"></i>
                                    <select class="select_2" name="feature">
                                        <option {{ $listing->is_featured==1 ? 'selected' : '' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $listing->is_featured==0 ? 'selected' : '' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>
                                </div>
                                </div>
                            </div>
                        @elseif($package->number_of_feature_listing > $existingFeaturedListing)
                            <div class="col-12">
                                <div class="my_listing_single">
                                <label>{{ $websiteLang->where('id',114)->first()->custom_text }}</label>
                                <div class="input_area">
                                    <div class="wsus__search_area">
                                    <i class="fal fa-smile"></i>
                                    <select class="select_2" name="feature">
                                        <option {{ $listing->is_featured==1 ? 'selected' : '' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $listing->is_featured==0 ? 'selected' : '' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>
                                </div>
                                </div>
                            </div>
                        @endif

                    @endif

                  <div class="col-12">
                    <div class="my_listing_single">
                      <label>{{ $websiteLang->where('id',115)->first()->custom_text }}</label>
                      <div class="input_area">
                        <div class="input_area">
                          <input name="seo_title" type="text" value="{{ $listing->seo_title }}">
                          <i class="fal fa-envelope"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="my_listing_single">
                        <label>{{ $websiteLang->where('id',116)->first()->custom_text }}</label>
                      <div class="input_area">
                        <textarea cols="3" rows="5"  name="seo_description">{{ $listing->seo_description }}</textarea>
                        <i class="fal fa-envelope"></i>
                      </div>
                    </div>
                    <button type="submit" class="read_btn">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                  </div>
               </div>
              </div>

            </form>
            </div>
        </div>
      </div>


<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $("#title").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })

            $('.summernote').summernote();




            //start handle aminity
            $(".is-check").on("click",function(e){
                var ids = [];
                var aminityList=<?= json_encode($aminityList)?>;
                var maxAminity= <?= $package->number_of_aminities ?>;

                $('input[name="aminities[]"]:checked').each(function() {
                    ids.push(this.value);
                });
                var idsLenth=ids.length;


                var checkedIds = ids.map((i) => Number(i));
                var unCheckedIds=aminityList.filter(d => !checkedIds.includes(d))


                if( maxAminity > idsLenth){
                    for(var j=0; j< unCheckedIds.length ; j++){
                        $("#aminity-"+unCheckedIds[j]).prop("disabled", false);
                    }
                }else{
                    for(var j=0; j< unCheckedIds.length ; j++){
                        $("#aminity-"+unCheckedIds[j]).prop("disabled", true);
                    }
                }

            })
            //end handle aminity


            var existImage="{{  $listing->listingImages->count() }}"
            var packageMaxImage='{{ $package->number_of_photo }}'
            var max_image      =packageMaxImage - existImage ;
            var img=1;

            var existVideo="{{ $listing->listingVideos->count() }}"
            var packageMaxVideo='{{ $package->number_of_video }}'
            var max_video=packageMaxVideo - existVideo;
            var video=1;
            $("#add_row").on('click', function() {
                if(img < max_image){
                    img++;
                    var html = '';
                    html += '<div  id="remove">';
                    html += '<label for="">{{ $websiteLang->where("id",121)->first()->custom_text }}</label>';
                    html += '<div class="medicine_row_input">';

                    html += '<input type="file" name="image[]">';
                    html += '<button type="button" id="removeRow" ><i class="fas fa-trash" aria-hidden="true"></i></button>';
                    html += '</div>';
                    html += '</div>';
                    $("#medicine_row").append(html)
                }
            });
            $(document).on('click', '#removeRow', function() {
                $(this).closest('#remove').remove();
                img--;
            });


            // for unlimited image
            $("#unlimited_add_row").on('click', function() {
                var html = '';
                html += '<div  id="remove">';
                html += '<label for="">{{ $websiteLang->where("id",121)->first()->custom_text }}</label>';
                html += '<div class="medicine_row_input">';

                html += '<input type="file" name="image[]">';
                html += '<button type="button" id="removeRow" ><i class="fas fa-trash" aria-hidden="true"></i></button>';
                html += '</div>';
                html += '</div>';
                $("#medicine_row").append(html)
            });


            $(".unlimited_input_fields_vimeo").on("click",".remove_field", function(e){
                e.preventDefault();
                $(this).parent('div').remove();
            })
            // end unlimited image


            // for video
            $("#add_row2").on('click', function() {
                console.log('video');

                if(video < max_video){
                    video++;
                    var html = '';
                    html += '<div  id="remove">';
                    html += '<label for="">{{ $websiteLang->where("id",122)->first()->custom_text }}</label>';
                    html += '<div class="medicine_row_input">';

                    html += '<input type="text" name="video[]">';
                    html += '<button type="button" id="removeRow2" ><i class="fas fa-trash" aria-hidden="true"></i></button>';
                    html += '</div>';
                    html += '</div>';
                    $("#medicine_row2").append(html)
                }
            });

            $(document).on('click', '#removeRow2', function() {
                video--;
                $(this).closest('#remove').remove();
            });


            // for unlimited video
            $("#unlimited_add_row2").on('click', function() {
                var html = '';
                html += '<div  id="remove">';
                html += '<label for="">{{ $websiteLang->where("id",122)->first()->custom_text }}</label>';
                html += '<div class="medicine_row_input">';
                html += '<input type="text" name="video[]">';
                html += '<button type="button" id="removeRow2" ><i class="fas fa-trash" aria-hidden="true"></i></button>';
                html += '</div>';
                html += '</div>';
                $("#medicine_row2").append(html)
            });
            // end unlimited vidoe


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
