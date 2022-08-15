@extends('layouts.user.layout')
@section('title')
    <title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $seo_text->meta_description }}">
@endsection

@section('user-content')
        <!--==========================
        BANNER PART START
    ===========================-->
    @php
        $banner_section=$section->where('id',1)->first();
    @endphp
    @if ($banner_section->show_homepage==1)
        <section id="wsus__banner" style="background-image:url({{ $banner->image ? asset($banner->image) : '' }})">
            <div class="wsus__banner_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 m-auto">
                        <div class="wsus__banner_text">
                            <h1>{{ $banner_section->header }}</h1>
                            <p>{{ $banner_section->description }}</p>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <form method="GET" action="{{ route('search-listing') }}">
                            <div class="row">
                                <div class="col-xl-3 col-sm-6 col-lg-3">
                                    <div class="wsus__search_area">
                                        <input type="text" placeholder="{{ $websiteLang->where('id',1)->first()->custom_text }}" name="search">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-lg-3" >
                                    <div class="wsus__search_area">
                                        <select class="select_2" name="category_id" name="category_id">
                                            <option value="">{{ $websiteLang->where('id',2)->first()->custom_text }}</option>
                                                @foreach ($listingCategories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-lg-3">
                                    <div class="wsus__search_area">
                                        <select class="select_2" name="location">
                                            <option value="">{{ $websiteLang->where('id',3)->first()->custom_text }}</option>
                                                @foreach ($locationsForSearch as $location)
                                                <option value="{{ $location->id }}">{{ $location->location }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="page_type" value="list_view">

                                <div class="col-xl-3 col-sm-6 col-lg-3">
                                    <div class="wsus__search_area">
                                        <button  type="submit" class="read_btn">{{ $websiteLang->where('id',4)->first()->custom_text }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </section>
    @endif
    <!--==========================
        BANNER PART END
    ===========================-->



    <!--==========================
        CATEGORY SLIDER START
    ===========================-->

    @php
        $banner_category=$section->where('id',11)->first();
    @endphp
    @if ($banner_category->show_homepage==1)
    <section id="wsus__category_slider">
        <div class="container">
            <div class="wsus__category_slider_area">
                <div class="row">

                    @php
                        $colorId=1;
                    @endphp
                    @foreach ($listingCategories as $index => $category)

                    @php
                        if($index %4 ==0){
                            $colorId=1;
                        }

                        $color="";
                        if($colorId==1){
                            $color="color_1";
                        }else if($colorId==2){
                            $color="color_2";
                        }else if($colorId==3){
                            $color="color_3";
                        }else if($colorId==4){
                            $color="color_4";
                        }
                    @endphp
                    <div class="col-xl-2 col-sm-6 col-md-4">
                        <a href="{{ route('listings',['category_slug'=>$category->slug, 'page_type' => 'list_view']) }}" class="wsus__category_single_slider {{ $color }}">
                            <i class="{{ $category->icon }}"></i>
                            <p>{{ $category->name }}</p>
                        </a>
                    </div>

                    @php
                        $colorId++;
                    @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--==========================
        CATEGORY SLIDER END
    ===========================-->



    <!--==========================
        FEATURES PART START
    ===========================-->

    @php
        $feature_section=$section->where('id',2)->first();
        $features=$features->take($feature_section->content_quantity)
    @endphp
    @if ($feature_section->show_homepage==1)
        <section id="wsus__features">
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
                    @php
                        $id=1;
                    @endphp
                    @foreach ($features as $index => $feature)
                        <div class="col-xl-4 col-md-6">
                            <div class="wsus__feature_single">
                                <i class="{{ $feature->icon }}"></i>
                                <h5>{{ $feature->title }}</h5>
                                <p>{{ $feature->description }}</p>
                                <span>{{ $id }}</span>
                            </div>
                        </div>

                        @php
                        $id++;
                    @endphp
                    @endforeach

                </div>
            </div>
        </section>
    @endif
    <!--==========================
        FEATURES PART END
    ===========================-->


    <!--==========================
        COUNTER PART START
    ===========================-->

    @php
        $overview_section=$section->where('id',3)->first();
    @endphp
    @if ($overview_section->show_homepage==1)
    <section id="wsus__counter" style="background-image:url({{ $bannerImages->where('id',13)->first()->image ? asset($bannerImages->where('id',13)->first()->image) : '' }});">
        <div class="wsus__counter_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 m-auto">
                        <div class="wsus__heading_area">
                            <i class="{{ $overview_section->icon }}"></i>
                            <h2>{{ $overview_section->header }} </h2>
                            <p>{{ $overview_section->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-9 col-md-12">
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



    <!--==========================
        OUR CATEGORY START
    ===========================-->

    @php
            $category_section=$section->where('id',4)->first();
        $listingCategories=$listingCategories->take($category_section->content_quantity)
    @endphp
    @if ($category_section->show_homepage==1)
        <section id="wsus__categoryes">
            <div class="wsus__categorye_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 m-auto">
                            <div class="wsus__heading_area">
                                <i class="{{ $category_section->icon }}"></i>
                                <h2>{{ $category_section->header }}</h2>
                                <p>{{ $category_section->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $colorId=1;
                        @endphp
                        @foreach ($listingCategories as $index => $category)

                            @php
                                if($index %4 ==0){
                                    $colorId=1;
                                }
                                $color="";
                                if($colorId==1){
                                    $color="green";
                                }else if($colorId==2){
                                    $color="red";
                                }else if($colorId==3){
                                    $color="purple";
                                }
                                else if($colorId==4){
                                    $color="green2";
                                }


                                $activeListingsByCategory=$category->listings->where('status',1);
                                $qty=0;
                                foreach ($activeListingsByCategory as $key => $listing) {
                                    if($listing->expired_date==null){
                                        $qty+=1;
                                    }elseif($listing->expired_date > date('Y-m-d')){
                                        $qty+=1;
                                    }
                                }

                            @endphp
                            <div class="col-xl-4 col-sm-6">
                                <a href="{{ route('listings',['category_slug'=>$category->slug, 'page_type' => 'list_view']) }}" class="wsus__category_single">
                                    <div class="wsus__category_img">
                                        <img src="{{ url($category->image) }}" alt="img" class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__category_text">
                                        <div class="wsus__category_text_center">
                                            <i class="{{ $category->icon }}"></i>
                                            <p>{{ $category->name }}</p>
                                            <span class="{{ $color }}">{{ $qty }} {{ $websiteLang->where('id',56)->first()->custom_text }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            @php
                                $colorId++;
                            @endphp
                        @endforeach

                        <div class="col-xl-12 text-center">
                            <a href="{{ route('listing.category') }}" class="read_btn">{{ $websiteLang->where('id',5)->first()->custom_text }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--==========================
        OUR CATEGORY END
    ===========================-->



    <!--==========================
        OUR LOCATION START
    ===========================-->

    @php
        $location_section=$section->where('id',5)->first();
        $locations=$locations->take($location_section->content_quantity)
    @endphp
    @if ($location_section->show_homepage==1)
        <section id="wsus__location" style="background-image:url({{ $bannerImages->where('id',13)->first()->image ? asset($bannerImages->where('id',19)->first()->image) : '' }});">
            <div class="wsus__location_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 m-auto">
                            <div class="wsus__heading_area">
                                <i class="{{ $location_section->icon }}"></i>
                                <h2>{{ $location_section->header }}</h2>
                                <p>{{ $location_section->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="wsus__location_filter">
                                <button class="active" data-filter="*">{{ $websiteLang->where('id',6)->first()->custom_text }}</button>

                                @foreach ($locations as $index => $location)
                                <button  data-filter=".{{ $location->id }}">{{ $location->location }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row grid">
                        @php
                            $colorId=1;
                        @endphp
                        @foreach ($locations as $index => $location)

                        @php
                            if($index %4 ==0){
                                $colorId=1;
                            }
                            $color="";
                            if($colorId==1){
                                $color="green";
                            }else if($colorId==2){
                                $color="red";
                            }else if($colorId==3){
                                $color="purple";
                            }else if($colorId==4){
                                $color="green2";
                            }

                            $activeListingsByLocation=$location->listings->where('status',1);
                            $qty=0;
                            foreach ($activeListingsByLocation as $key => $listing) {
                                if($listing->expired_date==null){
                                    $qty+=1;
                                }elseif($listing->expired_date > date('Y-m-d')){
                                    $qty+=1;
                                }
                            }

                        @endphp

                        <div class="col-xl-4 col-sm-6 {{ $location->id }}">
                            <a href="{{ route('listings',['location_slug'=>$location->slug, 'page_type' => 'list_view']) }}"" class="wsus__single_location">
                                <img src="{{ $location->image ? asset($location->image) : '' }}" alt="location" class="img-fluid w-100">
                                <div class="wsus__location_text">
                                    <i class="{{ $location->icon }}"></i>
                                    <p>{{ $location->location }}</p>
                                    <span class="{{ $color }}">{{ $qty }} {{ $websiteLang->where('id',56)->first()->custom_text }}</span>
                                </div>
                            </a>
                        </div>

                        @php
                            $colorId++;
                        @endphp

                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--==========================
        OUR LOCATION END
    ===========================-->



    <!--==========================
        FEATURED LISTING START
    ===========================-->
    @php
    $listing_section=$section->where('id',6)->first();
    $listings=$listings->take($listing_section->content_quantity)
    @endphp
    @if ($listing_section->show_homepage==1)
        <section id="wsus__featured_listing">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 m-auto">
                        <div class="wsus__heading_area">
                            <i class="{{ $listing_section->icon }}"></i>
                            <h2>{{ $listing_section->header }}</h2>
                            <p>{{ $listing_section->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row listing_slider">
                    @php
                        $colorId=1;
                    @endphp
                    @foreach ($listings as $index => $listing)
                        @if ($listing->expired_date==null)
                            @php
                                if($index %4 ==0){
                                    $colorId=1;
                                }
                                $color="";
                                if($colorId==1){
                                    $color="green";
                                }else if($colorId==2){
                                    $color="red";
                                }else if($colorId==3){
                                    $color="purple";
                                }else if($colorId==4){
                                    $color="green2";
                                }
                            @endphp
                            <div class="col-xl-2">
                                <div class="wsus__featured_single">
                                    <a class="list_images" href="{{ route('listing.show',$listing->slug) }}">
                                        <img src="{{ asset($listing->thumbnail_image) }}" alt="images" class="img-fluid w-100">
                                    </a>
                                    @guest
                                    <span class="love"><a data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript::void"><i class="fas fa-heart"></i></a></span>
                                    @else
                                    <span class="love"><a href="{{ route('user.add.to.wishlist',$listing->id) }}"><i class="fas fa-heart"></i></a></span>
                                    @endguest

                                    <a class="map" data-bs-toggle="modal" data-bs-target="#listngPopUp-{{ $listing->id }}" href="javascript::void"><i class="fal fas fa-eye"></i></a>

                                    <div class="wsus__featured_single_text">

                                    <span class="small_text {{ $color }}"><a href="{{ route('listings',['category_slug'=>$listing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $listing->listingCategory->name }}</a></span>

                                        @if ($listing->reviews->where('status',1)->count() > 0)
                                        @php
                                            $qty=$listing->reviews->where('status',1)->count();
                                            $total=$listing->reviews->where('status',1)->sum('rating');
                                            $avg=$total/$qty;
                                            $intAvg=intval($avg);
                                            $nextVal=$intAvg+1;
                                            $reviewPoint=$intAvg;
                                            $halfReview=false;
                                            if($intAvg < $avg && $avg < $nextVal){
                                                $reviewPoint= $intAvg + 0.5;
                                                $halfReview=true;
                                            }
                                        @endphp

                                        <p class="list_rating">
                                            @for ($i = 1; $i <=5; $i++)
                                                @if ($i <= $reviewPoint)
                                                    <i class="fa fa-star"></i>
                                                @elseif ($i> $reviewPoint )
                                                    @if ($halfReview==true)
                                                        <i class="fa fa-star-half-o"></i>
                                                        @php
                                                            $halfReview=false
                                                        @endphp
                                                    @else
                                                        <i class="fa fa-star-o"></i>
                                                    @endif
                                                @endif
                                            @endfor
                                            <span>({{ $qty }} {{ $websiteLang->where('id',9)->first()->custom_text }})</span>
                                        </p>
                                        @else
                                            <p class="list_rating">
                                                @for ($i = 1; $i <=5; $i++)
                                                    <i class="fa fa-star-o"></i>
                                                @endfor
                                                <span>(0 {{ $websiteLang->where('id',9)->first()->custom_text }})</span>
                                            </p>
                                        @endif
                                        <h6><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }}</a></h6>
                                        <p class="address"><i class="fa fa-map-marker"></i> {{ $listing->address }}</p>
                                    </div>
                                </div>
                            </div>

                        @elseif($listing->expired_date > date('Y-m-d'))
                            @php
                                if($index %4 ==0){
                                    $colorId=1;
                                }
                                $color="";
                                if($colorId==1){
                                    $color="green";
                                }else if($colorId==2){
                                    $color="red";
                                }else if($colorId==3){
                                    $color="purple";
                                }else if($colorId==4){
                                    $color="green2";
                                }
                            @endphp
                            <div class="col-xl-2">
                                <div class="wsus__featured_single">
                                    <a class="list_images" href="{{ route('listing.show',$listing->slug) }}">
                                        <img src="{{ asset($listing->thumbnail_image) }}" alt="images" class="img-fluid w-100">
                                    </a>
                                    @guest
                                    <span class="love"><a data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript::void"><i class="fas fa-heart"></i></a></span>
                                    @else
                                    <span class="love"><a href="{{ route('user.add.to.wishlist',$listing->id) }}"><i class="fas fa-heart"></i></a></span>
                                    @endguest

                                    <a class="map" data-bs-toggle="modal" data-bs-target="#listngPopUp-{{ $listing->id }}" href="javascript::void"><i class="fal fas fa-eye"></i></a>

                                    <div class="wsus__featured_single_text">

                                    <span class="small_text {{ $color }}"><a href="{{ route('listings',['category_slug'=>$listing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $listing->listingCategory->name }}</a></span>

                                        @if ($listing->reviews->where('status',1)->count() > 0)
                                        @php
                                            $qty=$listing->reviews->where('status',1)->count();
                                            $total=$listing->reviews->where('status',1)->sum('rating');
                                            $avg=$total/$qty;
                                            $intAvg=intval($avg);
                                            $nextVal=$intAvg+1;
                                            $reviewPoint=$intAvg;
                                            $halfReview=false;
                                            if($intAvg < $avg && $avg < $nextVal){
                                                $reviewPoint= $intAvg + 0.5;
                                                $halfReview=true;
                                            }
                                        @endphp

                                        <p class="list_rating">
                                            @for ($i = 1; $i <=5; $i++)
                                                @if ($i <= $reviewPoint)
                                                    <i class="fa fa-star"></i>
                                                @elseif ($i> $reviewPoint )
                                                    @if ($halfReview==true)
                                                        <i class="fa fa-star-half-o"></i>
                                                        @php
                                                            $halfReview=false
                                                        @endphp
                                                    @else
                                                        <i class="fa fa-star-o"></i>
                                                    @endif
                                                @endif
                                            @endfor
                                            <span>({{ $qty }} {{ $websiteLang->where('id',9)->first()->custom_text }})</span>
                                        </p>
                                        @else
                                            <p class="list_rating">
                                                @for ($i = 1; $i <=5; $i++)
                                                    <i class="fa fa-star-o"></i>
                                                @endfor
                                                <span>(0 {{ $websiteLang->where('id',9)->first()->custom_text }})</span>
                                            </p>
                                        @endif
                                        <h6><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }}</a></h6>
                                        <p class="address"><i class="fa fa-map-marker"></i> {{ $listing->address }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @php
                            $colorId++;
                        @endphp



                    @endforeach

                </div>
            </div>
        </section>

        @foreach ($listings as $index => $listing)
            <section id="wsus__map_popup">
                <div class="modal fade" id="listngPopUp-{{ $listing->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <button type="button" class="btn-close popup_close"  data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times"></i></button>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-xl-12 col-md-12">
                                    <div class="map_popup_content">
                                        <img src="{{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }}" alt="images" class="img-fluid w-100">
                                        <div class="map_popup_text">
                                            @if ($listing->is_featured==1)
                                            <span><i class="far fa-star"></i>  {{ $websiteLang->where('id',10)->first()->custom_text }}</span>
                                            @endif

                                            @if ($listing->verified)
                                                <span class="red"><i class="far fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</span>
                                            @endif
                                            <h5>{{ $listing->title }}</h5>

                                            @if ($listing->phone)
                                                <a class="call" href="callto:{{ $listing->phone }}"><i class="fal fa-phone-alt"></i> {{ $listing->phone }}</a>
                                            @endif
                                            @if ($listing->email)
                                            <a class="mail" href="mailto:{{ $listing->email }}"><i class="fal fa-envelope"></i> {{ $listing->email }}</a>

                                            @endif

                                            <p>{{ $listing->sort_description }}</p>
                                            <a class="read_btn" href="{{ route('listing.show',$listing->slug) }}">{{ $websiteLang->where('id',12)->first()->custom_text }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-12 col-md-12">
                                    <div class="map_popup_content_map">
                                        {!! $listing->google_map_embed_code !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif
    <!--==========================
         FEATURED LISTING END
    ===========================-->



    <!--==========================
        OUR PACKAGE START
    ===========================-->

    @php
        $listing_package_section=$section->where('id',7)->first();
        $listingPackages=$listingPackages->take($listing_package_section->content_quantity)
    @endphp
    @if ($listing_package_section->show_homepage==1)
        <section id="wsus__package" style="background-image:url({{ $bannerImages->where('id',20)->first()->image ? asset($bannerImages->where('id',13)->first()->image) : '' }});">
            <div class="wsus__package_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 m-auto">
                            <div class="wsus__heading_area">
                                <i class="{{ $listing_package_section->icon }}"></i>
                                <h2>{{ $listing_package_section->header }} </h2>
                                <p>{{ $listing_package_section->description }}</p>
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
         BLOG PART START
    ===========================-->
    @php
        $blog_section=$section->where('id',8)->first();
        $blogs=$blogs->take($blog_section->content_quantity)
    @endphp
    @if ($blog_section->show_homepage==1)
        <section id="blog_part">
            <div class="blog_part_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 m-auto">
                            <div class="wsus__heading_area">
                                <i class="{{ $blog_section->icon }}"></i>
                                <h2>{{ $blog_section->header }}</h2>
                                <p>{{ $blog_section->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $colorId=1;
                        @endphp
                        @foreach ($blogs as $index => $blog)
                            <div class="col-xl-4 col-sm-12 col-md-6 col-lg-4">
                                <div class="single_blog">
                                    <a href="{{ route('blog.details',$blog->slug) }}"><img src="{{ $blog->thumbnail_image ?  url($blog->thumbnail_image) : '' }}" alt="bloh images" class="img-fluid w-100"></a>
                                    <span><i class="fal fa-calendar-alt"></i> {{ $blog->created_at->format('M d Y') }}</span>
                                    <span><i class="fas fa-user"></i> {{ $blog->admin->name }}</span>
                                    <h4><a href="{{ route('blog.details',$blog->slug) }}">{{ $blog->title }}</a></h4>
                                    <p>{{ $blog->short_description }}</p>
                                    <a class="read_btn" href="{{ route('blog.details',$blog->slug) }}">{{ $websiteLang->where('id',484)->first()->custom_text }} <i class="far fa-chevron-double-right"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--==========================
         BLOG PART END
    ===========================-->


    <!--============================
        TESTIMONIAL PART START
    ==============================-->

    <!-- @php
        $testimonial_section=$section->where('id',10)->first();
        $testimonials=$testimonials->take($testimonial_section->content_quantity)
    @endphp
    @if ($testimonial_section->show_homepage==1)
        <section id="wsus__testimonial" style="background-image:url({{ $bannerImages->where('id',20)->first()->image ? asset($bannerImages->where('id',21)->first()->image) : '' }});">
            <div class="wsus__test_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 m-auto">
                            <div class="wsus__heading_area">
                                <i class="{{ $testimonial_section->icon }}"></i>
                                <h2>{{ $testimonial_section->header }}</h2>
                                <p>{{ $testimonial_section->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row testi_slider">
                        @foreach ($testimonials as $testimonial)
                            <div class="col-xl-6">
                                <div class="wsus__single_clients">
                                    <p><i class="fal fa-quote-left" id="top_icon"></i> {{ $testimonial->description }}</p>
                                    <img src="{{ asset($testimonial->image) }}" alt="clients" class="img-fluid">
                                    <span class="c_name">{{ $testimonial->name }}</span>
                                    <span class="c_det">{{ $testimonial->designation }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif -->
    <!--============================
        TESTIMONIAL PART END
    ==============================-->



    <!--==========================
       SUBSCRIBE PART START
    ===========================-->

    @php
        $subscribe_section=$section->where('id',9)->first();
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
