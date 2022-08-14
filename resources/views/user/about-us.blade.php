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
                    <h4>{{ $menus->where('id',4)->first()->navbar }}</h4>
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{ $menus->where('id',1)->first()->navbar }} </a></li>
                            <li class="breadcrumb-item active" aria-current="page"> {{ $menus->where('id',4)->first()->navbar }} </li>
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
         ABOUT  START
    ===========================-->

    @php
        $about_section=$section->where('id',1)->first();
    @endphp
    @if ($about_section->show_homepage==1)
    <section id="about_page">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 m-auto">
                    <div class="wsus__heading_area">
                        <i class="{{ $about_section->icon }}"></i>
                        <h2>{{ $about_section->header }}</h2>
                        <p>{{ $about_section->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="about_text">
                        {!! clean($about->description) !!}
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 m-auto">
                    <div class="about_img">
                        <img src="{{ $about->background_image ? $about->background_image : '' }}" alt="about" class="img-fluid w-100">
                        <a class="venobox" data-autoplay="true" data-vbtype="video" href="{{ $about->video_link }}">
                            <i class=" fas fa-play"></i>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--==========================
         ABOUT END
    ===========================-->


    <!--==========================
        FEATURES PART START
    ===========================-->

    @php
        $feature_section=$section->where('id',2)->first();
        $features=$features->take($feature_section->content_quantity);
    @endphp
    @if ($feature_section->show_homepage==1)
        <section id="wsus__features" class="about_page_features_mar">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 m-auto">
                        <div class="wsus__heading_area">
                            <i class="{{ $feature_section->icon }}"></i>
                            <h2>{{ $feature_section->header }}</h2>
                            <p>{{ $feature_section->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($features as $index => $feature)
                        <div class="col-xl-4 col-md-6">
                            <div class="wsus__feature_single">
                                <i class="{{ $feature->icon }}"></i>
                                <h5>{{ $feature->title }}</h5>
                                <p>{{ $feature->description }}</p>
                                <span>{{ ++$index }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!--==========================
        FEATURES PART END
    ===========================-->



    <!--==========================
        CATEGORY SLIDER START
    ===========================-->

    @php
        $partner_section=$section->where('id',4)->first();
        $partners=$partners->take($partner_section->content_quantity);
    @endphp
    @if ($partner_section->show_homepage==1)
    <section id="about_page_category_slider">
        <div class="container">
            <div class="row about_page_slider">

                @foreach ($partners as $partner)
                <div class="col-xl-2">
                    <a href="{{ $partner->link ? $partner->link : '' }}" class="about_slider_single">
                        <img src="{{ asset($partner->image) }}" alt="logo" class="img-fluid w-100">
                    </a>
                </div>
               @endforeach
            </div>
        </div>
    </section>
    @endif
    <!--==========================
        CATEGORY SLIDER END
    ===========================-->




    <!--==========================
        COUNTER PART START
    ===========================-->

    @php
    $overview_section=$section->where('id',3)->first();
    @endphp
    @if ($overview_section->show_homepage==1)
    <section id="wsus__counter">
        <div class="wsus__counter_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 m-auto">
                        <div class="wsus__heading_area">
                            <i class="{{ $overview_section->icon }}"></i>
                            <h2>{{ $overview_section->header }}</h2>
                            <p>{{ $overview_section->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-9">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="wsus__counter_top_text">
                                    <h5>{{ $overview_section->short_title }}</h5>
                                </div>
                            </div>
                            @foreach ($overviews as $overview)
                            <div class="col-xl-3 col-6 col-md-3">
                                <div class="wsus__counter_single">
                                    <span class="counter">{{ $overview->qty }}</span>
                                    <p>{{ $overview->name }}</p>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 m-auto">
                        <div class="wsus__counter_top_video">
                            @php
                                $video_id=explode("=",$overviewVideo);
                            @endphp

                            <img src="https://img.youtube.com/vi/{{ $video_id[1] }}/0.jpg" alt="img" class="img-fluid w-100">
                            <a class="venobox" data-autoplay="true" data-vbtype="video" href="{{ $overviewVideo  }}">
                                <i class=" fas fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--==========================
        COUNTER PART END
    ===========================-->
@endsection
