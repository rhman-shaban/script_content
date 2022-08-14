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
                        <h4>{{ $menus->where('id',2)->first()->navbar }}</h4>
                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{ $menus->where('id',1)->first()->navbar }} </a></li>
                                <li class="breadcrumb-item active" aria-current="page"> {{ $menus->where('id',2)->first()->navbar }} </li>
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


    @php
        $search_url = request()->fullUrl();
        $get_url = substr($search_url, strpos($search_url, "?") + 1);

        $grid_url='';
        $list_url='';
        $isSortingId=0;

        $page_type=request()->get('page_type') ;
        if($page_type=='list_view'){
            $grid_url=str_replace('page_type=list_view','page_type=grid_view',$search_url);
            $list_url=str_replace('page_type=list_view','page_type=list_view',$search_url);
        }else if($page_type=='grid_view'){
            $grid_url=str_replace('page_type=grid_view','page_type=grid_view',$search_url);
            $list_url=str_replace('page_type=grid_view','page_type=list_view',$search_url);
        }


        if(request()->has('sorting_id')){
            $isSortingId=1;
        }
    @endphp


    <section id="listing_grid" class="{{ $page_type=='list_view' ? 'list_view' : 'grid_view' }}">
        <div class="container list_padding">
            <div class="row">
                <div class="col-xl-4 col-lg-3">
                    <form action="{{ route('search-listing') }}" method="GET">
                        <div class="listing_grid_sidbar">
                            <div class="sidebar_line">
                                <form>
                                    <input type="text" name="search" placeholder="{{ $websiteLang->where('id',1)->first()->custom_text }}" value="{{ request()->has('search') ? request()->get('search') : '' }}">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                            <div class="sidebar_line_select">
                                @if (request()->has('category_slug'))
                                <select class="select_2" name="category_id">
                                    <option value="">{{ $websiteLang->where('id',2)->first()->custom_text }}</option>
                                    @foreach ($listingCategories as $category)
                                    <option {{ request()->get('category_slug') == $category->slug ? 'selected' : ''  }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @else
                                <select class="select_2" name="category_id">
                                    <option value="">{{ $websiteLang->where('id',2)->first()->custom_text }}</option>
                                    @foreach ($listingCategories as $category)
                                        @if (request()->has('category_id'))
                                        <option {{ request()->get('category_id') == $category->id ? 'selected' : ''  }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @elseif (isset($categoryId))
                                            <option {{ $categoryId == $category->id ? 'selected' : ''  }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif

                                    @endforeach
                                </select>

                                @endif
                            </div>
                            <div class="sidebar_line_select">

                                @if (request()->has('location_slug'))
                                    <select class="select_2" name="location">
                                        <option value="">{{ $websiteLang->where('id',3)->first()->custom_text }}</option>
                                        @foreach ($locationsForSearch as $location)
                                            <option {{ request()->get('location_slug') == $location->slug ? 'selected' : ''  }} value="{{ $location->id }}">{{ $location->location }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="select_2" name="location">
                                        <option value="">{{ $websiteLang->where('id',3)->first()->custom_text }}</option>
                                        @foreach ($locationsForSearch as $location)
                                            @if (request()->has('location'))
                                            <option {{ request()->get('location') == $location->id ? 'selected' : ''  }} value="{{ $location->id }}">{{ $location->location }}</option>
                                            @elseif (isset($locationId))
                                            <option {{ $locationId == $location->id ? 'selected' : ''  }} value="{{ $location->id }}">{{ $location->location }}</option>
                                            @else
                                            <option value="{{ $location->id }}">{{ $location->location }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                            @php
                                $searhAminities=request()->get('aminity') ;

                            @endphp

                            <div class="wsus__pro_check">


                                @if (request()->has('aminity'))
                                    @foreach ($aminities as $aminity)
                                        @php
                                            $isChecked=false;
                                        @endphp
                                        @foreach ($searhAminities as $searhAminity)
                                            @if ($searhAminity==$aminity->id)
                                                @php
                                                    $isChecked=true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <div class="form-check">
                                            <input {{ $isChecked ? 'checked' : '' }} id="{{ $aminity->slug }}" name="aminity[]" value="{{ $aminity->id }}"  class="form-check-input" type="checkbox">
                                            <label class="form-check-label" for="{{ $aminity->slug }}">
                                                {{ $aminity->aminity }}
                                            </label>
                                        </div>

                                    @endforeach
                                @else
                                    @foreach ($aminities as $aminity)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="{{ $aminity->slug }}" name="aminity[]" value="{{ $aminity->id }}">
                                            <label class="form-check-label" for="{{ $aminity->slug }}">
                                                {{ $aminity->aminity }}
                                            </label>
                                        </div>

                                    @endforeach
                                @endif
                            </div>

                            @php
                                $page_type=request()->get('page_type') ;
                            @endphp
                            <input type="hidden" id="page_type" name="page_type" value="{{ $page_type }}">
                            <button class="read_btn" type="submit">{{ $websiteLang->where('id',4)->first()->custom_text }}</button>
                        </div>
                    </form>
                </div>
                <div class="col-xl-8 col-lg-9">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="wsus__property_topbar">
                                <div class="wsus__property_topbar_left">
                                    <ul>

                                        <li><a class=" {{ $page_type=='grid_view' ? 'wsus_active_bar' : '' }}" href="{{ $grid_url }}"><i class="fas fa-th"></i></a></li>
                                        <li><a class=" {{ $page_type=='list_view' ? 'wsus_active_bar' : '' }}" href="{{ $list_url }}"><i class="fas fa-list-ul"></i></a></li>
                                    </ul>
                                </div>

                                @if ($isSortingId==1)
                                <div class="wsus__property_topbar_right">
                                    <div class="wp_search_area">
                                        <select class="select_2" name="state" id="sortingId">
                                            <option {{ request()->get('sorting_id')==6 ? 'selected' : '' }} value="6"> {{ $websiteLang->where('id',62)->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==1 ? 'selected' : '' }} value="1">{{ $websiteLang->where('id',63)->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==2 ? 'selected' : '' }} value="2">{{ $websiteLang->where('id',10)->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==3 ? 'selected' : '' }} value="3">{{ $websiteLang->where('id',11)->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==4 ? 'selected' : '' }} value="4">{{ $websiteLang->where('id',64)->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==5 ? 'selected' : '' }} value="5">{{ $websiteLang->where('id',65)->first()->custom_text }}</option>
                                        </select>
                                    </div>
                                </div>
                                @else
                                <div class="wsus__property_topbar_right">
                                    <div class="wp_search_area">
                                        <select class="select_2" name="state" id="sortingId">
                                            <option {{ request()->get('sorting_id')==6 ? 'selected' : '' }} value="6"> {{ $websiteLang->where('id',62)->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==1 ? 'selected' : '' }} value="1">{{ $websiteLang->where('id',63)->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==2 ? 'selected' : '' }} value="2">{{ $websiteLang->where('id',10)->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==3 ? 'selected' : '' }} value="3">{{ $websiteLang->where('id',11)->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==4 ? 'selected' : '' }} value="4">{{ $websiteLang->where('id',64)->first()->custom_text }}</option>
                                            <option {{ request()->get('sorting_id')==5 ? 'selected' : '' }} value="5">{{ $websiteLang->where('id',65)->first()->custom_text }}</option>
                                        </select>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>

                        @if ($page_type=='list_view')

                        @if ($listings->count()>0)
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
                                <div class="col-xl-12">
                                    <div class="wsus__featured_single list_view">
                                        <a class="list_images" href="{{ route('listing.show',$listing->slug) }}" class="">
                                            <img src="{{ asset($listing->thumbnail_image) }}" alt="images" class="img-fluid w-100">
                                        </a>
                                        @guest
                                            <a class="love" data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript::void"><i class="fas fa-heart"></i></a>
                                        @else
                                        <a class="love" href="{{ route('user.add.to.wishlist',$listing->id) }}"><i class="fas fa-heart"></i></a>
                                        @endguest

                                        <a class="map" data-bs-toggle="modal" data-bs-target="#listngPopUp-{{ $listing->id }}" href="#"><i class="fal fas fa-eye"></i></a>
                                        <div class="wsus__featured_single_text">
                                            <span class="small_text {{ $color }}"><a href="{{ route('listings',['category_slug'=>$listing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $listing->listingCategory->name }}</a></span>
                                            @if ($listing->listingSchedule->count()> 0)
                                                @php

                                                    $today=date('l');
                                                    $today=$days->where('day',$today)->first();
                                                    $schedule=$listing->listingSchedule->where('day_id',$today->id)->first();
                                                @endphp

                                                @if ($schedule)
                                                @if ($schedule->status==1)
                                                    @php
                                                        $start_time=date('Y-m-d').$schedule->start_time;
                                                        $start_time=strtotime($start_time);

                                                        $end_time=date('Y-m-d').$schedule->end_time;
                                                        $end_time=strtotime($end_time);
                                                        $current_time=Carbon\Carbon::now()->timestamp;
                                                    @endphp

                                                    @if ($start_time <= $current_time && $current_time <= $end_time)
                                                        <div class="listing-place-timing"><span class="color-lebel clr-green"></span></div>

                                                        <p class="open">{{ $websiteLang->where('id',8)->first()->custom_text }}</p>
                                                    @else
                                                        <p class="close">{{ $websiteLang->where('id',455)->first()->custom_text }}</p>

                                                    @endif
                                                @endif
                                                @endif
                                            @endif

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
                                            <p> <i class="fa fa-map-marker"></i> {{ $listing->address }}</p>
                                            <p class="list_details">{{ $listing->sort_description }}</p>

                                            @if ($listing->is_featured==1)
                                                <a class="future_verify" href="javascript::void"><i class="far fa-star"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</a>
                                            @endif


                                            @if ($listing->verified==1)
                                            <a class="future_verify red" href="javascript::void"><i class="far fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $colorId++;
                                @endphp
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
                                    <div class="col-xl-12">
                                        <div class="wsus__featured_single list_view">
                                            <a class="list_images" href="{{ route('listing.show',$listing->slug) }}" class="">
                                                <img src="{{ asset($listing->thumbnail_image) }}" alt="images" class="img-fluid w-100">
                                            </a>


                                            @guest
                                                <span class="love"><a data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript::void"><i class="fas fa-heart"></i></a></span>
                                            @else
                                                <span class="love"><a href="{{ route('user.add.to.wishlist',$listing->id) }}"><i class="fas fa-heart"></i></a></span>
                                            @endguest

                                            <a class="map" data-bs-toggle="modal" data-bs-target="#listngPopUp-{{ $listing->id }}" href="#"><i class="fal fas fa-eye"></i></a>

                                            <div class="wsus__featured_single_text">
                                            <span class="small_text {{ $color }}"><a href="{{ route('listings',['category_slug'=>$listing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $listing->listingCategory->name }}</a></span>
                                                @if ($listing->listingSchedule->count()> 0)
                                                    @php

                                                        $today=date('l');
                                                        $today=$days->where('day',$today)->first();
                                                        $schedule=$listing->listingSchedule->where('day_id',$today->id)->first();
                                                    @endphp

                                                    @if ($schedule)
                                                    @if ($schedule->status==1)
                                                        @php
                                                            $start_time=date('Y-m-d').$schedule->start_time;
                                                            $start_time=strtotime($start_time);

                                                            $end_time=date('Y-m-d').$schedule->end_time;
                                                            $end_time=strtotime($end_time);
                                                            $current_time=Carbon\Carbon::now()->timestamp;
                                                        @endphp

                                                        @if ($start_time <= $current_time && $current_time <= $end_time)
                                                            <div class="listing-place-timing"><span class="color-lebel clr-green"></span></div>

                                                            <p class="open">{{ $websiteLang->where('id',8)->first()->custom_text }}</p>
                                                        @else
                                                            <p class="close">{{ $websiteLang->where('id',455)->first()->custom_text }}</p>

                                                        @endif
                                                    @endif
                                                    @endif
                                                @endif

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
                                                <p> <i class="fa fa-map-marker"></i> {{ $listing->address }}</p>
                                                <p class="list_details">{{ $listing->sort_description }}</p>



                                                @if ($listing->is_featured==1)
                                                    <a class="future_verify" href="javascript::void"><i class="far fa-star"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</a>
                                                @endif


                                                @if ($listing->verified==1)
                                                <a class="future_verify red" href="javascript::void"><i class="far fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        $colorId++;
                                    @endphp
                                @endif

                            @endforeach
                        @else
                            <div class="col-12">
                                <h4 class="text-danger py-5 text-center">{{ $websiteLang->where('id',396)->first()->custom_text }}</h4>
                            </div>
                        @endif
                        @elseif($page_type=='grid_view')
                            @if ($listings->count()>0)
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
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="wsus__featured_single">
                                            <a href="{{ route('listing.show',$listing->slug) }}">
                                                <img src="{{ asset($listing->thumbnail_image) }}" alt="images" class="img-fluid w-100">
                                            </a>
                                            @guest
                                            <span class="love"><a data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript::void"><i class="fas fa-heart"></i></a></span>
                                            @else
                                            <span class="love"><a href="{{ route('user.add.to.wishlist',$listing->id) }}"><i class="fas fa-heart"></i></a></span>
                                            @endguest

                                            <a class="map" data-bs-toggle="modal" data-bs-target="#listngPopUp-{{ $listing->id }}" href="#"><i class="fal fas fa-eye"></i></a>
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
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="wsus__featured_single">
                                            <a href="{{ route('listing.show',$listing->slug) }}">
                                                <img src="{{ asset($listing->thumbnail_image) }}" alt="images" class="img-fluid w-100">
                                            </a>

                                            @guest
                                            <span class="love"><a data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript::void"><i class="fas fa-heart"></i></a></span>
                                            @else
                                            <span class="love"><a href="{{ route('user.add.to.wishlist',$listing->id) }}"><i class="fas fa-heart"></i></a></span>
                                            @endguest

                                            <a class="map" data-bs-toggle="modal" data-bs-target="#listngPopUp-{{ $listing->id }}" href="#"><i class="fal fas fa-eye"></i></a>
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
                            @else
                            <div class="col-12">
                                <h4 class="text-danger py-5 text-center">{{ $websiteLang->where('id',396)->first()->custom_text }}</h4>
                            </div>
                            @endif
                        @endif

                        {{ $listings->links('user.paginator') }}

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

                    </div>
                </div>
            </div>
        </div>
    </section>




    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $("#sortingId").on("change",function(){
                $(".pagination-bx").addClass('d-none')
                var id=$(this).val();
                var query_url='<?php echo $get_url; ?>';

                var isSortingId='<?php echo $isSortingId; ?>'
                var query_url='<?php echo $search_url; ?>';

                if(isSortingId==0){
                    var sorting_id="&sorting_id="+id;
                    query_url += sorting_id;
                }else{
                     var href = new URL(query_url);
                    href.searchParams.set('sorting_id', id);
                    query_url=href.toString()
                }

                window.location.href = query_url;
            })

        });

        })(jQuery);


    </script>
@endsection
