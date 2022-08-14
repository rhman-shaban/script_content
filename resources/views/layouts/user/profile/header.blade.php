@php
    $setting=App\Setting::first();
    $isRtl=$setting->text_direction;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
     <!-- PAGE TITLE HERE -->
     @yield('title')
    <link rel="icon" type="image/png" href="{{ $setting->favicon ?  asset($setting->favicon) : '' }}">
    <link rel="stylesheet" href="{{ asset('user/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/iconpicker/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap4-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/timepicker/jquery.timepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/dev.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/responsive.css') }}">

    @if ($setting->text_direction=='RTL')
        <link rel="stylesheet" href="{{ asset('user/css/rtl.css') }}">
    @endif

    <!--jquery library js-->
  <script src="{{ asset('user/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('backend/iconpicker/fontawesome-iconpicker.min.js') }}"></script>
  <script src="{{ asset('toastr/sweetalert2@11.js') }}"></script>

    <style>
        .fade.in {
            opacity: 1 !important;
        }
    </style>
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
        .dashboard_link li a:hover,
        .dashboard_link li .active {
           background: {{ $setting->theme_one }} !important;
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
       .footer_link li a:hover,
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
       .main_blog_header li a:hover,
       .active_inactive_text h3:hover a,
       .dashboard_breadcrumb ul li a:hover,
       .dashboard_breadcrumb ul li .bread_active {
           color: {{ $setting->theme_one }} !important;
       }

       .dashboard_breadcrumb .read_btn:hover {
           color: #fff !important;
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
