@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',268)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $text->page_name }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.update-seo',$text->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',90)->first()->custom_text }}</label>
                            <input type="text" name="title" class="form-control" value="{{ $text->title }}">
                        </div>
                        <div class="form-group">
                            <label for="meta_description">{{ $websiteLang->where('id',276)->first()->custom_text }}</label>
                            <textarea name="meta_description" id="meta_description" cols="30" rows="5" class="form-control">{{ $text->meta_description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success"> {{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
