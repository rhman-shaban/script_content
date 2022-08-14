@php
    $setting=App\Setting::first();
    $topbar_contact=App\ContactUs::first();
    $menus=App\Navigation::all();
    $customPages=App\CustomPage::where('status',1)->get();
    $authSetting=App\Setting::first();
    $loginModal=$menus->where('id',12)->first();
    $isRegister=$menus->where('id',11)->first();
    $isForgetPass=$menus->where('id',13)->first();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />

    @yield('title')
    @yield('meta')

    <link rel="icon" type="image/png" href="{{  $setting->favicon ? asset( $setting->favicon) : '' }}">
    <link rel="stylesheet" href="{{ asset('user/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/dev.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/responsive.css') }}">

    @if ($setting->text_direction=="RTL")
    <link rel="stylesheet" href="{{ asset('user/css/rtl.css') }}">
    @endif

     <!--jquery library js-->
     <script src="{{ asset('user/js/jquery-3.6.0.min.js') }}"></script>
     {{-- recaptcha --}}
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
     {{-- stripe --}}
     <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
     <script src="{{ asset('toastr/sweetalert2@11.js') }}"></script>

     <style>


         /* start color one */

         .wsus__topbar_login,
         .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable,
         .read_btn,
         .wsus__heading_area h2::before,
         .wsus__heading_area h2::after,
         .scroll_btn,
         .wsus__counter_top_video a,
         .wsus__category_text_center i,
         #wsus__featured_listing .slick-dots li button,
         .member_price h4,
         .single_blog:hover,
         .subs_form form button:hover,
         .listing_det_header_text .rating b,
         .wsus__listing_review h4 span,
         .wsus__total_rating h4,
         .about_img .venobox i,
         #wsus__login_popup .nav-pills .nav-link.active,
         .blog_search button,
         .wsus__single_comment_heading span,
         .active_inactive h6 span,
         .razorpay-payment-button {
            background: {{ $setting->theme_one }} !important;
        }
        #wsus__topbar,
        #wsus__login_popup .nav-pills .nav-link{
            background: {{ $setting->theme_one."40" }} !important;
        }
        .blog_search input {
            border: 1px solid {{ $setting->theme_one }} !important;
        }

        .wsus__single_comment_img img{
            border: 2px solid {{ $setting->theme_one }} !important;
        }
        .listing_det_side_address ul li a:hover {
            background: {{ $setting->theme_one }} !important;
            color: #D5DEFF !important;
        }
        .listing_det_header_text ul li:last-child a:hover,
        .listing_det_header_text ul li:last-child a {
            background: {{ $setting->theme_one }} !important;
        }
        #pagination .page-item .page-link:hover {
            color: #fff;
            background-color: {{ $setting->theme_one }} !important;
        }
        #pagination .page-item .page-link {
            border:1px solid {{ $setting->theme_one }} !important;
        }
        #pagination .page-item.active .page-link {
            color: #fff;
            background: {{ $setting->theme_one }} !important;
        }
        .map_popup_text .call:hover,
        .map_popup_text .mail:hover {
            color: {{ $setting->theme_one }} !important;
        }
        .wsus__featured_single .love:hover a{
            color: #fff !important;
        }
        .form-check-input:checked {
            background-color: {{ $setting->theme_one }} !important;
        }
        .footer_icon li a:hover {
            color: #fff;
            background: {{ $setting->theme_one }} !important;
            border-color: {{ $setting->theme_one }} !important;
        }
        .single_blog:hover .read_btn {
            background: #fff !important;
            color: {{ $setting->theme_one }} !important;
        }
        .single_blog .read_btn:hover {
            background: {{ $setting->theme_two }} !important;
            color: #fff !important;
        }
        #wsus__featured_listing .slick-dots li.slick-active button{
            background: {{ $setting->theme_one }} !important;
            opacity:0.6;
        }

        .wsus__location_filter button.active,
        .wsus__location_filter button:hover {
            background: {{ $setting->theme_one }} !important;
            color: #fff;
        }

        .member_price{
            /* border-bottom: 5px solid {{ $setting->theme_one }} !important; */
        }

        .member_price a{
            color: {{ $setting->theme_one }} !important;
            border: 1px solid {{ $setting->theme_one }} !important;
        }

        .member_price:hover a {
            background: {{ $setting->theme_one }} !important;
            color: #fff !important;
        }

        .member_price:hover h4 {
            border-color: {{ $setting->theme_one }} !important;
            color: {{ $setting->theme_one }} !important;
            ;
            background: #fff !important;
        }


        @keyframes animate {
            0% {
                box-shadow: 0 0 0 0 {{ $setting->theme_one }};
            }
            40% {
                box-shadow: 0 0 0 50px rgba(255, 193, 7, 0);
            }
            80% {
                box-shadow: 0 0 0 50px rgba(255, 193, 7, 0);
            }
            100% {
                box-shadow: 0 0 0 rgba(255, 193, 7, 0);
            }
        }


        .wsus__feature_single {
            background: {{ $setting->theme_one }} !important;
            opacity: 0.8;
        }

        .wsus__feature_single:hover {
            background: {{ $setting->theme_one }} !important;
            opacity: 10;
        }

        .wsus__feature_single span {
            color: {{ $setting->theme_one }} !important;
            border: 5px solid {{ $setting->theme_one }} !important;
        }

        .wsus__feature_single:hover span {
            color: #fff !important;
            border-color: #fff !important;
            background: {{ $setting->theme_one }} !important;
        }


        .wsus__topbar_left li a,
        .wsus__topbar_right li a,
        .menu_droapdown li a:hover,
        .menu_droapdown li a.droap_active,
        .wsus__featured_single_text h6:hover a,
        .member_price h5,
        .member_price span,
        .footer_bottom_link li a:hover,
        .wsus__property_topbar_left ul li a.wsus_active_bar,
        .wsus__featured_single .map,
        .wsus__featured_single .love,
        .listing_det_video_img .venobox i,
        .sidebar_blog_single:hover .sidebar_blog_text h5,
        .listing_det_side_address a,
        .listing_det_side_address p,
        .listing_det_side_address p i,
        .listing_det_side_address a i,
        .contact_box_icon i,
        .contact_box_text a,
        .contact_box_text p,
        .main_blog_header li a:hover {
            color: {{ $setting->theme_one }} !important;
        }
        .wsus__payment .nav-tabs .nav-link.active,
        .wsus__payment .nav-tabs .nav-link:hover {
            color: #fff !important;
            background: {{ $setting->theme_one }} !important;
            border-color: {{ $setting->theme_one }} !important;
        }
        .wsus__payment .nav-link {
            color: {{  $setting->theme_one  }} !important;
            border-color: {{ $setting->theme_one }} !important;
        }
        .wsus__payment .nav-tabs {
            border-bottom: 1px solid {{ $setting->theme_one }} !important;
        }
        .wsus__featured_single .love:hover,
        .wsus__featured_single .map:hover {
            background: {{ $setting->theme_one }} !important;
            color: #fff !important;
        }

        .main_menu .nav-item:hover>a, .main_menu li a.active,
        .wsus__featured_single .love a {
            color: {{ $setting->theme_one }} !important;
        }

        .menu_droapdown{
            border-top: 1px solid {{ $setting->theme_one }} !important;
        }

        .right_menu .signin,
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid {{ $setting->theme_one }} !important;
        }

        .right_menu .signin a:hover, .right_menu .signin a.active {
            background: {{ $setting->theme_one }} !important;
            color:#fff !important;
        }

        /* end color one */

        /* start color two */
        .wsus__topbar_login:hover,
        .subs_form form button,
        footer {
            background: {{ $setting->theme_two }} !important;
        }

        .wsus__topbar_left li a:hover,
        .wsus__topbar_right li a:hover {
            color: {{ $setting->theme_two }} !important;
        }

        /* end color two */

        .wsus__topbar_right li:last-child a {
            color: #fff !important;
        }


     </style>
</head>
<body>
    <!--==========================
        TOPBAR PART START
    ===========================-->
    <section id="wsus__topbar">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-7 d-none d-md-block">
                    <ul class="wsus__topbar_left">

                        @if ($topbar_contact->topbar_email)
                            <li><a href="{{ $topbar_contact->topbar_email }}"><i class="fal fa-envelope"></i> {{ $topbar_contact->topbar_email }}</a></li>
                        @endif

                        @if ($topbar_contact->topbar_phone)
                            <li><a href="callto:{{ $topbar_contact->topbar_phone }}"><i class="fal fa-phone-alt"></i>{{ $topbar_contact->topbar_phone }}</a></li>
                        @endif
                    </ul>
                </div>
                <div class="col-xl-6 col-md-5">
                    <ul class="wsus__topbar_right">

                        @if ($topbar_contact->facebook)
                            <li><a href="{{ $topbar_contact->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                        @endif

                        @if ($topbar_contact->twitter)
                            <li><a href="{{ $topbar_contact->twitter }}"><i class="fab fa-twitter"></i></a></li>
                        @endif

                        @if ($topbar_contact->linkedin)
                            <li><a href="{{ $topbar_contact->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                        @endif

                           @if ($topbar_contact->youtube)
                            <li>
                                <a href="{{ $topbar_contact->youtube }}" class="fab fa-youtube"></a>
                            </li>
                           @endif
                           @if ($topbar_contact->instagram)
                            <li>
                                <a href="{{ $topbar_contact->instagram }}" class="fab fa-instagram"></a>
                            </li>
                           @endif

                        @php
                            $isLogin=$menus->where('id',12)->first();
                            $dashboard=$menus->where('id',10)->first();
                        @endphp
                         @if ($isLogin->status==1)
                            @guest
                                <li><a class="wsus__topbar_login" data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript::void"><i class="far fa-sign-in-alt"></i> {{ $isLogin->navbar }}</a></li>
                            @else
                                <li><a class="wsus__topbar_login" href="{{ route('user.dashboard') }}"><i class="far fa-sign-in-alt"></i> {{ $dashboard->navbar }}</a></li>
                            @endguest
                         @endif

                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--==========================
        TOPBAR PART END
    ===========================-->



    <!--==========================
        LOG IN POPUP START
    ===========================-->
    <section id="wsus__login_popup">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $websiteLang->where('id',57)->first()->custom_text }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">{{ $loginModal->navbar }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{ $isRegister->navbar }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">{{ $isForgetPass->navbar }}</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form id="loginFormSubmit">
                                @csrf
                                <input type="email" placeholder="{{ $websiteLang->where('id',24)->first()->custom_text }} *" name="email">
                                <input type="password" placeholder="{{ $websiteLang->where('id',61)->first()->custom_text }} *" name="password">
                                @if($authSetting->allow_captcha==1)
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{ $authSetting->captcha_key }}"></div>
                                </div>
                                @endif
                                <button class="read_btn" id="loginSubmitBtn" type="submit"><i id="login-spinner" class="loading-icon fas fa-sync fa-spin d-none"></i> {{ $websiteLang->where('id',58)->first()->custom_text }}</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <form id="registerFormSubmit">
                                @csrf
                                <input type="text" placeholder="{{ $websiteLang->where('id',37)->first()->custom_text }} *" name="name">
                                <input type="email" placeholder="{{ $websiteLang->where('id',38)->first()->custom_text }} *" name="email">
                                <input type="password" placeholder="{{ $websiteLang->where('id',61)->first()->custom_text }} *" name="password">
                                @if($authSetting->allow_captcha==1)
                                <div class="g-recaptcha" data-sitekey="{{ $authSetting->captcha_key }}"></div>
                                @endif

                                <button id="registerBtn" class="read_btn" type="submit"> <i id="reg-spinner" class="loading-icon fas fa-sync fa-spin d-none"></i> {{ $websiteLang->where('id',59)->first()->custom_text }}</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <form id="forgetPassFormSubmit">
                                @csrf
                                <input type="email" placeholder="{{ $websiteLang->where('id',38)->first()->custom_text }} *" name="email">
                                @if($authSetting->allow_captcha==1)
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ $authSetting->captcha_key }}"></div>
                                    </div>
                                @endif

                                <button id="forgetPassBtn" class="read_btn" type="submit"><i id="forget-spinner" class="loading-icon fas fa-sync fa-spin d-none"></i> {{ $websiteLang->where('id',60)->first()->custom_text }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    <!--==========================
       LOG IN POPUP END
    ===========================-->



    <!--==========================
           MENU PART START
    ===========================-->
    <nav class="navbar navbar-expand-lg main_menu">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ $setting->logo ? asset($setting->logo) : '' }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="far fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">


                    @php
                        $isHomePage=$menus->where('id',1)->first();
                    @endphp
                    @if ($isHomePage->status==1)

                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">{{ $isHomePage->navbar }}</a>
                        </li>

                    @endif

                    @php
                            $isListing=$menus->where('id',2)->first();
                        @endphp
                    @if ($isListing->status==1)
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('listings') || Route::is('listing.show') ? 'active' : '' }}" href="{{ route('listings',['page_type'=>'list_view']) }}">{{ $isListing->navbar }}</a>
                        </li>
                    @endif

                    @php
                        $isPricing=$menus->where('id',5)->first();
                    @endphp
                    @if ($isPricing->status==1)
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('pricing.plan') ? 'active' : '' }}" href="{{ route('pricing.plan') }}">{{ $isPricing->navbar }}</a>
                        </li>
                    @endif

                    @php
                        $isAboutUs=$menus->where('id',4)->first();
                    @endphp
                    @if ($isAboutUs->status==1)
                        <li class="nav-item">
                            <a class="nav-link  {{ Route::is('about.us') ? 'active' : '' }}" href="{{ route('about.us') }}">{{ $isAboutUs->navbar }}</a>
                        </li>
                    @endif


                    @php
                        $isPages=$menus->where('id',3)->first();
                    @endphp
                    @if ($isPages->status==1)
                    <li class="nav-item">
                        <a class="nav-link" href="javascript::void">{{ $isPages->navbar }} <i class="far fa-chevron-down"></i></a>
                        <ul class="menu_droapdown">

                            @php
                                $isListingCategory=$menus->where('id',6)->first();
                            @endphp
                            @if ($isListingCategory->status==1)
                            <li><a class=" {{ Route::is('listing.category') ? 'active' : '' }}" href="{{ route('listing.category') }}">{{ $isListingCategory->navbar }}</a></li>
                            @endif

                            @if ($customPages->count()>0)
                                @foreach ($customPages as $customPage)
                                    <li><a href="{{ route('custom.page',$customPage->slug) }}">{{ $customPage->page_name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </li>

                    @endif


                    @php
                        $isBlog=$menus->where('id',7)->first();
                    @endphp
                    @if ($isBlog->status==1)
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('blog') || Route::is('blog.details') ? 'active' : '' }}" href="{{ route('blog') }}">{{ $isBlog->navbar }}</a>
                        </li>
                    @endif


                    @php
                        $isContact=$menus->where('id',8)->first();
                    @endphp
                    @if ($isContact->status==1)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('contact.us') ? 'active' : '' }}" href="{{ route('contact.us') }}">{{ $isContact->navbar }}</a>
                    </li>

                    @endif


                </ul>


                @php
                    $isNewListing=$menus->where('id',9)->first();
                @endphp
                @if ($isNewListing->status==1)
                    @auth
                        <ul class="right_menu">
                            <li class="nav-item signin">
                                <a class="nav-link" href="{{ route('user.create.listing') }}"><i class="far fa-plus-circle"></i> {{ $isNewListing->navbar }}</a>
                            </li>
                        </ul>
                    @else
                        <ul class="right_menu">
                            <li class="nav-item signin">
                                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"><i class="far fa-plus-circle"></i> {{ $isNewListing->navbar }}</a>
                            </li>
                        </ul>
                    @endauth
                @endif

            </div>
        </div>
    </nav>
    <!--==========================
           MENU PART END
    ===========================-->
