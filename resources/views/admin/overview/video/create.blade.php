@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',290)->first()->custom_text }}</title>
@endsection
@section('admin-content')

    <div class="row">
        <div class="col-md-6">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800 d-inline"><a href="{{ route('admin.overview.index') }}" class="btn btn-success"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('id',294)->first()->custom_text }}</a></h1>

            <!-- DataTales Example -->
            <div class="card shadow my-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',290)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">
                <form action="{{ route('admin.overview.video.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('id',295)->first()->custom_text }}</label>
                        <input type="text" class="form-control" name="video_link">
                    </div>
                    <button class="btn btn-success" type="submit">{{ $websiteLang->where('id',117)->first()->custom_text }}</button>
                </form>
                </div>
            </div>
        </div>
    </div>




@endsection
