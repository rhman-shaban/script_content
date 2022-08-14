@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',307)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',307)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ $websiteLang->where('id',467)->first()->custom_text }}</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ $websiteLang->where('id',468)->first()->custom_text }}</a>
                </li>

              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active mt-5" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @php
                        $packageSection=$sections->where('id',1)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.package-section-package-page',$packageSection->id) }}" method="post">
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
                <div class="tab-pane fade mt-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @php
                    $subscirbeSection=$sections->where('id',2)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('admin.subscirbe-section-package-page',$subscirbeSection->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="header" id="header" value="{{ $subscirbeSection->header }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                    <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $subscirbeSection->description }}</textarea>
                                </div>


                                <div class="form-group">
                                    <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option {{ $subscirbeSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option {{ $subscirbeSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
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
