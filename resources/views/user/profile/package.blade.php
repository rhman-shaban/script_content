@extends('layouts.user.profile.layout')

@section('title')
    <title>{{ $websiteLang->where('id',86)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 col-xxl-10 ms-auto">
        <div class="dashboard_content">
          <div class="row">
            <div class="col-xl-12">
              <div class="dashboard_breadcrumb">
                <span>{{ $websiteLang->where('id',86)->first()->custom_text }}</span>
                <ul>
                  <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }} <i class="fas fa-caret-right"></i></a></li>
                  <li><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }} <i class="fas fa-caret-right"></i></a></li>
                  <li><a class="bread_active" href="javascript::void">{{ $websiteLang->where('id',86)->first()->custom_text }}</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="my_listing p_xm_0">
            <div class="procing_area">
              <div class="row">
              @foreach ($listingPackages as $index=> $listingPackage)
              @php
                  $unlimited=$websiteLang->where('id',425)->first()->custom_text;
              @endphp
              <div class="col-xl-4 col-xxl-4 col-sm-6">
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
  </div>
@endsection
