@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',69)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 col-xxl-10 ms-auto">
        <div class="dashboard_content">
          <div class="row">
            <div class="col-xl-12">
              <div class="dashboard_breadcrumb">
                <span>{{ $websiteLang->where('id',69)->first()->custom_text }}</span>
                <ul>
                  <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }} <i class="fas fa-caret-right"></i></a></li>
                  <li><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }} <i class="fas fa-caret-right"></i></a></li>
                  <li><a class="bread_active" href="#">{{ $websiteLang->where('id',69)->first()->custom_text }}</a></li>
                </ul>
              </div>
            </div>
          </div>

          @php
                $currentlyActive=0;
                $currentlyInActive=0;

                if($activeQty != -2){
                    if($activeQty==-1){
                        foreach ($listings as $index => $listing) {
                            if($listing->status==1){
                                $currentlyActive +=1;
                            }
                        }
                    }else{
                        foreach ($listings->take($activeQty) as $index => $listing) {
                            if($listing->status==1){
                                $currentlyActive +=1;
                            }
                        }
                    }
                }

                if($activeQty == -2){
                    $currentlyInActive=$listings->count()-$currentlyActive;
                }else if($activeQty==-1){
                    foreach ($listings as $index => $listing) {
                        if($listing->status==0){
                            $currentlyInActive +=1;
                        }
                    }
                }else{
                    $activeListings=$listings->take($activeQty)->where('status',1);
                    $arr=array();
                    foreach ($activeListings as $index => $listing) {
                        $arr[]=$listing->id;
                    }

                    $pendingListings=$allListings->whereNotIn('id',$arr);

                    foreach ($pendingListings as $index => $listing) {
                        $currentlyInActive +=1;
                    }
                }

            @endphp

          <div class="my_listing p_xm_0">
            <div class="row">
              <div class="col-xxl-6 col-xl-12">
                <div class="active_inactive">
                  <h6>{{ $websiteLang->where('id',491)->first()->custom_text }} <span>{{ $currentlyActive }}</span></h6>

                  @if ($activeQty ==-2)
                        <h3 class="text-danger">{{ $websiteLang->where('id',396)->first()->custom_text }}</h3>
                  @elseif($activeQty==-1)
                    @foreach ($listings->where('status',1) as $index => $listing)
                        <div class="active_inactive_item">
                            <div class="active_inactive_img">
                            <img src="{{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }}" alt="photo" class="img-fluid w-100">
                            </div>
                            <div class="active_inactive_text">
                            <h3><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }}</a> </h3>
                            <p><i class="far fa-map-marker-alt"></i> {{ $listing->address }}</p>
                            <div class="color_text">
                                @if ($listing->is_featured==1)
                                    <a href="javascript::void"><i class="far fa-star"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</a>
                                @endif

                                @if ($listing->verified==1)
                                <a class="red" href="javascript::void"><i class="far fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</a>
                                @endif

                            </div>
                            <ul>
                                <li><a href="{{ route('user.listing.schedule.index',$listing->id) }}"><i class="far fa-plus"></i></a></li>
                                <li><a href="{{ route('user.listing.edit',$listing->id) }}"><i class="fal fa-edit"></i></a></li>
                                <li><a onclick="return confirm('{{ $notify }}')" href="{{ route('user.listing.delete',$listing->id) }}"><i class="fal fa-trash-alt"></i></a></li>
                            </ul>
                            </div>
                        </div>
                    @endforeach
                  @else
                    @foreach ($listings->take($activeQty)->where('status',1) as $index => $listing)
                    <div class="active_inactive_item">
                        <div class="active_inactive_img">
                        <img src="{{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }}" alt="photo" class="img-fluid w-100">
                        </div>
                        <div class="active_inactive_text">
                        <h3><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }}</a> </h3>
                        <p><i class="far fa-map-marker-alt"></i> {{ $listing->address }}</p>
                        <div class="color_text">
                            @if ($listing->is_featured==1)
                                <a href="javascript::void"><i class="far fa-star"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</a>
                            @endif

                            @if ($listing->verified==1)
                            <a class="red" href="javascript::void"><i class="far fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</a>
                            @endif

                        </div>
                        <ul>
                            <li><a href="{{ route('user.listing.schedule.index',$listing->id) }}"><i class="far fa-plus"></i></a></li>
                            <li><a href="{{ route('user.listing.edit',$listing->id) }}"><i class="fal fa-edit"></i></a></li>
                            <li><a onclick="return confirm('{{ $notify }}')" href="{{ route('user.listing.delete',$listing->id) }}"><i class="fal fa-trash-alt"></i></a></li>
                        </ul>
                        </div>
                    </div>
                    @endforeach
                  @endif
                </div>
              </div>

            </div>
          </div>

          <div class="my_listing p_xm_0 mt-4" >
            <div class="row">
              <div class="col-xxl-6 col-xl-12">
                <div class="active_inactive">
                  <h6>{{ $websiteLang->where('id',492)->first()->custom_text }} <span class="red">{{ $currentlyInActive }}</span></h6>
                    @if ($currentlyInActive==0)
                        <h3 class="text-danger">{{ $websiteLang->where('id',396)->first()->custom_text }}</h3>
                    @else

                        @if ($activeQty ==-2)
                            @foreach ($listings as $index =>  $listing)
                                <div class="active_inactive_item">
                                    <div class="active_inactive_img">
                                    <img src="{{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }}" alt="photo" class="img-fluid w-100">
                                    </div>
                                    <div class="active_inactive_text">
                                    <h3><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }}</a></h3>
                                    <p><i class="far fa-map-marker-alt"></i> {{ $listing->address }}</p>
                                    <div class="color_text">



                                        @if ($listing->is_featured==1)
                                            <a href="#"><i class="far fa-star"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</a>
                                        @endif

                                        @if ($listing->verified==1)
                                        <a class="red" href="#"><i class="far fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</a>
                                        @endif

                                    </div>
                                    <ul>
                                        <li><a href="{{ route('user.listing.schedule.index',$listing->id) }}"><i class="far fa-plus"></i></a></li>
                                        <li><a href="{{ route('user.listing.edit',$listing->id) }}"><i class="fal fa-edit"></i></a></li>
                                        <li><a onclick="return confirm('{{ $notify }}')" href="{{ route('user.listing.delete',$listing->id) }}"><i class="fal fa-trash-alt"></i></a></li>
                                    </ul>
                                    </div>
                                </div>
                            @endforeach
                        @elseif($activeQty==-1)
                            @foreach ($listings->where('status',0) as $index =>  $listing)
                                <div class="active_inactive_item">
                                    <div class="active_inactive_img">
                                    <img src="{{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }}" alt="photo" class="img-fluid w-100">
                                    </div>
                                    <div class="active_inactive_text">
                                    <h3><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }}</a></h3>
                                    <p><i class="far fa-map-marker-alt"></i> {{ $listing->address }}</p>
                                    <div class="color_text">



                                        @if ($listing->is_featured==1)
                                            <a href="#"><i class="far fa-star"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</a>
                                        @endif

                                        @if ($listing->verified==1)
                                        <a class="red" href="#"><i class="far fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</a>
                                        @endif

                                    </div>
                                    <ul>
                                        <li><a href="{{ route('user.listing.schedule.index',$listing->id) }}"><i class="far fa-plus"></i></a></li>
                                        <li><a href="{{ route('user.listing.edit',$listing->id) }}"><i class="fal fa-edit"></i></a></li>
                                        <li><a onclick="return confirm('{{ $notify }}')" href="{{ route('user.listing.delete',$listing->id) }}"><i class="fal fa-trash-alt"></i></a></li>
                                    </ul>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @php
                                $activeListings=$listings->take($activeQty)->where('status',1);
                                $arr=array();
                                foreach ($activeListings as $index => $listing) {
                                    $arr[]=$listing->id;
                                }

                                $pendingListings=$allListings->whereNotIn('id',$arr);
                            @endphp

                            @foreach ($pendingListings as $index =>  $listing)
                                <div class="active_inactive_item">
                                    <div class="active_inactive_img">
                                    <img src="{{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }}" alt="photo" class="img-fluid w-100">
                                    </div>
                                    <div class="active_inactive_text">
                                    <h3><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }}</a></h3>
                                    <p><i class="far fa-map-marker-alt"></i> {{ $listing->address }}</p>
                                    <div class="color_text">



                                        @if ($listing->is_featured==1)
                                            <a href="#"><i class="far fa-star"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</a>
                                        @endif

                                        @if ($listing->verified==1)
                                        <a class="red" href="#"><i class="far fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</a>
                                        @endif

                                    </div>
                                    <ul>
                                        <li><a href="{{ route('user.listing.schedule.index',$listing->id) }}"><i class="far fa-plus"></i></a></li>
                                        <li><a href="{{ route('user.listing.edit',$listing->id) }}"><i class="fal fa-edit"></i></a></li>
                                        <li><a onclick="return confirm('{{ $notify }}')" href="{{ route('user.listing.delete',$listing->id) }}"><i class="fal fa-trash-alt"></i></a></li>
                                    </ul>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif
                </div>
              </div>
            </div>
          </div>


        </div>
    </div>
  </div>
@endsection
