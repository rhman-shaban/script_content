@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',306)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',306)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ $websiteLang->where('id',463)->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('id',464)->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{ $websiteLang->where('id',465)->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="socail-tab" data-toggle="tab" href="#socail" role="tab" aria-controls="socail" aria-selected="false">{{ $websiteLang->where('id',466)->first()->custom_text }}</a>
                </li>

              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active mt-5" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @php
                        $aboutSection=$sections->where('id',1)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.section-about.update',$aboutSection->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                                    <input type="text" name="icon" value="{{ $aboutSection->icon }}"  class="form-control custom-icon-picker">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" name="header" value="{{ $aboutSection->header }}"   class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $aboutSection->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $aboutSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $aboutSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
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
                            <form action="{{ route('admin.section-feature.update',$featureSection->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                                    <input type="text" name="icon" value="{{ $featureSection->icon }}"  class="form-control custom-icon-picker">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" name="header" value="{{ $featureSection->header }}"   class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
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
                <div class="tab-pane fade mt-5" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    @php
                    $overViewSection=$sections->where('id',3)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.section-overview.update',$overViewSection->id) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="icon">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                                    <input type="text" class="form-control custom-icon-picker" name="icon" id="icon" value="{{ $overViewSection->icon }}">
                                </div>

                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $overViewSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $overViewSection->description }}</textarea>
                                </div>


                                <div class="form-group">
                                    <label for="sort_title">{{ $websiteLang->where('id',313)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="sort_title" id="sort_title" value="{{ $overViewSection->short_title }}">
                                </div>


                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $overViewSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $overViewSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-5" id="socail" role="tabpanel" aria-labelledby="socail-tab">
                    @php
                    $partnerSection=$sections->where('id',4)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.section-partner.update',$partnerSection->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="content_quantity">{{ $websiteLang->where('id',311)->first()->custom_text }}</label>
                                    <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $partnerSection->content_quantity }}">
                                </div>

                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $partnerSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $partnerSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
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
