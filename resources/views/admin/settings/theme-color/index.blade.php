@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',499)->first()->custom_text }}</title>
@endsection
@section('admin-content')
  <!-- DataTales Example -->
  <div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',499)->first()->custom_text }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.theme-color.update') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="theme_color_one">{{ $websiteLang->where('id',500)->first()->custom_text }} : </label>
                        <input type="color" id="theme_color_one" name="theme_one" value="{{ $setting->theme_one }}">
                    </div>
                    <div class="form-group">
                        <label for="theme_color_two">{{ $websiteLang->where('id',501)->first()->custom_text }} : </label>
                        <input type="color" id="theme_color_two" name="theme_two" value="{{ $setting->theme_two }}">
                    </div>




                    <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection



