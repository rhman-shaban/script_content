@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',72)->first()->custom_text }}</title>
@endsection

@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 col-xxl-10 ms-auto">
        <div class="dashboard_content">
          <div class="row">
            <div class="col-xl-12">
              <div class="dashboard_breadcrumb">
                <span>{{ $websiteLang->where('id',89)->first()->custom_text }}</span>
                <ul>
                  <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }} <i class="fas fa-caret-right"></i></a></li>
                  <li><a class="bread_active" href="javascript::void">{{ $websiteLang->where('id',89)->first()->custom_text }}</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="my_listing">
            <h4>{{ $websiteLang->where('id',89)->first()->custom_text }}</h4>
            <form method="POST" action="{{ route('user.update.profile') }}" enctype="multipart/form-data">
                @csrf
            <div class="row">
              <div class="col-xl-8 col-md-12">
                <div class="row">
                  <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                      <label>Name</label>
                      <div class="input_area">
                        <input type="text" name="name" type="text" value="{{ $user->name }}">
                        <i class="fas fa-user-tie"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="my_listing_single">
                      <label>{{ $websiteLang->where('id',39)->first()->custom_text }}</label>
                      <div class="input_area">
                        <input type="text" name="phone" type="text" value="{{ $user->phone }}">
                        <i class="far fa-phone-alt"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <div class="my_listing_single">
                      <label>{{ $websiteLang->where('id',38)->first()->custom_text }}</label>
                      <div class="input_area">
                        <input name="email" type="email" value="{{ $user->email }}" readonly>
                        <i class="fal fa-envelope"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <div class="my_listing_single">
                      <label>{{ $websiteLang->where('id',55)->first()->custom_text }}</label>
                      <div class="input_area">
                        <input name="address" type="text" value="{{ $user->address }}">
                        <i class="fal fa-envelope"></i>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-12">
                    <div class="my_listing_single">
                      <label>{{ $websiteLang->where('id',93)->first()->custom_text }}</label>
                      <div class="input_area">
                        <input name="website" type="text" value="{{ $user->website }}">
                        <i class="fas fa-globe"></i>

                      </div>
                    </div>
                  </div>


                  <div class="col-xl-12">
                    <div class="my_listing_single">
                      <label>{{ $websiteLang->where('id',145)->first()->custom_text }}</label>
                      <div class="input_area">
                        <textarea cols="3" rows="3" name="about">{{ $user->about }}</textarea>
                        <i class="fas fa-user-tie"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-5">
                <div class="profile_pic_upload">
                  <img src="{{ $user->image ? asset($user->image) : asset($defaultProfile) }}" alt="img" class="imf-fluid w-100">
                  <input type="file" name="image">
                </div>
              </div>
            </div>
              <div id="medicine_row3">
                <div class="row">

                    @foreach ($socialLinks as $socialLink)
                        <div class="col-xl-5 col-md-5" id="exist_link-{{ $socialLink->id }}">
                            <label for="name">{{ $websiteLang->where('id',490)->first()->custom_text }}</label>
                            <div class="medicine_row_input">
                                <input type="text" name="icons[]" class="custom-icon-picker" value="{{ $socialLink->icon }}">
                            </div>
                        </div>
                        <div class="col-xl-5 col-md-5" id="exist_icon-{{ $socialLink->id }}">
                            <label for="name">{{ $websiteLang->where('id',489)->first()->custom_text }}</label>
                            <div class="medicine_row_input">
                                <input type="text" name="links[]" value="{{ $socialLink->link }}">
                            </div>
                        </div>

                        <div class="col-xl-2 col-md-2" id="exist_btn-{{ $socialLink->id }}">
                            <div class="medicine_row_input">
                                <button type="button" id="removeRow" onclick="deleteSocialLink('{{ $socialLink->id }}')"><i class="fas fa-trash" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    @endforeach


                  <div class="col-xl-5 col-md-5">
                    <label for="name">{{ $websiteLang->where('id',490)->first()->custom_text }}</label>
                    <div class="medicine_row_input">
                      <input type="text" name="icons[]" class="custom-icon-picker">
                    </div>
                  </div>
                  <div class="col-xl-5 col-md-5">
                    <label for="name">{{ $websiteLang->where('id',489)->first()->custom_text }}</label>
                    <div class="medicine_row_input">
                      <input type="text" name="links[]">
                    </div>
                  </div>

                  @if ($socialLinks->count()<4)
                  <div class="col-xl-2 col-md-2">
                    <div class="medicine_row_input">
                      <button type="button" id="add_row3"><i class="fas fa-plus" aria-hidden="true"></i></button>
                    </div>
                  </div>
                  @endif

                  @if ($socialLinks->count()>=4)
                  <div class="col-xl-2 col-md-2 d-none" id="existAddRowBtn">
                    <div class="medicine_row_input">
                      <button type="button" id="add_row3"><i class="fas fa-plus" aria-hidden="true"></i></button>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="read_btn">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
              </div>
          </form>
          </div>
          <div class="my_listing list_mar">
            <h4>{{ $websiteLang->where('id',148)->first()->custom_text }}</h4>
            <form method="POST" action="{{ route('user.update.password') }}">
                @csrf
            <div class="row">
              <div class="col-xl-4 col-md-6">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',149)->first()->custom_text }}</label>
                  <div class="input_area">
                    <input type="password" name="current_password">
                    <i class="far fa-lock-alt"></i>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6">
                <div class="my_listing_single">
                  <label>{{ $websiteLang->where('id',149)->first()->custom_text }}</label>
                  <div class="input_area">
                    <input type="password" name="password">
                    <i class="far fa-lock-alt"></i>
                  </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="my_listing_single">
                    <label>{{ $websiteLang->where('id',67)->first()->custom_text }}</label>
                  <div class="input_area">
                    <input type="password" name="password_confirmation">
                    <i class="far fa-lock-alt"></i>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="read_btn">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
              </div>
            </div>
          </form>
          </div>

          <div class="my_listing list_mar">
            <form method="POST" action="{{ route('user.update.profile.banner') }}" enctype="multipart/form-data">
                @csrf
            <h4>{{ $websiteLang->where('id',438)->first()->custom_text }}</h4>
            <div class="row">
              <div class="col-xl-6 col-md-8 col-lg-6">
                <div class="profile_pic_upload banner_pic_upload">
                    @if ($user->banner_image)
                    <img src="{{ asset($user->banner_image) }}" alt="img" class="imf-fluid w-100">
                    @else
                    <img src="{{ asset($image->image) }}" alt="img" class="imf-fluid w-100">
                    @endif

                  <input type="file" name="banner_image">
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="read_btn">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
              </div>
            </div>
          </form>
          </div>
        </div>
    </div>
  </div>




<script>
    var limit='{{ $socialQty }}';
    (function($) {
    "use strict";
    $(document).ready(function () {

        $('.custom-icon-picker').iconpicker({
            templates: {
                popover: '<div class="iconpicker-popover popover"><div class="arrow"></div>' +
                    '<div class="popover-title"></div><div class="popover-content"></div></div>',
                footer: '<div class="popover-footer"></div>',
                buttons: '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button>' +
                    ' <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
                search: '<input type="search" class="form-control iconpicker-search" placeholder="Type to filter" />',
                iconpicker: '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
                iconpickerItem: '<a role="button" href="javascript:;" class="iconpicker-item"><i></i></a>'
            }
        })

        // for 2 input in 1 row

        $("#add_row3").on('click',function () {
            limit++;
            if(limit==4){
                $("#add_row3").addClass('d-none');
            }

            var html = '';
            html+='<div class="row remove">';
            html+='<div class="col-xl-5 col-md-5">';
            html+='<label for="name">{{ $websiteLang->where("id",490)->first()->custom_text }}</label>';
            html+='<div class="medicine_row_input">';
            html+='<input type="text" name="icons[]" class="custom-icon-picker1">';
            html+='</div>';
            html+='</div>';
            html+='<div class="col-xl-5 col-md-5">';
            html+='<label for="name">{{ $websiteLang->where("id",489)->first()->custom_text }}</label>';
            html+='<div class="medicine_row_input">';
            html+='<input type="text" name="links[]" >';
            html+='</div>';
            html+='</div>';
            html+='<div class="col-xl-2 col-md-2">';
            html+='<div class="medicine_row_input">';
            html+='<button type="button" class="removeRow" id="removeRow" ><i class="fas fa-trash" aria-hidden="true"></i></button>';
            html+=' </div>';
            html+=' </div>';
            html+='</div>';
            $("#medicine_row3").append(html)

            $('.custom-icon-picker1').iconpicker({
                templates: {
                    popover: '<div class="iconpicker-popover popover"><div class="arrow"></div>' +
                        '<div class="popover-title"></div><div class="popover-content"></div></div>',
                    footer: '<div class="popover-footer"></div>',
                    buttons: '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button>' +
                        ' <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
                    search: '<input type="search" class="form-control iconpicker-search" placeholder="Type to filter" />',
                    iconpicker: '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
                    iconpickerItem: '<a role="button" href="javascript:;" class="iconpicker-item"><i></i></a>'
                }
            })


        });

        // remove custom input field row
        $(document).on('click', '.removeRow', function () {
            $(this).closest('.remove').remove();
            limit--;
            $("#add_row3").removeClass('d-none');
        });

    });

    })(jQuery);


    function deleteSocialLink(id){
        // project demo mode check
        var isDemo="{{ env('PROJECT_MODE') }}"
         var demoNotify="{{ env('NOTIFY_TEXT') }}"
         if(isDemo==0){
             toastr.error(demoNotify);
             return;
         }
         // end
        $.ajax({
            type: 'GET',
            url: "{{ url('user/remove-social-link/') }}"+"/"+ id,
            success: function (response) {

                if(response.success){
                    toastr.success(response.success)
                    $("#exist_link-"+id).remove()
                    $("#exist_icon-"+id).remove()
                    $("#exist_btn-"+id).remove()
                    $("#add_row3").removeClass('d-none');
                    $("#existAddRowBtn").removeClass('d-none');
                    limit -= 1;
                }

            },
            error: function(err) {
                console.log(err);
            }
        });
    }
  </script>
@endsection
