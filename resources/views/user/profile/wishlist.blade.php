@extends('layouts.user.profile.layout')

@section('title')
    <title>{{ $websiteLang->where('id',71)->first()->custom_text }}</title>
@endsection

@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 col-xxl-10 ms-auto">
        <div class="dashboard_content">
          <div class="row">
            <div class="col-xl-12">
              <div class="dashboard_breadcrumb">
                <span>{{ $websiteLang->where('id',71)->first()->custom_text }}</span>
                <ul>
                  <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }} <i class="fas fa-caret-right"></i></a></li>
                  <li><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }} <i class="fas fa-caret-right"></i></a></li>
                  <li><a class="bread_active" href="#">{{ $websiteLang->where('id',71)->first()->custom_text }}</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="my_listing p_xm_0">
            <h4>{{ $websiteLang->where('id',71)->first()->custom_text }}</h4>
            <div class="row">

                @foreach ($wishlists as $index => $wishlist)
                @if ($wishlist->listing->expired_date==null)
                    <div class="col-xl-12 col-xxl-6">
                        <div class="active_inactive">
                        <div class="active_inactive_item">
                            <div class="active_inactive_img">
                            <img src="{{ asset($wishlist->listing->thumbnail_image) }}" alt="photo" class="img-fluid w-100">
                            </div>
                            <div class="active_inactive_text">
                            <h3> <a href="{{ route('listing.show',$wishlist->listing->slug) }}">{{ $wishlist->listing->title }}</a></h3>
                            <p><i class="far fa-map-marker-alt"></i> {{ $wishlist->listing->address }}</p>
                            <div class="color_text">



                                @if ($wishlist->listing->is_featured==1)
                                    <a href="javascript::void"><i class="far fa-star"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</a>
                                @endif

                                @if ($wishlist->listing->verified==1)
                                    <a class="red" href="javascript::void"><i class="far fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</a>

                                @endif

                            </div>
                            <ul>
                                <li></li>
                                <li></li>
                                <li><a href="{{ route('user.delete.wishlist',$wishlist->id) }}"><i class="fal fa-trash-alt"></i></a></li>
                            </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                    @elseif ($wishlist->listing->expired_date > date('Y-m-d'))
                    <div class="col-xl-12 col-xxl-6">
                        <div class="active_inactive">
                        <div class="active_inactive_item">
                            <div class="active_inactive_img">
                            <img src="{{ asset($wishlist->listing->thumbnail_image) }}" alt="photo" class="img-fluid w-100">
                            </div>
                            <div class="active_inactive_text">
                            <h3> <a href="{{ route('listing.show',$wishlist->listing->slug) }}">{{ $wishlist->listing->title }}</a></h3>
                            <p><i class="far fa-map-marker-alt"></i> {{ $wishlist->listing->address }}</p>
                            <div class="color_text">



                                @if ($wishlist->listing->is_featured==1)
                                    <a href="javascript::void"><i class="far fa-star"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</a>
                                @endif

                                @if ($wishlist->listing->verified==1)
                                    <a class="red" href="javascript::void"><i class="far fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</a>

                                @endif

                            </div>
                            <ul>
                                <li></li>
                                <li></li>
                                <li><a href="{{ route('user.delete.wishlist',$wishlist->id) }}"><i class="fal fa-trash-alt"></i></a></li>
                            </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endif

              @endforeach


            </div>
          </div>
        </div>
    </div>
  </div>
@endsection
