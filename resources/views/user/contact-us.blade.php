@extends('layouts.user.layout')
@section('title')
    <title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $seo_text->meta_description }}">
@endsection

@section('user-content')
 <!--==========================
         BREADCRUMB PART START
    ===========================-->
    <div id="breadcrumb_part" style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
        <div class="bread_overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center text-white">
                        <h4>{{ $menus->where('id',8)->first()->navbar }}</h4>
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{ $menus->where('id',1)->first()->navbar }} </a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $menus->where('id',8)->first()->navbar }} </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==========================
         BREADCRUMB PART END
    ===========================-->



    <!--==========================
        GET IN TOUCH START
    ===========================-->
    <section id="get_in_touch">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-5 col-lg-5">
                    <h2>{{ $contact->header }}</h2>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="contact_box">
                                <div class="contact_box_icon">
                                    <i class="fal fa-phone-square-alt"></i>
                                </div>
                                <div class="contact_box_text">
                                    {!! clean(nl2br($contact->phones)) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="contact_box">
                                <div class="contact_box_icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact_box_text">
                                    {!! clean(nl2br($contact->emails)) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="contact_box">
                                <div class="contact_box_icon">
                                    <i class="fal fa-map-marker-alt"></i>
                                </div>
                                <div class="contact_box_text">
                                    <p>{!! clean(nl2br($contact->address)) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-md-7 col-lg-7">
                    <h2>{{ $websiteLang->where('id',36)->first()->custom_text }}</h2>
                    <form  id="contactForm">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="contact_input">
                                    <input type="text" placeholder="{{ $websiteLang->where('id',37)->first()->custom_text }}" value="{{ old('name') }}" name="name">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contact_input">
                                    <input type="email" value="{{ old('email') }}" placeholder="{{ $websiteLang->where('id',38)->first()->custom_text }}" name="email">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contact_input">
                                    <input type="text" value="{{ old('phone') }}" placeholder="{{ $websiteLang->where('id',39)->first()->custom_text }}" name="phone">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contact_input">
                                    <input type="text" name="subject" value="{{ old('subject') }}" placeholder="{{ $websiteLang->where('id',40)->first()->custom_text }}">
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="contact_input">
                                    <textarea name="message" cols="3" rows="5" placeholder="{{ $websiteLang->where('id',41)->first()->custom_text }}">{{ old('message') }}</textarea>
                                </div>
                            </div>

                            @if($contactSetting->allow_captcha==1)
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ $contactSetting->captcha_key }}"></div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-xl-12">
                                <div class="contact_input">
                                    <button id="contactBtn" class="read_btn" type="submit"><i id="contact-spinner" class="loading-icon fas fa-sync fa-spin d-none"></i> {{ $websiteLang->where('id',42)->first()->custom_text }}</button>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="contact_map">
                        {!! $contact->map_embed_code !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==========================
        GET IN TOUCH END
    ===========================-->


<script>
    (function($) {
    "use strict";
    $(document).ready(function () {
        $("#contactBtn").on('click',function(e) {

            // project demo mode check
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            // end

            e.preventDefault();
            $("#contact-spinner").removeClass('d-none')
            $("#contactBtn").addClass('custom-opacity')
            $("#contactBtn").removeClass('site-btn-effect')
            $("#contactBtn").attr('disabled',true);
            $.ajax({
                url: "{{ route('contact.message') }}",
                type:"post",
                data:$('#contactForm').serialize(),
                success:function(response){
                    if(response.success){
                        $("#contactForm").trigger("reset");
                        $("#contact-spinner").addClass('d-none')
                        $("#contactBtn").removeClass('custom-opacity')
                        $("#contactBtn").attr('disabled',false);
                        $("#contactBtn").addClass('site-btn-effect')

                        toastr.success(response.success)
                        console.log(response);

                    }
                    if(response.error){
                        toastr.error(response.error)
                    }
                },
                error:function(response){
                    if(response.responseJSON.errors.name){
                        $("#contact-spinner").addClass('d-none')
                        $("#contactBtn").removeClass('custom-opacity')
                        $("#contactBtn").attr('disabled',false);
                        $("#contactBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.name[0])
                    }

                    if(response.responseJSON.errors.email){
                        $("#contact-spinner").addClass('d-none')
                        $("#contactBtn").removeClass('custom-opacity')
                        $("#contactBtn").attr('disabled',false);
                        $("#contactBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.email[0])
                    }

                    if(response.responseJSON.errors.subject){
                        $("#contact-spinner").addClass('d-none')
                        $("#contactBtn").removeClass('custom-opacity')
                        $("#contactBtn").attr('disabled',false);
                        $("#contactBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.subject[0])
                    }

                    if(response.responseJSON.errors.message){
                        $("#contact-spinner").addClass('d-none')
                        $("#contactBtn").removeClass('custom-opacity')
                        $("#contactBtn").attr('disabled',false);
                        $("#contactBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.message[0])
                    }


                    if(response.responseJSON.errors.email || response.responseJSON.errors.name || response.responseJSON.errors.subject || response.responseJSON.errors.message){}else{
                        toastr.error('Please Complete the recaptcha to submit the form')
                        $("#contact-spinner").addClass('d-none')
                        $("#contactBtn").removeClass('custom-opacity')
                        $("#contactBtn").attr('disabled',false);
                        $("#contactBtn").addClass('site-btn-effect')
                    }



                }

            });


        })

    });

    })(jQuery);
</script>


@endsection
