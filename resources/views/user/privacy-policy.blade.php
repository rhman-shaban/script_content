@extends('layouts.user.layout')
@section('title')
    <title>{{ $menus->where('id',16)->first()->navbar }}</title>
@endsection
@section('user-content')
     <!--==========================
         BREADCRUMB PART START
    ===========================-->
    <div id="breadcrumb_part" style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
        <div class="bread_overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center text-white">
                        <h4>{{ $menus->where('id',16)->first()->navbar }}</h4>
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{ $menus->where('id',1)->first()->navbar }} </a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $menus->where('id',16)->first()->navbar }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==========================
         BREADCRUMB PART END
    ===========================-->



    <!--==========================
        CUSTOM PAGE START
    ===========================-->
    <section id="wsus__custom_page">
        <div class="container">
            <div class="row">
                @if ($privacy)
                    {!! clean($privacy->privacy_policy) !!}
                @endif
            </div>
        </div>
    </section>
    <!--==========================
        CUSTOM PAGE END
    ===========================-->
@endsection
