@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',137)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<!-- Page Content Holder -->
<div id="content">

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
                <form action="{{ route('user.listing.schedule.update',$schedule->id) }}" method="POST">
                    @csrf
                <div class="row">
                  <div class="col-xl-6">
                    <div class="wsus_schedule_create_single">
                      <label>{{ $websiteLang->where('id',139)->first()->custom_text }}</label>
                      <input type="text" value="{{ $schedule->day->custom_day }}" readonly>
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="wsus_schedule_create_single">
                      <label>{{ $websiteLang->where('id',133)->first()->custom_text }}</label>
                      <input type="text" class="timepicker1" name="start_time">
                      <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="wsus_schedule_create_single">
                      <label>{{ $websiteLang->where('id',134)->first()->custom_text }}</label>
                      <input type="text" name="end_time" class="timepicker2">
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="wsus_schedule_create_single">
                      <label>{{ $websiteLang->where('id',135)->first()->custom_text }}</label>
                      <select class="select_2" name="status">
                        <option {{ $schedule->status==1 ? 'selected' : '' }} value="1">{{ $websiteLang->where('id',140)->first()->custom_text }}</option>
                        <option {{ $schedule->status==0 ? 'selected' : '' }} value="0">{{ $websiteLang->where('id',141)->first()->custom_text }}</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <button class="read_btn" type="submit">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
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
            $('.timepicker1').timepicker({
                timeFormat: 'h:mm p',
                interval: 60,
                minTime: '1',
                maxTime: '11:00pm',
                defaultTime: '{{ $schedule->start_time }}',
                startTime: '10:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });

            $('.timepicker2').timepicker({
                timeFormat: 'h:mm p',
                interval: 60,
                minTime: '1',
                maxTime: '11:00pm',
                defaultTime: '{{ $schedule->end_time }}',
                startTime: '10:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });


        });

    })(jQuery);
</script>
@endsection
