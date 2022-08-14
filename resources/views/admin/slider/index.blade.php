@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',278)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',278)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
           <form action="{{ route('admin.banner.update',$slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="">{{ $websiteLang->where('id',283)->first()->custom_text }}</label>
                <div class="my-2">
                    <img src="{{ $slider->image ? url($slider->image) : '' }}" alt="banner image" class="slider_w">
                </div>

                <label for="">{{ $websiteLang->where('id',284)->first()->custom_text }}</label>
                <input type="file" name="image" class="form-control-file">
            </div>

            <button class="btn btn-success" type="submit">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

           </form>
        </div>
    </div>


@endsection
