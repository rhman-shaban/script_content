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
                        <h4>{{ $menus->where('id',6)->first()->navbar }}</h4>
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{ $menus->where('id',1)->first()->navbar }} </a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $menus->where('id',6)->first()->navbar }}</li>
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
        OUR CATEGORY START
    ===========================-->
    <section id="wsus__categoryes">
        <div class="wsus__categorye_overlay">
            <div class="container">
                <div class="row">
                    @php
                        $colorId=1;
                    @endphp
                    @foreach ($listingCategories as $index => $category)

                        @php
                            if($index %4 ==0){
                                $colorId=1;
                            }
                            $color="";
                            if($colorId==1){
                                $color="green";
                            }else if($colorId==2){
                                $color="red";
                            }else if($colorId==3){
                                $color="purple";
                            }else if($colorId==4){
                                $color="green2";
                            }

                            $activeListingsByCategory=$category->listings->where('status',1);
                            $qty=0;
                            foreach ($activeListingsByCategory as $key => $listing) {
                                if($listing->expired_date==null){
                                    $qty+=1;
                                }elseif($listing->expired_date > date('Y-m-d')){
                                    $qty+=1;
                                }
                            }

                        @endphp
                        <div class="col-xl-4 col-sm-6">
                            <a href="{{ route('listings',['category_slug'=>$category->slug, 'page_type' => 'list_view']) }}" class="wsus__category_single">
                                <div class="wsus__category_img">
                                    <img src="{{ url($category->image) }}" alt="img" class="img-fluid w-100">
                                </div>
                                <div class="wsus__category_text">
                                    <div class="wsus__category_text_center">
                                        <i class="{{ $category->icon }}"></i>
                                        <p>{{ $category->name }}</p>
                                        <span class="{{ $color }}">{{ $qty }} {{ $websiteLang->where('id',56)->first()->custom_text }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        @php
                            $colorId++;
                        @endphp
                    @endforeach

                    {{ $listingCategories->links('user.paginator') }}
                </div>

            </div>
        </div>
    </section>
    <!--==========================
        OUR CATEGORY END
    ===========================-->
@endsection
