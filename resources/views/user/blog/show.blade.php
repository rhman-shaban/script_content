@extends('layouts.user.layout')
@section('title')
    <title>{{ $blog->seo_title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $blog->seo_description }}">
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
                        <h4>{{ $blog->title }}</h4>
                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{ $menus->where('id',1)->first()->navbar }} </a></li>
                                <li class="breadcrumb-item"><a href="{{ route('blog') }}"> {{ $menus->where('id',7)->first()->navbar }} </a></li>
                                <li class="breadcrumb-item active" aria-current="page"> {{ $blog->title }}</li>
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
        BLOG DETAILS START
    ===========================-->
    <section id="blog_details">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5">
                    <div class="blog_sidebar">
                        <div class="blog_search">
                            <h4>{{ $websiteLang->where('id',50)->first()->custom_text }}</h4>
                            <form  method="get" action="{{ route('blog.search') }}">
                                <input required type="text" placeholder="{{ $websiteLang->where('id',1)->first()->custom_text }}" name="search">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <div class="blog_category">
                            <h4>{{ $websiteLang->where('id',51)->first()->custom_text }}</h4>
                            <ul>
                                @foreach ($blogCategories as $blogCategory)
                                <li><a href="{{ route('blog.category',$blogCategory->slug) }}">{{ $blogCategory->name }} <span>{{ $blogCategory->blogs->count() }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar_blog">
                            <h4>{{ $websiteLang->where('id',52)->first()->custom_text }}</h4>
                            @foreach ($popularBlogs as $popularBlog)
                            <a href="{{ route('blog.details',$popularBlog->slug) }}" class="sidebar_blog_single">
                                <div class="sidebar_blog_img">
                                    <img src="{{ asset($popularBlog->thumbnail_image) }}" alt="blog" class="imgofluid w-100">
                                </div>
                                <div class="sidebar_blog_text">
                                    <h5>{{ $popularBlog->title }}</h5>
                                    <p> <span>{{ $popularBlog->created_at->format('M d Y') }} </span> {{ $popularBlog->comments->where('status',1)->count() }} {{ $websiteLang->where('id',46)->first()->custom_text }} </p>
                                </div>
                            </a>
                            @endforeach

                        </div>
                        <div class="sidebar_contact_share">
                            <h4>{{ $websiteLang->where('id',53)->first()->custom_text }}</h4>
                            <ul>
                                @if ($contact_us->facebook)
                                <li>
                                    <a href="{{ $contact_us->facebook }}" class="fab fa-facebook"></a>
                                </li>
                                @endif
                               @if ($contact_us->twitter)
                                <li>
                                    <a href="{{ $contact_us->twitter }}" class="fab fa-twitter"></a>
                                </li>
                               @endif
                               @if ($contact_us->linkedin)
                               <li>
                                <a href="{{ $contact_us->linkedin }}" class="fab fa-linkedin"></a>
                            </li>
                               @endif
                               @if ($contact_us->youtube)
                                <li>
                                    <a href="{{ $contact_us->youtube }}" class="fab fa-youtube"></a>
                                </li>
                               @endif
                               @if ($contact_us->instagram)
                                <li>
                                    <a href="{{ $contact_us->instagram }}" class="fab fa-instagram"></a>
                                </li>
                               @endif

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7">
                    <div class="main_blog">
                        <div class="main_blog_img">
                            <img src="{{ asset($blog->feature_image) }}" alt="blog" class="img-fluid w-100">
                        </div>
                        <ul class="main_blog_header">
                            <li><a href="javascript:void(0);"><i class="fal fa-calendar-alt"></i> {{ $blog->created_at->format('M d Y') }}</a></li>


                            @if ($commentSetting->comment_type==1)
                            <li><a href="javascript:void(0);"><i class="fal fa-comment-dots"></i>{{ $comments->where('status',1)->count() }} {{ $websiteLang->where('id',46)->first()->custom_text }}</a></li>
                            @endif

                            <li><a href="javascript:void(0);"><i class="fal fa-eye"></i> {{ $blog->view }} {{ $websiteLang->where('id',49)->first()->custom_text }}</a></li>
                            <li><a href="{{ route('blog.category',$blog->category->slug) }}"><i class="fal fa-tags"></i> {{ $blog->category->name }} </a></li>
                        </ul>

                        <h4>{{ $blog->title }}</h4>
                        {!! clean($blog->description) !!}

                        @if ($commentSetting->comment_type==1)
                            <div class="blog_comment_area">
                                @if ($comments->where('status',1)->count() >0)
                                    <h5 class="wsus__single_comment_heading">{{ $websiteLang->where('id',46)->first()->custom_text }} <span>{{ $comments->where('status',1)->count() }} </span></h5>
                                @endif


                                @foreach ($comments->where('status',1) as $comment)
                                <div class="wsus__single_comment">
                                    <div class="wsus__single_comment_img">
                                        <img src="{{ $default_image->image ? asset($default_image->image) : '' }}" alt="comment" class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__single_comment_text">
                                        <h5>{{ $comment->name }}</h5>
                                        <span>{{ $comment->created_at->format('M d Y') }}</span>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                                @endforeach

                                <h5>{{ $websiteLang->where('id',48)->first()->custom_text }}</h5>
                                <form id="blogCommentForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="blog_single_input">
                                                <input type="text" value="{{ old('name') }}" name="name" placeholder="{{ $websiteLang->where('id',37)->first()->custom_text }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="blog_single_input">
                                                <input type="email" value="{{ old('email') }}" name="email" placeholder="{{ $websiteLang->where('id',38)->first()->custom_text }}"  id="email">
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="blog_single_input">
                                                <input type="text" value="{{ old('phone') }}"  name="phone"   placeholder="{{ $websiteLang->where('id',39)->first()->custom_text }}" id="phone">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="blog_single_input">
                                                <textarea cols="3" rows="5" name="comment" placeholder="{{ $websiteLang->where('id',46)->first()->custom_text }}" id="comment"></textarea>
                                                <button id="blogCommentBtn" type="submit" class="read_btn"><i id="blog-comment-spinner" class="loading-icon fas fa-sync fa-spin d-none"></i> {{ $websiteLang->where('id',47)->first()->custom_text }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                        <div class="blog_comment_area">
                            <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="10"></div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==========================
        BLOG DETAILS END
    ===========================-->

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId={{ $commentSetting->facebook_comment_script }}&autoLogAppEvents=1" nonce="MoLwqHe5"></script>


<script>
    (function($) {
    "use strict";
    $(document).ready(function () {
        $("#blogCommentBtn").on('click',function(e) {

            // project demo mode check
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            // end

            e.preventDefault();
            $("#blog-comment-spinner").removeClass('d-none')
            $("#blogCommentBtn").addClass('custom-opacity')
            $("#blogCommentBtn").removeClass('site-btn-effect')
            $("#blogCommentBtn").attr('disabled',true);
            $.ajax({
                url: "{{ route('blog.comment',$blog->id) }}",
                type:"post",
                data:$('#blogCommentForm').serialize(),
                success:function(response){
                    if(response.success){
                        $("#blogCommentForm").trigger("reset");
                        $("#blog-comment-spinner").addClass('d-none')
                        $("#blogCommentBtn").removeClass('custom-opacity')
                        $("#blogCommentBtn").attr('disabled',false);
                        $("#blogCommentBtn").addClass('site-btn-effect')

                        toastr.success(response.success)
                        console.log(response);

                    }
                    if(response.error){
                        toastr.error(response.error)
                    }
                },
                error:function(response){
                    if(response.responseJSON.errors.name){
                        $("#blog-comment-spinner").addClass('d-none')
                        $("#blogCommentBtn").removeClass('custom-opacity')
                        $("#blogCommentBtn").attr('disabled',false);
                        $("#blogCommentBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.name[0])
                    }

                    if(response.responseJSON.errors.email){
                        $("#blog-comment-spinner").addClass('d-none')
                        $("#blogCommentBtn").removeClass('custom-opacity')
                        $("#blogCommentBtn").attr('disabled',false);
                        $("#blogCommentBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.email[0])
                    }

                    if(response.responseJSON.errors.comment){
                        $("#blog-comment-spinner").addClass('d-none')
                        $("#blogCommentBtn").removeClass('custom-opacity')
                        $("#blogCommentBtn").attr('disabled',false);
                        $("#blogCommentBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.comment[0])
                    }


                    if(response.responseJSON.errors.email || response.responseJSON.errors.name || response.responseJSON.errors.comment){}else{
                        toastr.error('Please Complete the recaptcha to submit the form')
                        $("#blog-comment-spinner").addClass('d-none')
                        $("#blogCommentBtn").removeClass('custom-opacity')
                        $("#blogCommentBtn").attr('disabled',false);
                        $("#blogCommentBtn").addClass('site-btn-effect')
                    }



                }

            });


        })

    });

    })(jQuery);
</script>

@endsection
