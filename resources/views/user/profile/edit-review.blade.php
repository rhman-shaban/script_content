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
                        <span>{{ $review->comment }}</span>
                      </div>
                      <form action="{{ route('user.update-review',$review->id) }}" method="POST">
                        @csrf
                        <div class="input_area">
                          <div class="wsus__search_area">
                            <i class="fas fa-star"></i>
                            <select class="select_2" name="rating">
                                <option {{ $review->rating==1 ? 'selected' : '' }} value="1">1</option>
                                <option {{ $review->rating==2 ? 'selected' : '' }} value="2">2</option>
                                <option {{ $review->rating==3 ? 'selected' : '' }} value="3">3</option>
                                <option {{ $review->rating==4 ? 'selected' : '' }} value="4">4</option>
                                <option {{ $review->rating==5 ? 'selected' : '' }} value="5">5</option>
                            </select>
                          </div>
                          <div class="wsus__rev_textarea">
                            <i class="far fa-edit"></i>
                            <textarea cols="3" rows="3" name="comment">{{ $review->comment }}</textarea>
                          </div>
                          <button type="submit" class="read_btn">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
    </div>
  </div>


@endsection
