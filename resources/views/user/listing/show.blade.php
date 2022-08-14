@extends('layouts.user.layout')
@section('title')
    <title>{{ $listing->seo_title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $listing->seo_description }}">
@endsection

@section('user-content')

<!--==========================
         BREADCRUMB PART START
    ===========================-->
    <div id="breadcrumb_part" style="background-image:url({{ $listing->banner_image ? asset($listing->banner_image) : '' }});">
        <div class="bread_overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center text-white">
                        <h4>{{ $listing->title }}</h4>
                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{ $menus->where('id',1)->first()->navbar }} </a></li>
                                <li class="breadcrumb-item"><a href="{{ route('listings',['page_type'=>'list_view']) }}"> {{ $menus->where('id',2)->first()->navbar }} </a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $listing->title }}</li>
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
        LISTING DETAILS START
    ===========================-->
    <section id="listing_details">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="listing_details_text">
                        <div class="listing_det_header">
                            <div class="listing_det_header_img">
                                <img src="{{ asset($listing->logo) }}" alt="logo" class="img-fluid w-100">
                            </div>
                            <div class="listing_det_header_text">
                                <h6>{{ $listing->title }}</h6>

                                @if ($listing->user_type==1)
                                <p class="host_name">{{ $websiteLang->where('id',22)->first()->custom_text }} <a href="{{ route('user-profile',['user_type'=>1,'slug'=>$listing->admin->slug]) }}">{{ $listing->admin->name }}</a></p>
                                @else
                                <p class="host_name">{{ $websiteLang->where('id',22)->first()->custom_text }} <a href="{{ route('user-profile',['user_type'=>0,'slug'=>$listing->user->slug]) }}">{{ $listing->user->name }}</a></p>
                                @endif

                                @if ($reviews->where('status',1)->count()>0)
                                    @php
                                        $qty=$reviews->where('status',1)->count();
                                        $total=$reviews->where('status',1)->sum('rating');
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

                                    <p class="rating">
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
                                        <b>{{ sprintf("%.1f", $reviewPoint) }}</b>
                                        <span>({{ $reviews->where('status',1)->count() }} {{ $websiteLang->where('id',9)->first()->custom_text }})</span>
                                    </p>
                                @else
                                    <p class="rating">
                                        @for ($i = 1; $i <=5; $i++)
                                        <i class="fa fa-star-o"></i>
                                        @endfor
                                        <b>0.0</b>
                                        <span>(0 {{ $websiteLang->where('id',9)->first()->custom_text }})</span>
                                    </p>
                                @endif




                                <ul>


                                    @if ($listing->verified==1)
                                        <li><a href="javascript::void"><i class="far fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</a></li>
                                    @else
                                    <li><a data-bs-toggle="modal" data-bs-target="#cliaimModal" href="javascript::void" ><i class="far fa-check"></i> {{ $websiteLang->where('id',457)->first()->custom_text }}</a></li>
                                    @endif


                                    @guest
                                        <li><a href="javascript::void" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fal fa-heart"></i> {{ $websiteLang->where('id',28)->first()->custom_text }}</a></li>
                                    @else
                                        @php
                                            $user=Auth::guard('web')->user();
                                            $isWishlist=false;
                                            foreach ($wishlists as $key => $wishlist) {
                                                if($wishlist->listing_id== $listing->id && $wishlist->user_id==$user->id){
                                                    $isWishlist=true;
                                                }
                                            }

                                        @endphp
                                        @if ($isWishlist)
                                            <li><a href="javascript::void"><i class="fal fa-heart"></i> {{ $websiteLang->where('id',436)->first()->custom_text }}</a></li>
                                        @else
                                        <li><a href="{{ route('user.add.to.wishlist',$listing->id) }}"><i class="fal fa-heart"></i> {{ $websiteLang->where('id',28)->first()->custom_text }}</a></li>
                                        @endif
                                    @endguest


                                    <li><a href="javascript::void"><i class="fal fa-eye"></i> {{ $listing->views }}</a></li>

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
                                                <li><a href="javascript::void" class="red">{{ $websiteLang->where('id',8)->first()->custom_text }}</a></li>
                                                @else
                                                <li><a href="javascript::void" class="red">{{ $websiteLang->where('id',455)->first()->custom_text }}</a></li>
                                                @endif
                                            @endif
                                        @endif
                                    @endif

                                </ul>
                            </div>
                        </div>
                        <div class="listing_det_text">
                            {!! clean($listing->description) !!}

                            @if ($listing->file)
                            <div class="text-left m-t30	">
                                <a class="read_btn" href="{{ route('download-listing-file',$listing->file) }}">{{ $websiteLang->where('id',29)->first()->custom_text }}<i class="ml-2 fa fa-file-pdf"></i></a>
                            </div>
                            @endif


                        </div>

                        @if ($listing->listingImages->count() > 0)
                            <div class="listing_det_Photo">
                                <div class="row">

                                    @foreach ($listing->listingImages as $image)
                                    <div class="col-xl-3 col-sm-6">
                                        <a class="venobox" data-gall="gallery01" href="{{ asset($image->image) }}">
                                            <img src="{{ asset($image->image) }}" alt="gallery1" class="img-fluid w-100">
                                            <div class="photo_overlay">
                                                <i class="fal fa-plus"></i>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif


                        @if ($listing->listingAminities->count()>0)
                        <div class="listing_det_feature">
                            <div class="row">
                                @foreach ($listing->listingAminities as $aminity)
                                <div class="col-xl-4 col-sm-6">
                                    <div class="listing_det_feature_single">
                                        <i class="{{ $aminity->aminity->icon }}"></i>
                                        <span>{{ $aminity->aminity->aminity }}</span>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        @endif

                        @if ($listing->listingVideos->count()>0)
                            <div class="listing_det_video">
                                <div class="row">
                                    @foreach ($listing->listingVideos as $video)
                                    @php
                                        $video_id=explode("=",$video->video_link);
                                    @endphp
                                    <div class="col-xl-4 col-sm-6">
                                        <div class="listing_det_video_img">
                                            <img src="https://img.youtube.com/vi/{{ $video_id[1] }}/0.jpg" alt="img" class="img-fluid w-100">
                                            <a class="venobox" data-autoplay="true" data-vbtype="video" href="{{ $video->video_link }}">
                                                <i class=" fas fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        @endif
                        <div class="listing_det_location">
                            {!! $listing->google_map_embed_code !!}
                        </div>
                        <div class="wsus__listing_review">

                            @php
                                $qty=0;
                                if($reviews->where('status',1)->count() >0){
                                    $qty=$reviews->where('status',1)->count();
                                    $total=$reviews->where('status',1)->sum('rating');
                                    $avg=$total/$qty;
                                    $intAvg=intval($avg);
                                    $nextVal=$intAvg+1;
                                    $reviewPoint=$intAvg;
                                    $halfReview=false;
                                    if($intAvg < $avg && $avg < $nextVal){
                                        $reviewPoint= $intAvg + 0.5;
                                        $halfReview=true;
                                    }
                                }

                            @endphp

                            <h4>{{ $websiteLang->where('id',9)->first()->custom_text }} <span>{{ $qty }}</span></h4>
                            <div class="wsus__total_rating">
                                @if ($qty==0)
                                <h4>0.0</h4>
                                @else
                                <h4>{{ sprintf("%.1f", $reviewPoint) }}</h4>
                                @endif

                                <span>{{ $websiteLang->where('id',33)->first()->custom_text }} 5.0</span>
                                @if ($qty > 0)
                                <p>
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
                                </p>
                                @else
                                <p>
                                    @for ($i = 1; $i <=5; $i++)
                                    <i class="fa fa-star-o"></i>
                                    @endfor
                                </p>
                                @endif
                            </div>
                            @if ($qty > 0)
                                @foreach ($reviews as $review)
                                <div class="wsus__single_comment">
                                    <div class="wsus__single_comment_img">
                                        <img src="{{ $review->user->image ? asset($review->user->image) : asset($default_image->image) }}" alt="comment" class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__single_comment_text">
                                        <h5>{{ $review->user->name }}<span>
                                            @for ($i = 1; $i <=5 ; $i++)
                                                @if ($i <= $review->rating)
                                                <i class="fa fa-star"></i>
                                                @else
                                                <i class="fa fa-star-o"></i>
                                                @endif
                                            @endfor
                                        </span></h5>
                                        <span>{{ $review->created_at->format('M d,Y') }}</span>
                                        <p>{{ $review->comment }}</p>
                                    </div>
                                </div>
                                @endforeach
                            @endif


                            @auth
                                @php
                                    $authUser=Auth::guard('web')->user();
                                @endphp
                                @if ($listing->user_id !=$authUser->id)
                                    <h5 class="mt-2">{{ $websiteLang->where('id',45)->first()->custom_text }}</h5>

                                    <form id="listingReviewForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="wsus__select_rating">
                                                    <i class="fas fa-star"></i>
                                                    <select class="select_2" name="rating">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" name="listing_id" value="{{ $listing->id }}">

                                            <div class="col-xl-12">
                                                <div class="blog_single_input">
                                                    <textarea cols="3" rows="5" placeholder="{{ $websiteLang->where('id',46)->first()->custom_text }}" name="comment"></textarea>
                                                    <button id="listingReviewBtn" type="submit" class="read_btn"><i id="listing-review-spinner" class="loading-icon fas fa-sync fa-spin d-none"></i> {{ $websiteLang->where('id',456)->first()->custom_text }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="listing_details_sidebar">
                        <div class="row">
                            <div class="col-12">
                                <div class="listing_det_side_address">
                                    @if ($listing->phone)
                                    <a href="callto:{{ $listing->phone }}"><i class="fal fa-phone-alt"></i> {{ $listing->phone }}</a>

                                    @endif

                                    @if ($listing->email)
                                    <a href="mailto:{{ $listing->email }}"><i class="fal fa-envelope"></i> {{ $listing->email }}</a>
                                    @endif
                                    <p><i class="fal fa-map-marker-alt"></i> {{ $listing->address }}</p>
                                    @if ($listing->website)
                                    <p><i class="fal fa-globe"></i>{{ $listing->website }}</p>
                                    @endif

                                    <ul>

                                        @if ($listing->facebook)
                                        <li>
                                            <a target="_blank" href="{{ $listing->facebook }}" class="fab fa-facebook icon"></a>
                                        </li>
                                        @endif


                                        @if ($listing->twitter)
                                        <li>
                                            <a target="_blank" href="{{ $listing->twitter }}" class="fab fa-twitter icon"></a>
                                        </li>
                                        @endif
                                        @if ($listing->linkedin)
                                        <li>
                                            <a target="_blank" href="{{ $listing->linkedin }}" class="fab fa-linkedin icon"></a>
                                        </li>
                                        @endif
                                        @if ($listing->whatsapp)
                                        <li>
                                            <a target="_blank" href="{{ $listing->whatsapp }}" class="fab fa-whatsapp icon"></a>
                                        </li>
                                        @endif
                                        @if ($listing->youtube)
                                        <li>
                                            <a target="_blank" href="{{ $listing->youtube }}" class="fab fa-youtube icon"></a>
                                        </li>
                                        @endif
                                        @if ($listing->pinterest)
                                            <li>
                                                <a target="_blank" href="{{ $listing->pinterest }}" class="fab fa-pinterest icon"></a>
                                            </li>
                                        @endif
                                        @if ($listing->instagram)
                                        <li>
                                            <a target="_blank" href="{{ $listing->instagram }}" class="fab fa-instagram icon"></a>
                                        </li>
                                        @endif


                                    </ul>
                                </div>
                            </div>

                            @php
                                $isSchedules=App\ListingSchedule::where(['listing_id'=>$listing->id,'status'=>1])->get();
                            @endphp

                            @if ($isSchedules->count() !=0)
                            <div class="col-12">
                                <div class="listing_det_side_open_hour">
                                    <h5>{{ $websiteLang->where('id',34)->first()->custom_text }}</h5>
                                    @foreach ($isSchedules as $isSchedule)
                                    <p>{{ $isSchedule->day->custom_day }} <span>{{ $isSchedule->start_time." - ".$isSchedule->end_time }}</span></p>

                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="col-12">
                                <div class="listing_det_side_contact">
                                    <h5>{{ $websiteLang->where('id',36)->first()->custom_text }}</h5>
                                    <form id="listingAuthContactForm">
                                        @csrf

                                        <input type="hidden" name="user_type" value="{{ $listing->user_type }}">
                                        @if ($listing->user_type==1)
                                        <input type="hidden" name="admin_id" value="{{ $listing->admin_id }}">
                                        @else
                                        <input type="hidden" name="user_id" value="{{ $listing->user_id }}">
                                        @endif


                                        <input type="text" placeholder="{{ $websiteLang->where('id',37)->first()->custom_text }} *" name="name">
                                        <input type="email" placeholder="{{ $websiteLang->where('id',38)->first()->custom_text }} *" name="email">
                                        <input type="text" placeholder="{{ $websiteLang->where('id',39)->first()->custom_text }} " name="phone" >
                                        <input type="text" placeholder="{{ $websiteLang->where('id',40)->first()->custom_text }} *" name="subject" >
                                        <textarea cols="3" rows="5" name="message" placeholder="{{ $websiteLang->where('id',41)->first()->custom_text }} *"></textarea>

                                        @if($contactSetting->allow_captcha==1)
                                            <div class="form-group mb-4">
                                                <div class="g-recaptcha" data-sitekey="{{ $contactSetting->captcha_key }}"></div>
                                            </div>

                                        @endif



                                        <button id="listingAuthorContctBtn" type="submit" class="read_btn"><i id="listcontact-spinner" class="loading-icon fas fa-sync fa-spin d-none"></i> {{ $websiteLang->where('id',42)->first()->custom_text }}</button>
                                    </form>
                                </div>
                            </div>

                            @if ($similarListings->count() > 0)
                            <div class="col-12">
                                <div class="listing_det_side_list">
                                    <h5>{{ $websiteLang->where('id',43)->first()->custom_text }}</h5>

                                    @foreach ($similarListings->take(5) as $similarListing)

                                    @if ($similarListing->expired_date==null)
                                    <a href="{{ route('listing.show',$similarListing->slug) }}" class="sidebar_blog_single">
                                        <div class="sidebar_blog_img">
                                            <img src="{{ $similarListing->thumbnail_image ? asset($similarListing->thumbnail_image) : ''}}" alt="blog" class="imgofluid w-100">
                                        </div>
                                        <div class="sidebar_blog_text">
                                            <h5>{{ $similarListing->title }}</h5>
                                            <p> {{ $similarListing->created_at->format('M d, Y') }} </p>
                                        </div>
                                    </a>
                                    @elseif($similarListing->expired_date> date('Y-m-d'))
                                        <a href="{{ route('listing.show',$similarListing->slug) }}" class="sidebar_blog_single">
                                            <div class="sidebar_blog_img">
                                                <img src="{{ $similarListing->thumbnail_image ? asset($similarListing->thumbnail_image) : ''}}" alt="blog" class="imgofluid w-100">
                                            </div>
                                            <div class="sidebar_blog_text">
                                                <h5>{{ $similarListing->title }}</h5>
                                                <p> {{ $similarListing->created_at->format('M d, Y') }} </p>
                                            </div>
                                        </a>

                                    @endif

                                    @endforeach

                                </div>
                            </div>
                            @endif

                            @if ($recentListings->count()>0)
                            <div class="col-12">
                                <div class="listing_det_side_add">
                                    <h5>{{ $websiteLang->where('id',44)->first()->custom_text }}</h5>
                                    <div class="row">
                                        @php
                                            $colorId=1;
                                        @endphp
                                        @foreach ($recentListings->where('status',1) as $index => $recentListing)
                                            @if ($recentListing->expired_date==null)
                                            @php
                                                if($index %3 ==0){
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
                                            @endphp
                                            <div class="col-xl-12 col-sm-6 col-lg-12">
                                                <div class="wsus__featured_single">
                                                    <a class="list_images" href="{{ route('listing.show',$listing->slug) }}">
                                                        <img src="{{ asset($recentListing->thumbnail_image) }}" alt="images" class="img-fluid w-100">
                                                    </a>
                                                    @guest
                                                    <span class="love"><a data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript::void"><i class="fas fa-heart"></i></a></span>
                                                    @else
                                                    <span class="love"><a href="{{ route('user.add.to.wishlist',$recentListing->id) }}"><i class="fas fa-heart"></i></a></span>
                                                    @endguest

                                                    <a class="map" data-bs-toggle="modal" data-bs-target="#listngPopUp-{{ $recentListing->id }}" href="javascript::void"><i class="fal fas fa-eye"></i></a>

                                                    <div class="wsus__featured_single_text">

                                                    <span class="small_text {{ $color }}"><a href="{{ route('listings',['category_slug'=>$recentListing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $recentListing->listingCategory->name }}</a></span>



                                                        @if ($recentListing->reviews->where('status',1)->count() > 0)
                                                        @php
                                                            $qty=$recentListing->reviews->where('status',1)->count();
                                                            $total=$recentListing->reviews->where('status',1)->sum('rating');
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
                                                        <h6><a href="{{ route('listing.show',$recentListing->slug) }}">{{ $recentListing->title }}</a></h6>
                                                        <p class="address">{{ $recentListing->address }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @elseif($recentListing->expired_date > date('Y-m-d'))
                                                @php
                                                    if($index %3 ==0){
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
                                                @endphp
                                                <div class="col-xl-12 col-sm-6 col-lg-12">
                                                    <div class="wsus__featured_single">
                                                        <a class="list_images" href="{{ route('listing.show',$listing->slug) }}">
                                                            <img src="{{ asset($recentListing->thumbnail_image) }}" alt="images" class="img-fluid w-100">
                                                        </a>
                                                        @guest
                                                        <span class="love"><a data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript::void"><i class="fas fa-heart"></i></a></span>
                                                        @else
                                                        <span class="love"><a href="{{ route('user.add.to.wishlist',$recentListing->id) }}"><i class="fas fa-heart"></i></a></span>
                                                        @endguest

                                                        <a class="map" data-bs-toggle="modal" data-bs-target="#listngPopUp-{{ $recentListing->id }}" href="javascript::void"><i class="fal fas fa-eye"></i></a>

                                                        <div class="wsus__featured_single_text">

                                                        <span class="small_text {{ $color }}"><a href="{{ route('listings',['category_slug'=>$recentListing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $recentListing->listingCategory->name }}</a></span>

                                                            @if ($recentListing->reviews->where('status',1)->count() > 0)
                                                            @php
                                                                $qty=$recentListing->reviews->where('status',1)->count();
                                                                $total=$recentListing->reviews->where('status',1)->sum('rating');
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
                                                            <h6><a href="{{ route('listing.show',$recentListing->slug) }}">{{ $recentListing->title }}</a></h6>
                                                            <p class="address">{{ $recentListing->address }}</p>
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
                            </div>

                            @foreach ($recentListings as $index => $listing)
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!--==========================
        LOG IN POPUP START
    ===========================-->
    <section id="wsus__login_popup">
        <div class="modal fade" id="cliaimModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $websiteLang->where('id',459)->first()->custom_text }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form id="claimeFormId" action="{{ route('send-claim') }}" method="post">
                                @csrf
                                <input required  type="text" placeholder="{{ $websiteLang->where('id',37)->first()->custom_text }} *" name="name">
                                <input required type="email" placeholder="{{ $websiteLang->where('id',38)->first()->custom_text }} *" name="email">
                                <textarea required cols="3" rows="5" name="comment" placeholder="{{ $websiteLang->where('id',457)->first()->custom_text }}" id="comment"></textarea>
                                <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                <button class="read_btn" id="claimSubmitBtn" type="submit">{{ $websiteLang->where('id',460)->first()->custom_text }}</button>
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



        </div>
        <!-- CONTENT END -->

        <script>
            (function($) {
            "use strict";
            $(document).ready(function () {

                $("#listingReviewBtn").on('click',function(e) {

                // project demo mode check
                var isDemo="{{ env('PROJECT_MODE') }}"
                var demoNotify="{{ env('NOTIFY_TEXT') }}"
                if(isDemo==0){
                    toastr.error(demoNotify);
                    return;
                }
                // end

                e.preventDefault();
                $("#listing-review-spinner").removeClass('d-none')
                $("#listingReviewBtn").addClass('custom-opacity')
                $("#listingReviewBtn").removeClass('site-btn-effect')
                $("#listingReviewBtn").attr('disabled',true);
                $.ajax({
                    url: "{{ route('user.store-review') }}",
                    type:"post",
                    data:$('#listingReviewForm').serialize(),
                    success:function(response){
                        if(response.success){
                            $("#listingReviewForm").trigger("reset");
                            $("#listing-review-spinner").addClass('d-none')
                            $("#listingReviewBtn").removeClass('custom-opacity')
                            $("#listingReviewBtn").attr('disabled',false);
                            $("#listingReviewBtn").addClass('site-btn-effect')

                            toastr.success(response.success)
                            console.log(response);

                        }
                        if(response.error){
                            toastr.error(response.error)
                        }
                    },
                    error:function(response){
                        if(response.responseJSON.errors.comment){
                            $("#listing-review-spinner").addClass('d-none')
                            $("#listingReviewBtn").removeClass('custom-opacity')
                            $("#listingReviewBtn").attr('disabled',false);
                            $("#listingReviewBtn").addClass('site-btn-effect')
                            toastr.error(response.responseJSON.errors.comment[0])
                        }


                        if(response.responseJSON.errors.comment){}else{
                            toastr.error('Please Complete the recaptcha to submit the form')
                            $("#listing-review-spinner").addClass('d-none')
                            $("#listingReviewBtn").removeClass('custom-opacity')
                            $("#listingReviewBtn").attr('disabled',false);
                            $("#listingReviewBtn").addClass('site-btn-effect')
                        }



                    }

                });


                })

                $("#listingAuthorContctBtn").on('click',function(e) {

                    // project demo mode check
                    var isDemo="{{ env('PROJECT_MODE') }}"
                    var demoNotify="{{ env('NOTIFY_TEXT') }}"
                    if(isDemo==0){
                        toastr.error(demoNotify);
                        return;
                    }
                    // end

                    e.preventDefault();
                    $("#listcontact-spinner").removeClass('d-none')
                    $("#listingAuthorContctBtn").addClass('custom-opacity')
                    $("#listingAuthorContctBtn").attr('disabled',true);
                    $("#listingAuthorContctBtn").removeClass('site-btn-effect')

                    $.ajax({
                        url: "{{ route('user.contact.message') }}",
                        type:"post",
                        data:$('#listingAuthContactForm').serialize(),
                        success:function(response){
                            if(response.success){
                                $("#listingAuthContactForm").trigger("reset");
                                toastr.success(response.success)
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')
                            }
                            if(response.error){
                                toastr.error(response.error)
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')

                            }
                        },
                        error:function(response){
                            if(response.responseJSON.errors.name){
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')

                                toastr.error(response.responseJSON.errors.name[0])

                            }

                            if(response.responseJSON.errors.email){
                                toastr.error(response.responseJSON.errors.email[0])
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')

                            }

                            if(response.responseJSON.errors.phone){
                                toastr.error(response.responseJSON.errors.phone[0])
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')
                            }

                            if(response.responseJSON.errors.subject){
                                toastr.error(response.responseJSON.errors.subject[0])
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')
                            }

                            if(response.responseJSON.errors.message){
                                toastr.error(response.responseJSON.errors.message[0])
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')
                            }


                            if(response.responseJSON.errors.email || response.responseJSON.errors.name || response.responseJSON.errors.phone || response.responseJSON.errors.subject || response.responseJSON.errors.message){

                            }else{
                                toastr.error('Please Complete the recaptcha to submit the form')
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')
                            }




                        }

                    });


                })



                $("#claimSubmitBtn").on('click',function(e) {

                    // project demo mode check
                    var isDemo="{{ env('PROJECT_MODE') }}"
                    var demoNotify="{{ env('NOTIFY_TEXT') }}"
                    if(isDemo==0){
                        toastr.error(demoNotify);
                        return;
                    }
                    // end

                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('send-claim') }}",
                        type:"post",
                        data:$('#claimeFormId').serialize(),
                        success:function(response){
                            console.log(response);

                            if(response.success){
                                $("#cliaimModal").modal('hide');
                                $("#claimeFormId").trigger("reset");
                                toastr.success(response.success)
                            }
                            if(response.error){
                                toastr.error(response.error)
                            }
                        },
                        error:function(response){
                            if(response.responseJSON.errors.email){
                                toastr.error(response.responseJSON.errors.email[0])
                            }

                            if(response.responseJSON.errors.name){
                                toastr.error(response.responseJSON.errors.name[0])
                            }

                            if(response.responseJSON.errors.comment){
                                toastr.error(response.responseJSON.errors.comment[0])
                            }


                        }

                    });


                })

            });

            })(jQuery);
        </script>
@endsection


