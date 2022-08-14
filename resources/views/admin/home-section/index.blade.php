@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',277)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',277)->first()->custom_text }}</h6>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ $websiteLang->where('id',469)->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('id',464)->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('id',465)->first()->custom_text }}</a>
                </li>

                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#category" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('id',92)->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#location" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('id',470)->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#listings" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('id',471)->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#package" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('id',86)->first()->custom_text }}</a>
                </li>

                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#blog" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('id',230)->first()->custom_text }}</a>
                </li>

                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#subscirber" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('id',468)->first()->custom_text }}</a>
                </li>

                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#testimonial" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('id',473)->first()->custom_text }}</a>
                </li>

                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#banner-category" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('id',474)->first()->custom_text }}</a>
                </li>








              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active mt-5" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @php
                    $bannerSection=$sections->where('id',1)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.banner-in-homepage',$bannerSection->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $bannerSection->header }}">
                                </div>


                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $bannerSection->description }}</textarea>
                                </div>


                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $bannerSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $bannerSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>



                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade mt-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @php
                    $featureSection=$sections->where('id',2)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$featureSection->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="icon">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                                    <input type="text" class="form-control custom-icon-picker" name="icon" id="icon" value="{{ $featureSection->icon }}">
                                </div>

                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $featureSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $featureSection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('id',311)->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $featureSection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $featureSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $featureSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade mt-5" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    @php
                    $overviewSection=$sections->where('id',3)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.overview-in-homepage',$overviewSection->id) }}" method="post">
                                @csrf


                                <div class="form-group">
                                    <label for="icon">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                                    <input type="text" class="form-control custom-icon-picker" name="icon" id="icon" value="{{ $overviewSection->icon }}">
                                </div>

                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $overviewSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $overviewSection->description }}</textarea>
                                </div>


                                <div class="form-group">
                                    <label for="sort_title">{{ $websiteLang->where('id',313)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="sort_title" id="sort_title" value="{{ $overviewSection->short_title }}">
                                </div>


                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $overviewSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $overviewSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>



                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade mt-5" id="category" role="tabpanel" aria-labelledby="category-tab">
                    @php
                    $categorySection=$sections->where('id',4)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$categorySection->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="icon">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                                    <input type="text" class="form-control custom-icon-picker" name="icon" id="icon" value="{{ $categorySection->icon }}">
                                </div>

                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $categorySection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $categorySection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('id',311)->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $categorySection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $categorySection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $categorySection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>



                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade mt-5" id="location" role="tabpanel" aria-labelledby="location-tab">
                    @php
                    $locationSection=$sections->where('id',5)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$locationSection->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="icon">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                                    <input type="text" class="form-control custom-icon-picker" name="icon" id="icon" value="{{ $locationSection->icon }}">
                                </div>

                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $locationSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $locationSection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('id',311)->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $locationSection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $locationSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $locationSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>



                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade mt-5" id="listings" role="tabpanel" aria-labelledby="listings-tab">
                     @php
                    $listingSection=$sections->where('id',6)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$listingSection->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="icon">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                                    <input type="text" class="form-control custom-icon-picker" name="icon" id="icon" value="{{ $listingSection->icon }}">
                                </div>

                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $listingSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $listingSection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('id',311)->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $listingSection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $listingSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $listingSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>



                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade mt-5" id="package" role="tabpanel" aria-labelledby="package-tab">
                    @php
                    $packageSection=$sections->where('id',7)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$packageSection->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="icon">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                                    <input type="text" class="form-control custom-icon-picker" name="icon" id="icon" value="{{ $packageSection->icon }}">
                                </div>

                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $packageSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $packageSection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('id',311)->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $packageSection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $packageSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $packageSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>



                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-5" id="blog" role="tabpanel" aria-labelledby="blog-tab">
                    @php
                    $blogSection=$sections->where('id',8)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$blogSection->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="icon">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                                    <input type="text" class="form-control custom-icon-picker" name="icon" id="icon" value="{{ $blogSection->icon }}">
                                </div>

                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $blogSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $blogSection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('id',311)->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $blogSection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $blogSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $blogSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-5" id="subscirber" role="tabpanel" aria-labelledby="subscirber-tab">
                    @php
                    $subscribeSection=$sections->where('id',9)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.banner-in-homepage',$subscribeSection->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $subscribeSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $subscribeSection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $subscribeSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $subscribeSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>


                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-5" id="testimonial" role="tabpanel" aria-labelledby="testimonial-tab">
                    @php
                    $testimonial=$sections->where('id',10)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.feature-in-homepage',$testimonial->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="icon">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                                    <input type="text" class="form-control custom-icon-picker" name="icon" id="icon" value="{{ $testimonial->icon }}">
                                </div>

                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $testimonial->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $testimonial->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('id',311)->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $testimonial->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $testimonial->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $testimonial->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-5" id="banner-category" role="tabpanel" aria-labelledby="banner-category-tab">
                    @php
                    $bannerCategory=$sections->where('id',11)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.banner-category-in-homepage',$bannerCategory->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $bannerCategory->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $bannerCategory->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>

              </div>
        </div>

    </div>

@endsection
