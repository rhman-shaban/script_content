@php
    $section= App\HomeSection::all();
    $menus= App\Navigation::all();
    $image= App\BannerImage::find(24);
    $websiteLang= App\ManageText::all();
    $error_505=App\ErrorPage::find(3);
@endphp

@extends('layouts.user.layout')
@section('title')
    <title>{{ $error_505->page_name }}</title>
@endsection
@section('user-content')

    <!--==========================
         BREADCRUMB PART START
    ===========================-->
    {{-- <div id="breadcrumb_part" style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
        <div class="bread_overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center text-white">
                        <h4>{{ $error_505->page_name }}</h4>
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{ $menus->where('id',1)->first()->navbar }} </a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $error_505->page_name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!--==========================
         BREADCRUMB PART END
    ===========================-->



    <!--==========================
        404 PAGE START
    ===========================-->
    <section id="wsws__404_page">
        <div class="container">
            <div class="row">
                {{-- <div class="col-xl-8 m-auto">
                    <div class="wsus__404_images">
                        <img src="{{ asset($error_505->image) }}" alt="error img" class="img-fluid w-100">
                    </div>
                </div> --}}
                <div class="col-xl-8 col-md-10 m-auto">
                    <div class="wsus__404_text">
                        <h1>{{ $error_505->page_number }}</h1>
                        <h3> {{-- <span>{{ $error_505->first_header }} --}}</span> {{ $error_505->second_header }}</h3>
                        {{-- <p>{{ $error_505->description }}</p> --}}
                        <a href="{{ route('home') }}" class="read_btn">{{ $error_505->button_text }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==========================
        404 PAGE END
    ===========================-->
@endsection
