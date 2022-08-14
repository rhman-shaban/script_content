@php
    $setting=App\Setting::first();
    $userInfo=Auth::guard('web')->user();
    $websiteLang=App\ManageText::all();
    $defaultImage=App\BannerImage::where('id',15)->first();
@endphp


@include('layouts.user.profile.header')

<!--=============================
        DASHBOARD MENU START
  ==============================-->
  <nav class="navbar dashboard_menu">
    <span class="menu_icon"><i class="fal fa-bars"></i></span>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ $userInfo->image ? asset($userInfo->image) : asset($defaultImage->image) }}" alt="img" class="img-fluid w-100">
            {{ $userInfo->name }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="{{ route('user.my-profile') }}">{{ $websiteLang->where('id',72)->first()->custom_text }}</a></li>
          <li><a class="dropdown-item" href="{{ route('user.create.listing') }}">{{ $websiteLang->where('id',70)->first()->custom_text }}</a></li>
          <li><a class="dropdown-item" href="{{ route('user.review') }}">{{ $websiteLang->where('id',9)->first()->custom_text }}</a></li>
          <li><a class="dropdown-item" href="{{ route('logout') }}">{{ $websiteLang->where('id',74)->first()->custom_text }}</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <!--=============================
        DASHBOARD MENU END
  ==============================-->
	  <!--=============================
        DASHBOARD START
  ==============================-->
  <section id="dashboard">
    <div class="container-fluid">
      <div class="dashboard_sidebar">
        <span class="close_icon"><i class="far fa-times"></i></span>
        <a href="{{ route('home') }}" class="dash_logo"><img src="{{ $setting->logo ? asset($setting->logo) : '' }}" alt="logo" class="img-fluid"></a>
        <ul class="dashboard_link">
            <li><a class="{{ Route::is('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer"></i>{{ $websiteLang->where('id',68)->first()->custom_text }}</a></li>
            <li><a class="{{ Route::is('user.my.listing') || Route::is('user.listing.edit') || Route::is('user.listing.schedule.index') || Route::is('user.schedule.create') || Route::is('user.listing.schedule.edit') ? 'active' : '' }}" href="{{ route('user.my.listing') }}"><i class="fas fa-list-ul"></i> {{ $websiteLang->where('id',69)->first()->custom_text }}</a></li>

            <li><a class="{{ Route::is('user.create.listing') ? 'active' : '' }}" href="{{ route('user.create.listing') }}"><i class="fal fa-plus-circle"></i> {{ $websiteLang->where('id',70)->first()->custom_text }}</a></li>
            <li><a class="{{ Route::is('user.review') || Route::is('user.edit-review') ? 'active' : '' }}" href="{{ route('user.review') }}"><i class="far fa-star"></i> {{ $websiteLang->where('id',9)->first()->custom_text }}</a></li>
            <li><a class="{{ Route::is('user.my-wishlist') ? 'active' : '' }}" href="{{ route('user.my-wishlist') }}"><i class="far fa-heart"></i> {{ $websiteLang->where('id',71)->first()->custom_text }}</a></li>
            <li><a class="{{ Route::is('user.my-profile') ? 'active' : '' }}" href="{{ route('user.my-profile') }}"><i class="far fa-user"></i> {{ $websiteLang->where('id',72)->first()->custom_text }}</a></li>
            <li><a class="{{ Route::is('user.my-order') || Route::is('user.order.details') ? 'active' : '' }}" href="{{ route('user.my-order') }}"><i class="fal fa-notes-medical"></i> {{ $websiteLang->where('id',73)->first()->custom_text }}</a></li>
            <li><a class="{{ Route::is('user.package') ? 'active' : '' }}" href="{{ route('user.package') }}"><i class="fal fa-gift-card"></i> {{ $websiteLang->where('id',86)->first()->custom_text }}</a></li>
            <li><a href="{{ route('logout') }}"><i class="far fa-sign-out-alt"></i> {{ $websiteLang->where('id',74)->first()->custom_text }}</a></li>
        </ul>
      </div>

      @yield('user-dashboard')
    </div>
  </section>
<!--=============================
      DASHBOARD START
==============================-->
@include('layouts.user.profile.footer')
