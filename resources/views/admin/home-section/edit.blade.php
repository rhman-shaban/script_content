@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',277)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.home-section.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('id',277)->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ ucwords($homeSection->section_name) }}</h6>
                </div>
                <div class="card-body">

                   <form action="{{ route('admin.home-section.update',$homeSection->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    @if ($homeSection->id ==1 || $homeSection->id ==9)
                    <div class="row" id="section-details">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                                <input type="text" class="form-control" name="header" id="header" value="{{ $homeSection->header }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $homeSection->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                                <select name="show_homepage" id="show_homepage" class="form-control">
                                    <option {{ $homeSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                    <option {{ $homeSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                @elseif ($homeSection->id==3)
                <div class="row" id="section-details">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                            <textarea class="form-control" cols="30" rows="3"  id="header" name="header">{{ $homeSection->header }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sort_title">{{ $websiteLang->where('id',313)->first()->custom_text }}</label>
                            <input type="text" class="form-control" name="sort_title" id="sort_title" value="{{ $homeSection->description }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                            <select name="show_homepage" id="show_homepage" class="form-control">
                                <option {{ $homeSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                <option {{ $homeSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                @else
                <div class="row" id="section-details">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                            <input type="text" class="form-control" name="icon" id="icon" value="{{ $homeSection->icon }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="header">{{ $websiteLang->where('id',310)->first()->custom_text }}</label>
                            <input type="text" class="form-control" name="header" id="header" value="{{ $homeSection->header }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                            <textarea class="form-control" cols="30" rows="5"  id="description" name="description">{{ $homeSection->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="content_quantity">{{ $websiteLang->where('id',311)->first()->custom_text }}</label>
                            <input type="number" name="content_quantity" id="content_quantity" class="form-control" value="{{ $homeSection->content_quantity }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="show_homepage">{{ $websiteLang->where('id',239)->first()->custom_text }}</label>
                            <select name="show_homepage" id="show_homepage" class="form-control">
                                <option {{ $homeSection->show_homepage==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                <option {{ $homeSection->show_homepage==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                @endif
                    <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                </form>
                </div>
            </div>
        </div>
    </div>

@endsection
