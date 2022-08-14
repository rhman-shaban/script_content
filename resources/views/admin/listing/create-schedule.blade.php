@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',387)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 d-inline"><a href="{{ route('admin.my.listing') }}" class="btn btn-success"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('id',368)->first()->custom_text }} </a></h1>
    <h1 class="h3 mb-2 text-gray-800 d-inline"><a href="{{ route('admin.listing.schedule',$listing->id) }}" class="btn btn-primary"> <i class="fa fa-backward" aria-hidden="true"></i> {{ $websiteLang->where('id',142)->first()->custom_text }} </a></h1>

    <div class="row">
        <div class="col-md-8">
            <!-- DataTales Example -->
    <div class="card shadow mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $listing->title }} {{ $websiteLang->where('id',138)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.listing.schedule.store',$listing->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="day"> {{ $websiteLang->where('id',132)->first()->custom_text }}</label>
                    <select name="day" id="day" class="form-control">
                        <option value="">{{ $websiteLang->where('id',139)->first()->custom_text }}</option>
                        @foreach ($days as $day)
                        <option value="{{ $day->id }}">{{ $day->custom_day }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">{{ $websiteLang->where('id',133)->first()->custom_text }}</label>
                    <input type="text" name="start_time" class="form-control timepicker">
                </div>
                <div class="form-group">
                    <label for="">{{ $websiteLang->where('id',134)->first()->custom_text }}</label>
                    <input type="text" name="end_time" class="form-control timepicker">
                </div>
                <div class="form-group">
                    <label for="status">{{ $websiteLang->where('id',135)->first()->custom_text }}</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">{{ $websiteLang->where('id',140)->first()->custom_text }}</option>
                        <option value="0">{{ $websiteLang->where('id',141)->first()->custom_text }}</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',117)->first()->custom_text }}</button>
            </form>


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
