@extends('layouts.user.layout')
@section('title')
    <title>{{ $menus->where('id',14)->first()->navbar }}</title>
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
                        <h4>{{ $menus->where('id',14)->first()->navbar }}</h4>
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }} </a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $menus->where('id',14)->first()->navbar }} </li>
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
    <section id="get_in_touch" class="custom_bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <form method="post" action="{{ route('store.reset.password',$token) }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="contact_input">
                                    <input type="email" name="email" placeholder="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact_input">
                                    <input type="password" name="password" placeholder="{{ $websiteLang->where('id',61)->first()->custom_text }}">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="contact_input">
                                    <input type="password" name="password_confirmation" placeholder="{{ $websiteLang->where('id',67)->first()->custom_text }}">
                                </div>
                            </div>

                            @if($setting->allow_captcha==1)
                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{ $setting->captcha_key }}"></div>
                                </div>
                            </div>
                        @endif


                            <div class="col-12">
                                <div class="contact_input">
                                    <button class="read_btn" type="submit">{{ $websiteLang->where('id',66)->first()->custom_text }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--==========================
        GET IN TOUCH END
    ===========================-->

@endsection
