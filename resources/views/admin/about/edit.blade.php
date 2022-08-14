@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',315)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.about.update',$about->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',317)->first()->custom_text }}</label>
                                    <div><img class="w_200" src="{{ $about->background_image ? url($about->background_image) : '' }}" alt="About Background Image"></div>

                                </div>
                                <div class="form-group">
                                    <label for="">{{ $websiteLang->where('id',318)->first()->custom_text }}</label>
                                    <div><input type="file" name="image" class="form-control-file"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="video_link">{{ $websiteLang->where('id',295)->first()->custom_text }}</label>
                                    <input type="text" name="video_link" value="{{ $about->video_link }}" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="description">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                            <textarea name="description" id="description" class="summernote">{{ $about->description }}</textarea>
                        </div>


                        <button class="btn btn-success" type="submit">{{ $websiteLang->where('id',118)->first()->custom_text }} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

