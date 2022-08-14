@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',137)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')

<!-- Page Content Holder -->
<div class="row">
    <div class="col-xl-9 col-xxl-10 ms-auto">
        <div class="dashboard_content">
          <div class="row">
            <div class="col-xl-12">
              <div class="dashboard_breadcrumb">
                <span>'{{ $listing->title }}' {{ $websiteLang->where('id',138)->first()->custom_text }}</span>
                <ul>
                  <li><a class="read_btn" href="{{ route('user.listing.schedule.index',$listing->id) }}"><i class="fas fa-chevron-left"></i>{{ $websiteLang->where('id',142)->first()->custom_text }}</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="my_listing schedule">
            <div class="wsus_schedule_create">
                <form action="{{ route('user.listing.schedule.store',$listing->id) }}" method="POST">
                    @csrf
                <div class="row">
                  <div class="col-xl-6">
                    <div class="wsus_schedule_create_single">
                      <label>{{ $websiteLang->where('id',139)->first()->custom_text }}</label>
                      <select class="select_2" name="day">
                        <option value="">{{ $websiteLang->where('id',139)->first()->custom_text }}</option>
                        @foreach ($days as $day)
                        <option value="{{ $day->id }}">{{ $day->custom_day }}</option>
                        @endforeach
                    </select>
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="wsus_schedule_create_single">
                      <label>{{ $websiteLang->where('id',133)->first()->custom_text }}</label>
                      <input type="text" class="timepicker" name="start_time">
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="wsus_schedule_create_single">
                      <label>{{ $websiteLang->where('id',134)->first()->custom_text }}</label>
                      <input type="text" name="end_time" class="timepicker">
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="wsus_schedule_create_single">
                      <label>{{ $websiteLang->where('id',135)->first()->custom_text }}</label>
                      <select class="select_2" name="status">
                        <option value="1">{{ $websiteLang->where('id',140)->first()->custom_text }}</option>
                        <option value="0">{{ $websiteLang->where('id',141)->first()->custom_text }}</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <button class="read_btn" type="submit">{{ $websiteLang->where('id',117)->first()->custom_text }}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>

<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $('.timepicker').timepicker({
                timeFormat: 'h:mm p',
                interval: 60,
                minTime: '1',
                maxTime: '11:00pm',
                defaultTime: '10',
                startTime: '10:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });

    })(jQuery);
</script>
@endsection
