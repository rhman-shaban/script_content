@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',518)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',518)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach ($errorpages as $index =>  $errorpage)
                            <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $index==0 ? 'active' : '' }}" id="home-tab-{{ $errorpage->id }}" data-toggle="tab" href="#home-{{ $errorpage->id }}" role="tab" aria-controls="home" aria-selected="true">{{ $errorpage->page_name }}</a>
                            </li>
                        @endforeach


                      </ul>
                      <div class="tab-content" id="myTabContent">

                            @foreach ($errorpages as $index =>  $errorpage)
                                <div class="tab-pane fade {{ $index==0 ? 'show active' : '' }}"" id="home-{{ $errorpage->id }}" role="tabpanel" aria-labelledby="home-tab-{{ $errorpage->id }}">
                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <form action="{{ route('admin.error-page.update',$errorpage->id) }}" enctype="multipart/form-data" method="POST">
                                                    @method('PATCH')
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-12 d-none">
                                                            <div class="form-group">
                                                                <label for="">{{ $websiteLang->where('id',126)->first()->custom_text }}</label>
                                                                <div>
                                                                    <img src="{{ asset($errorpage->image) }}" width="300px" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-none">
                                                            <div class="form-group">
                                                                <label for="">{{ $websiteLang->where('id',121)->first()->custom_text }}</label>
                                                                <input type="file" name="image" class="form-control-file">
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="">{{ $websiteLang->where('id',414)->first()->custom_text }}</label>
                                                                <input type="text" name="page_name" class="form-control" value="{{ $errorpage->page_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="">{{ $websiteLang->where('id',519)->first()->custom_text }}</label>
                                                                <input type="text" name="page_number" class="form-control" value="{{ $errorpage->page_number }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-12 d-none">
                                                            <div class="form-group">
                                                                <label for="">{{ $websiteLang->where('id',520)->first()->custom_text }}</label>
                                                                <input type="text" name="first_header" class="form-control" value="{{ $errorpage->first_header }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="">{{ $websiteLang->where('id',521)->first()->custom_text }}</label>
                                                                <input type="text" name="second_header" class="form-control" value="{{ $errorpage->second_header }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="">{{ $websiteLang->where('id',522)->first()->custom_text }}</label>
                                                                <input type="text" name="button_text" class="form-control" value="{{ $errorpage->button_text }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="">{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                                                                <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ $errorpage->description }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach

                      </div>

                </div>
            </div>
        </div>
    </div>



@endsection
