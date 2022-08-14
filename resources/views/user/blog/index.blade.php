@extends('layouts.user.layout')
@section('title')
    <title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $seo_text->meta_description }}">
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
                        <h4>{{ $menus->where('id',7)->first()->navbar }}</h4>
                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{ $menus->where('id',1)->first()->navbar }} </a></li>
                                <li class="breadcrumb-item active" aria-current="page"> {{ $menus->where('id',7)->first()->navbar }} </li>
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
         BLOG PART START
    ===========================-->
    <section id="blog_part">
        <div class="blog_part_overlay">
            <div class="container">
                <div class="row">
                    @foreach ($blogs as $index => $blog)
                            <div class="col-xl-4 col-sm-6 col-lg-4">
                                <div class="single_blog">
                                    <a href="{{ route('blog.details',$blog->slug) }}"><img src="{{ $blog->thumbnail_image ?  url($blog->thumbnail_image) : '' }}" alt="bloh images" class="img-fluid w-100"></a>
                                    <span><i class="fal fa-calendar-alt"></i> {{ $blog->created_at->format('M d Y') }}</span>
                                    <span><i class="fas fa-user"></i> {{ $blog->admin->name }}</span>
                                    <h4><a href="{{ route('blog.details',$blog->slug) }}">{{ $blog->title }}</a></h4>
                                    <p>{{ $blog->short_description }}</p>
                                    <a class="read_btn" href="{{ route('blog.details',$blog->slug) }}">{{ $websiteLang->where('id',484)->first()->custom_text }} <i class="far fa-chevron-double-right"></i></a>
                                </div>
                            </div>
                        @endforeach
                        {{ $blogs->links('user.paginator') }}
                </div>
            </div>
        </div>
    </section>
    <!--==========================
         BLOG PART END
    ===========================-->
@endsection
