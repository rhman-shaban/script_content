@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',70)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
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
                  <li><a class="bread_active" href="javascript::void">{{ $websiteLang->where('id',70)->first()->custom_text }}</a></li>
                </ul>
              </div>
            </div>
          </div>
          <form action="{{ route('user.listing.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

          <div class="my_listing">
            <h4>{{ $websiteLang->where('id',89)->first()->custom_text }}</h4>
            <div class="row">
                <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',90)->first()->custom_text }}<span class="text-danger">*</span></label>
                    <div class="input_area">
                    <input name="title" id="title" type="text" value="{{ old('title') }}">
                    <i class="fal fa-edit"></i>
                    </div>
                </div>
                </div>
                <input type="hidden" name="package_id" value="{{ $package->id }}">
                <input type="hidden" name="expired_date" value="{{ $expired_date }}">

                <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',91)->first()->custom_text }}<span class="text-danger">*</span></label>
                    <div class="input_area">
                    <input id="slug" name="slug" type="text" value="{{ old('slug') }}">
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
                        <option {{ old('category')==$category->id ? 'selected' : '' }} value="{{ $category->id }}" class="bs-title-option" value="">{{ $category->name }}</option>
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
                        <option {{ old('location')==$location->id ? 'selected' : '' }} class="" value="{{ $location->id }}">{{ $location->location }}</option>
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
                    <input name="address" type="text" value="{{ old('address') }}">
                    <i class="fas fa-street-view"></i>
                    </div>
                </div>
                </div>
                <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',39)->first()->custom_text }}</label>
                    <div class="input_area">
                    <input name="phone" type="text" value="{{ old('phone') }}">
                    <i class="fas fa-phone-alt"></i>
                    </div>
                </div>
                </div>
                <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',38)->first()->custom_text }} <span class="text-danger">*</span></label>
                    <div class="input_area">
                    <input name="email" type="email" value="{{ old('email') }}">
                    <i class="fal fa-envelope"></i>
                    </div>
                </div>
                </div>
                <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',93)->first()->custom_text }}</label>
                    <div class="input_area">
                    <input name="website" type="text" value="{{ old('website') }}">
                    <i class="fal fa-globe"></i>
                    </div>
                </div>
                </div>
                <div class="col-xl-12">
                <div class="my_listing_single mar_bottom">
                    <label>{{ $websiteLang->where('id',254)->first()->custom_text }} <span class="text-danger">*</span></label>
                    <div class="input_area">
                    <textarea cols="3" rows="5" name="google_map_embed_code">{{ old('google_map_embed_code') }}</textarea>
                    <i class="fal fa-location"></i>
                    </div>
                </div>
                </div>
            </div>
          </div>
          <div class="my_listing list_mar list_padding">
            <h4>{{ $websiteLang->where('id',96)->first()->custom_text }}</h4>
            <div class="row">
              <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                  <label>{{ $websiteLang->where('id',97)->first()->custom_text }} <span class="text-danger">*</span></label>
                  <div class="input_area input_area_2">
                    <input type="file" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="logo">
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',98)->first()->custom_text }}<span class="text-danger">*</span></label>
                  <div class="input_area input_area_2">
                    <input id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="thumbnail_image" type="file">
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                    <label for="banner_image">{{ $websiteLang->where('id',168)->first()->custom_text }} <span class="text-danger">*</span></label>
                  <div class="input_area input_area_2">
                    <input type="file" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="banner_image">
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                  <label>{{ $websiteLang->where('id',99)->first()->custom_text }}</label>
                  <div class="input_area input_area_2">
                    <input type="file" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="file">
                  </div>
                </div>
              </div>
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
              <div class="col-xl-6 col-md-6">
                <div id="medicine_row">
                  <label for="name">{{ $websiteLang->where('id',121)->first()->custom_text }} <span class="text-danger qty-alert">({{ $websiteLang->where('id',432)->first()->custom_text }}-{{ $package->number_of_photo }})</span></label>
                    <div class="medicine_row_input">
                      <input type="file" name="image[]">
                      <button type="button" id="add_row"><i class="fas fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>
              </div>
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
                <div class="col-xl-6 col-md-6">
                    <div id="medicine_row2">
                    <label for="name">{{ $websiteLang->where('id',122)->first()->custom_text }} <span class="text-danger qty-alert">({{ $websiteLang->where('id',433)->first()->custom_text }}-{{ $package->number_of_video }})</span></label>
                        <div class="medicine_row_input inpiut_pad">
                        <input type="text" name="video[]">
                        <button type="button" id="add_row2"><i class="fas fa-plus" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
              @endif
            </div>
          </div>
          <div class="my_listing list_mar list_padding">
            <h4>{{ $websiteLang->where('id',101)->first()->custom_text }}</h4>
            <div class="row">
              <div class="col-xl-12">
                <div class="my_listing_single list_mar">
                  <label><label>{{ $websiteLang->where('id',102)->first()->custom_text }} <span class="text-danger">*</span></label></label>
                  <div class="input_area input_area_2">
                    <textarea cols="3" rows="5" name="sort_description">{{ old('sort_description') }}</textarea>
                  </div>
                </div>
              </div>
              <div class="col-xl-12">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',103)->first()->custom_text }} <span class="text-danger">*</span></label>
                  <textarea class="form-control summer_note"name="description">{{ old('description') }}</textarea>
                </div>
              </div>
            </div>
          </div>
          @if ($package->number_of_aminities==-1)
            <div class="my_listing list_mar list_padding">
                <h4>{{ $websiteLang->where('id',104)->first()->custom_text }} <span class="text-danger qty-alert" >({{ $websiteLang->where('id',425)->first()->custom_text }})</span></h4>
                <div class="row">
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
                        @else
                            <div class="col-xl-6 col-xxl-4 col-md-6">
                                <div class="amenities_check_area">
                                <div class="wsus__pro_check">
                                    <div class="form-check">
                                        <input class="form-check-input unlim-is-check" type="checkbox" id="aminity-{{ $aminity->id }}" name="aminities[]" value="{{ $aminity->id }}">
                                        <label class="form-check-label" for="aminity-{{ $aminity->id }}">{{ $aminity->aminity }}
                                        </label>
                                    </div>
                                </div>
                                <i class="{{ $aminity->icon }}"></i>
                                </div>
                            </div>
                        @endif


                    @endforeach

                    @php
                        $aminityList=[];
                        foreach ($aminities as $index => $aminity) {
                            $aminityList[]=$aminity->id;
                        }
                    @endphp
                    <input type="hidden"  id="aminityQty" value="{{ $package->number_of_aminities }}">

                </div>
            </div>
          @else
            <div class="my_listing list_mar list_padding">
                <h4>{{ $websiteLang->where('id',104)->first()->custom_text }} <span class="text-danger qty-alert" >({{ $websiteLang->where('id',434)->first()->custom_text }}-{{ $package->number_of_aminities }})</span></h4>
                <div class="row">
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

                    @else
                        <div class="col-xl-6 col-xxl-4 col-md-6">
                            <div class="amenities_check_area">
                            <div class="wsus__pro_check">
                                <div class="form-check">
                                    <input class="form-check-input is-check" type="checkbox" id="aminity-{{ $aminity->id }}" name="aminities[]" value="{{ $aminity->id }}">
                                    <label class="form-check-label" for="aminity-{{ $aminity->id }}">{{ $aminity->aminity }}
                                    </label>
                                </div>
                            </div>
                            <i class="{{ $aminity->icon }}"></i>
                            </div>
                        </div>
                    @endif
                    @endforeach

                    @php
                        $aminityList=[];
                        foreach ($aminities as $index => $aminity) {
                            $aminityList[]=$aminity->id;
                        }
                    @endphp

                    <input type="hidden"  id="aminityQty" value="{{ $package->number_of_aminities }}">

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
                    <input name="facebook" type="text" value="{{ old('facebook') }}">
                    <i class="fab fa-facebook-f"></i>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',107)->first()->custom_text }}</label>
                  <div class="input_area">
                    <input name="twitter" value="{{ old('twitter') }}" type="text">
                    <i class="fab fa-twitter"></i>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',108)->first()->custom_text }}</label>
                  <div class="input_area">
                    <input type="text" name="linkedin" type="text" value="{{ old('linkedin') }}">
                    <i class="fab fa-linkedin-in"></i>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',109)->first()->custom_text }}</label>
                  <div class="input_area">
                    <input name="whatsapp" type="text"  value="{{ old('whatsapp') }}">
                    <i class="fab fa-whatsapp"></i>
                  </div>
                </div>
              </div>

              <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',110)->first()->custom_text }}</label>
                  <div class="input_area">
                    <input name="instagram" type="text" value="{{ old('instagram') }}">
                    <i class="fab fa-instagram"></i>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',111)->first()->custom_text }}</label>
                  <div class="input_area">
                    <input name="pinterest" type="text" value="{{ old('pinterest') }}">
                    <i class="fab fa-pinterest"></i>
                  </div>
                </div>
              </div>

              <div class="col-xl-6 col-md-6">
                <div class="my_listing_single">
                  <label>{{ $websiteLang->where('id',113)->first()->custom_text }}</label>
                  <div class="input_area">
                    <input name="youtube" type="text" value="{{ old('youtube') }}">
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
                                    <option value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                    <option value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
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
                                    <option value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                    <option value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
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
                      <input name="seo_title" type="text" value="{{ old('seo_title') }}">
                      <i class="fal fa-envelope"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',116)->first()->custom_text }}</label>
                  <div class="input_area">
                    <textarea cols="3" rows="5"  name="seo_description">{{ old('seo_description') }}</textarea>
                    <i class="fal fa-envelope"></i>
                  </div>
                </div>
                <button type="submit" class="read_btn">{{ $websiteLang->where('id',117)->first()->custom_text }}</button>
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
            //start handle aminity
            $(".is-check").on("click",function(e){
                var ids = [];
                var aminityList=<?= json_encode($aminityList)?>;
                var maxAminity= <?= $package->number_of_aminities ?>;
                $('input[name="aminities[]"]:checked').each(function() {
                    ids.push(this.value);
                });
                var idsLenth=ids.length;

                const checkedIds = ids.map((i) => Number(i));

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


            $("#title").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })

            $('.summernote').summernote();

            var max_image      = '{{ $package->number_of_photo }}';
            var img=1;
            var max_video='{{ $package->number_of_video }}';
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
            // end unlimited image

            // for video
            $("#add_row2").on('click', function() {
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
