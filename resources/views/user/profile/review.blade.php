@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',9)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 col-xxl-10 ms-auto">
        <div class="dashboard_content">
          <div class="row">
            <div class="col-xl-12">
              <div class="dashboard_breadcrumb">
                <span>{{ $websiteLang->where('id',9)->first()->custom_text }}</span>
                <ul>
                  <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }} <i class="fas fa-caret-right"></i></a></li>
                  <li><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }} <i class="fas fa-caret-right"></i></a></li>
                  <li><a class="bread_active" href="#">{{ $websiteLang->where('id',9)->first()->custom_text }}</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="my_listing p_xm_0">
            <div class="row">
              <div class="col-xxl-6 col-xl-12">
                <div class="visitor_rev_area">
                  <h4>{{ $websiteLang->where('id',144)->first()->custom_text }}</h4>
                </div>
              </div>
              <div class="col-xxl-6 col-xl-12">
                <div class="visitor_rev_area">
                  @foreach ($myReviews as $review)
                    <div class="visitor_rev_single">
                        <div class="visitor_rev_img">
                        <img src="{{ $review->listing->logo ? asset($review->listing->logo) : '' }}" alt="product" class="img-fluid w-100">
                        </div>
                        <div class="visitor_rev_text">
                        <a class="title" href="{{ route('listing.show',$review->listing->slug) }}">{{ $review->listing->title }}<span>{{ $review->created_at->format('M d, Y') }}</span></a>
                        <p>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i<=$review->rating)
                                <i class="fa fa-star"></i>
                                @else
                                <i class="fa fa-star-o"></i>
                                @endif
                            @endfor
                        </p>
                        <span >{{ $review->comment }}</span>
                        <ul>
                            <li><a href="{{ route('user.edit-review',$review->id) }}"><i class="fal fa-edit"></i> {{ $websiteLang->where('id',84)->first()->custom_text }}</a></li>
                            <li><a href="{{ route('user.delete-review',$review->id) }}" onclick="return confirm('{{ $notify }}')"><i class="fal fa-trash-alt"></i> {{ $websiteLang->where('id',85)->first()->custom_text }}</a></li>
                        </ul>
                        </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

          @if ($visitorReviews->count() !=0)
          <div class="my_listing p_xm_0 mt-4">
            <div class="row">
              <div class="col-xxl-6 col-xl-12">
                <div class="visitor_rev_area">
                  <h4>{{ $websiteLang->where('id',143)->first()->custom_text }}</h4>
                </div>
              </div>
              <div class="col-xxl-6 col-xl-12">
                <div class="visitor_rev_area">
                  @foreach ($visitorReviews as $v_review)
                    <div class="visitor_rev_single">
                        <div class="visitor_rev_img">
                        <img src="{{ $v_review->listing->logo ? asset($v_review->listing->logo) : '' }}" alt="product" class="img-fluid w-100">
                        </div>
                        <div class="visitor_rev_text">
                        <a class="title" href="{{ route('listing.show',$v_review->listing->slug) }}">{{ $v_review->listing->title }}<span>{{ $v_review->created_at->format('M d, Y') }}</span></a>
                        <p>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i<=$v_review->rating)
                                <i class="fa fa-star"></i>
                                @else
                                <i class="fa fa-star-o"></i>
                                @endif
                            @endfor
                        </p>
                        <span >{{ $v_review->comment }}</span>

                        </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          @endif


        </div>
    </div>
  </div>


@endsection
