@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',86)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.listing-package.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('id',339)->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',340)->first()->custom_text }} <span class="text-danger">({{ $websiteLang->where('id',424)->first()->custom_text }} = -1 )</span> </h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.listing-package.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="package_type">{{ $websiteLang->where('id',338)->first()->custom_text }}</label>
                                    <select name="package_type" id="package_type" class="form-control">
                                        <option value="1">{{ $websiteLang->where('id',341)->first()->custom_text }}</option>
                                        <option value="0">{{ $websiteLang->where('id',342)->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="package_name">{{ $websiteLang->where('id',343)->first()->custom_text }}</label>
                                    <input type="text" name="package_name" class="form-control" id="package_name" value="{{ old('package_name') }}">
                                </div>
                            </div>
                            <div class="col-md-4" id="price-row">
                                <div class="form-group">
                                    <label for="price">{{ $websiteLang->where('id',344)->first()->custom_text }}</label>
                                    <input type="text" name="price" class="form-control" id="price" value="{{ old('price') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="number_of_days">{{ $websiteLang->where('id',345)->first()->custom_text }}</label>
                                    <input type="number" name="number_of_days" class="form-control" id="number_of_days" value="{{ old('number_of_days') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="number_of_aminities">{{ $websiteLang->where('id',346)->first()->custom_text }}</label>
                                    <input type="number" name="number_of_aminities" class="form-control" id="number_of_aminities" value="{{ old('number_of_aminities') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="number_of_photo">{{ $websiteLang->where('id',347)->first()->custom_text }}</label>
                                    <input type="number" name="number_of_photo" class="form-control" id="number_of_photo" value="{{ old('number_of_photo') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="number_of_video">{{ $websiteLang->where('id',348)->first()->custom_text }}</label>
                                    <input type="number" name="number_of_video" class="form-control" id="number_of_video" value="{{ old('number_of_video') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="number_of_listing">{{ $websiteLang->where('id',349)->first()->custom_text }}</label>
                                    <input type="number" name="number_of_listing" class="form-control" id="number_of_listing" value="{{ old('number_of_listing') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="feature">{{ $websiteLang->where('id',350)->first()->custom_text }}</label>
                                    <select name="feature" id="feature" class="form-control">
                                        <option  value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option  value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="feature-row">
                                <div class="form-group">
                                    <label for="number_of_feature_listing">{{ $websiteLang->where('id',351)->first()->custom_text }}</label>
                                    <input type="number" name="number_of_feature_listing" id="number_of_feature_listing" class="form-control" value="{{ old('number_of_feature_listing') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">{{ $websiteLang->where('id',135)->first()->custom_text }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option  value="1">{{ $websiteLang->where('id',140)->first()->custom_text }}</option>
                                        <option  value="0">{{ $websiteLang->where('id',141)->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>




                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',117)->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $("#package_type").on('change',function(){
                var type=$("#package_type").val()
                if(type==0){
                    $("#price-row").addClass('d-none')
                }
                if(type==1){
                    $("#price-row").removeClass('d-none')
                }

            })

            $("#feature").on('change',function(){
                var type=$("#feature").val()
                if(type==0){
                    $("#feature-row").addClass('d-none')
                }
                if(type==1){
                    $("#feature-row").removeClass('d-none')
                }

            })





        });

        })(jQuery);
    </script>

@endsection
