@extends('layouts.user.layout')
@section('title')
    <title>{{ $user->name }}</title>
@endsection
@section('user-content')
<!--==========================
         BREADCRUMB PART START
    ===========================-->
    <div id="breadcrumb_part" style="background-image:url({{ $user->banner_image ? asset($user->banner_image) : asset($image->image) }});">
        <div class="bread_overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center text-white">
                        <h4>{{ $user->name }}</h4>
                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{ $menus->where('id',1)->first()->navbar }} </a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
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
        AGENT PROFILE STA
    ===========================-->
    <section id="wsus__agent_profile">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__profile_header">
                        <img src="{{ $user->image ? asset($user->image) : asset($default_image->image) }}" alt="images" class="img-fluid">
                        <div class="wsus__profile_text">
                            <h4>{{ $user->name }}</h4>

                            <a href="mailto:{{ $user->email }}"><i class="fal fa-envelope-open"></i> {{ $user->email }}</a>

                            @if ($user->phone)
                            <a href="callt0:+{{ $user->phone }}"><i class="fas fa-phone-alt"></i> {{ $user->phone }}</a>
                            @endif


                            @if ($user->address)
                            <p><i class="fal fa-map-marker-alt"></i> {{ $user->address }}</p>
                            @endif

                            @if ($user->website)
                            <p><i class="fal fa-globe"></i> {{ $user->website }}</p>
                            @endif
                            @if ($user->about)
                            <span>{{ $user->about }}</span>
                            @endif


                        </div>
                        @if ($user_type==1)
                        <ul class="wsus__agent_link">
                            @if ($user->facebook)
                            <li>
                                <a target="_blank" href="{{ $user->facebook }}" class="fab fa-facebook icon"></a>
                            </li>
                            @endif
                            @if ($user->twitter)
                            <li>
                                <a target="_blank" href="{{ $user->twitter }}" class="fab fa-twitter icon"></a>
                            </li>
                            @endif
                            @if ($user->linkedin)
                            <li>
                                <a target="_blank" href="{{ $user->linkedin }}" class="fab fa-linkedin icon"></a>
                            </li>
                            @endif
                            @if ($user->whatsapp)
                            <li>
                                <a target="_blank" href="{{ $user->whatsapp }}" class="fab fa-whatsapp icon"></a>
                            </li>
                            @endif
                            @if ($user->youtube)
                            <li>
                                <a target="_blank" href="{{ $user->youtube }}" class="fab fa-youtube icon"></a>
                            </li>
                            @endif

                            @if ($user->instagram)
                            <li>
                                <a target="_blank" href="{{ $user->instagram }}" class="fab fa-instagram icon"></a>
                            </li>
                            @endif

                        </ul>

                        @else

                        <ul class="wsus__agent_link">
                            @foreach ($user->socialLinks as $item)
                                <li>
                                    <a target="_blank" href="{{ $item->link }}" class="{{ $item->icon }}"></a>
                                </li>
                            @endforeach

                        </ul>

                        @endif

                    </div>
                </div>

                @php
                    $colorId=1;
                @endphp
                @foreach ($listings as $index => $listing)
                @if ($listing->expired_date==null)
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

                    <div class="col-xl-4 col-sm-6 col-lg-4">
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



                @elseif($listing->expired_date> date('Y-m-d'))
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

                    <div class="col-xl-4 col-sm-6 col-lg-4">
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
    </section>

    <!--==========================
        AGENT PROFILE STA
    ===========================-->

@endsection


