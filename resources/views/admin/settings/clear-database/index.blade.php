@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',166)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',166)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('admin.clear.all.data') }}" onclick="return confirm('Are You sure do you want to clear this database?')">{{ $websiteLang->where('id',201)->first()->custom_text }}</a>
                </div>
            </div>
        </div>
    </div>

@endsection
