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
                    <h4>{{ $menus->where('id',5)->first()->navbar }}</h4>
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{ $menus->where('id',1)->first()->navbar }} </a></li>
                            <li class="breadcrumb-item active" aria-current="page"> {{ $menus->where('id',5)->first()->navbar }} </li>
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
        OUR PACKAGE START
    ===========================-->

    @php
        $package_section=$sections->where('id',1)->first();
        $listingPackages=$listingPackages->take($package_section->content_quantity);
    @endphp
    @if ($package_section->show_homepage==1)
    <section id="wsus__package" style="background-image:url({{ $bannerImages->where('id',20)->first()->image ? asset($bannerImages->where('id',13)->first()->image) : '' }});">
        <div class="wsus__package_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 m-auto">
                        <div class="wsus__heading_area">
                            <i class="{{ $package_section->icon }}"></i>
                            <h2>{{ $package_section->header }} </h2>
                            <p>{{ $package_section->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="procing_area">
                    <div class="row">
                    @foreach ($listingPackages as $index=> $listingPackage)
                        @php
                            $unlimited=$websiteLang->where('id',425)->first()->custom_text;
                        @endphp
                        <div class="col-xl-4 col-sm-6 col-lg-4">
                            <div class="member_price">
                                <h4>{{ $listingPackage->package_name }}</h4>
                                <h5>{{ $currency->currency_icon }}{{ $listingPackage->price }}</h5>
                                <span>{{ $listingPackage->number_of_days == -1 ? $unlimited : $listingPackage->number_of_days }} {{ $websiteLang->where('id',14)->first()->custom_text }}</span>


                                <p>{{ $listingPackage->number_of_listing==-1 ? $unlimited : $listingPackage->number_of_listing  }} {{ $websiteLang->where('id',15)->first()->custom_text }}</p>

                                @if ($listingPackage->number_of_days != -1)
                                <p>{{ $listingPackage->number_of_days }} {{ $websiteLang->where('id',16)->first()->custom_text }}</p>
                                @else
                                <p>{{ $unlimited }} {{ $websiteLang->where('id',16)->first()->custom_text }}</p>
                                @endif




                                <p>{{ $listingPackage->number_of_aminities== -1 ? $unlimited : $listingPackage->number_of_aminities }} {{ $websiteLang->where('id',17)->first()->custom_text }}</p>


                                <p>{{ $listingPackage->number_of_photo == -1 ? $unlimited : $listingPackage->number_of_photo }} {{ $websiteLang->where('id',18)->first()->custom_text }}</p>
                                <p>{{ $listingPackage->number_of_video ==-1 ? $unlimited : $listingPackage->number_of_video }} {{ $websiteLang->where('id',19)->first()->custom_text }}</p>
                                @if ($listingPackage->is_featured ==1)
                                <p>{{ $websiteLang->where('id',20)->first()->custom_text }}</p>
                                <p>{{ $listingPackage->number_of_feature_listing == -1 ? $unlimited : $listingPackage->number_of_feature_listing }} {{ $websiteLang->where('id',21)->first()->custom_text }}</p>
                                @else
                                <p>{{ $websiteLang->where('id',441)->first()->custom_text }}</p>
                                <p>0 {{ $websiteLang->where('id',21)->first()->custom_text }}</p>
                                @endif

                                @auth

                                @if ($listingPackage->package_type==0)
                                    <a href="javascript:void(0)" class="EnrollBtn" data-id="{{ $listingPackage->id }}">{{ $websiteLang->where('id',13)->first()->custom_text }}</a>
                                @else
                                    <a href="{{ route('user.purchase.package',$listingPackage->id) }}">{{ $websiteLang->where('id',13)->first()->custom_text }}</a>
                                @endif





                                @else
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript::void">{{ $websiteLang->where('id',13)->first()->custom_text }}</a>
                                @endif

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--==========================
        OUR PACKAGE END
    ===========================-->


     <!--==========================
       SUBSCRIBE PART START
    ===========================-->

    @php
    $subscribe_section=$sections->where('id',2)->first();
@endphp
@if ($subscribe_section->show_homepage==1)

    <section id="subscribe">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-12 col-md-10 col-lg-8 col-xl-6">
                    <div class="subs_text">
                        <h3>{{ $subscribe_section->header }}</h3>
                        <p>{{ $subscribe_section->description }}</p>
                    </div>
                </div>
                <div class="col-xxl-6 col-12 col-md-10 col-lg-8 col-xl-6">
                    <div class="subs_form">
                        <form id="subscribeForm">
                            <input id="subscribe_email" name="email" type="text" placeholder="{{ $websiteLang->where('id',24)->first()->custom_text }}" >
                            <button  id="subscribeBtn" type="submit"><i id="subscribe-spinner" class="loading-icon fas fa-sync fa-spin d-none"></i>  {{ $websiteLang->where('id',23)->first()->custom_text }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
    <!--==========================
       SUBSCRIBE PART END
    ===========================-->

@endsection
