@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',72)->first()->custom_text }}</title>
@endsection

@section('admin-content')
       <!-- DataTales Example -->
       <div class="row">
           <div class="col-md-12">
               <div class="card shadow mb-4">
                   <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',72)->first()->custom_text }}</h6>
                   </div>
                   <div class="card-body">
                       @if (Session::has('update-profile'))
                           <p class="alert alert-success">{{ Session::get('update-profile') }}</p>
                       @endif
                    <form action="{{ route('admin.update.profile') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',283)->first()->custom_text }}</label>
                                    @if ($admin->banner_image)
                                    <div class="banner-image">
                                        <img src="{{ asset($admin->banner_image) }}" alt="">
                                    </div>
                                     @else
                                     <div class="banner-image">
                                        <img src="{{ asset($image->image) }}" alt="">
                                    </div>
                                    @endif

                                    <label class="mt-1">{{ $websiteLang->where('id',168)->first()->custom_text }}</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control-file wt-form-control" name="banner_image" type="file">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',126)->first()->custom_text }}</label>
                                    <div>
                                        @if ($admin->image)
                                        <img class="img-thumbnail cat_img_w" src="{{ url($admin->image) }}" alt="default user image">

                                        @else
                                        <img class="img-thumbnail cat_img_w" src="{{ url($default_profile->image) }}" alt="default user image">

                                        @endif
                                    </div>
                                    <label for="" class="mt-2">{{ $websiteLang->where('id',121)->first()->custom_text }}</label>
                                    <input type="file" class="form-control-file" name="image">

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',37)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" value="{{ ucfirst($admin->name) }}" name="name">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',38)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" value="{{ $admin->email }}" name="email">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',39)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" value="{{ $admin->phone }}" name="phone">

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook">{{ $websiteLang->where('id',106)->first()->custom_text }}</label>
                                    <input type="text" name="facebook" value="{{ $admin->facebook }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter">{{ $websiteLang->where('id',107)->first()->custom_text }}</label>
                                    <input type="text" name="twitter" value="{{  $admin->twitter }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin">{{ $websiteLang->where('id',108)->first()->custom_text }}</label>
                                    <input type="text" name="linkedin" value="{{  $admin->linkedin }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="whatsapp">{{ $websiteLang->where('id',109)->first()->custom_text }}</label>
                                    <input type="text" name="whatsapp" value="{{  $admin->whatsapp }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="instagram">{{ $websiteLang->where('id',110)->first()->custom_text }}</label>
                                    <input type="text" name="instagram" value="{{  $admin->instagram }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pinterest">{{ $websiteLang->where('id',111)->first()->custom_text }}</label>
                                    <input type="text" name="pinterest" value="{{  $admin->pinterest }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="youtube">{{ $websiteLang->where('id',113)->first()->custom_text }}</label>
                                    <input type="text" name="youtube" value="{{  $admin->youtube }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="webiste">{{ $websiteLang->where('id',93)->first()->custom_text }}</label>
                                    <input type="text" name="website" value="{{  $admin->website }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">{{ $websiteLang->where('id',55)->first()->custom_text }}</label>
                                    <input type="text" name="address" value="{{  $admin->address }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="about">{{ $websiteLang->where('id',271)->first()->custom_text }}</label>
                                   <textarea name="about" id="about" cols="30" rows="2" class="form-control">{{  $admin->about }}</textarea>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',150)->first()->custom_text }}</label>
                                    <input  type="password" class="form-control" name="password">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',67)->first()->custom_text }}</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                        </div>










                        <button class="btn btn-success" type="submit">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                    </form>
                   </div>
               </div>
           </div>
       </div>
@endsection

