@extends('layouts.staff.layout')
@section('title')
<title>{{ $websiteLang->where('id',385)->first()->custom_text }}</title>
@endsection
@section('staff-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('staff.listing.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('id',368)->first()->custom_text }} </a></h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $listing->title }} {{ $websiteLang->where('id',385)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">
                    @if ($listing->listingVideos->count()>0)
                        <table class="table table-bordered">
                            @foreach ($listing->listingVideos as $video)
                            <tr>
                                @php
                                $video_id=explode("=",$video->video_link);
                            @endphp

                                <td width="90%"><iframe width="350" height="180"
                                            src="https://www.youtube.com/embed/{{ $video_id[1] }}">
                                            </iframe>
                                    </td>

                                <td>
                                    <a onclick="return confirm ('{{ $confirmNotify }}')" href="{{ route('staff.delete.listing.video',$video->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        <h4 class="text-danger">{{ $websiteLang->where('id',386)->first()->custom_text }}</h4>
                    @endif


                    <form action="{{ route('staff.listing.new.video') }}" method="post">
                        @csrf

                        <div class="row" id="video-row">
                            <div class="col-md-12">
                                <label for="">{{ $websiteLang->where('id',122)->first()->custom_text }}</label>
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="video[]">
                                    </div>
                                    <div class="col-md-2">
                                        <button id="addListingVideoRow" type="button" class="btn btn-success btn-sm"><i class="fas fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        <button class="btn btn-success mt-3" type="submit">{{ $websiteLang->where('id',117)->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {

            // start video row
            $("#addListingVideoRow").on("click",function(){
                var html="";
                html +='<div class="col-md-12 mt-2 removeVideoRow">';
                html +='<label for="">{{ $websiteLang->where("id",122)->first()->custom_text }}</label>';
                html +='<div class="row">';
                html +='<div class="col-md-10">';
                html +='<input type="text" class="form-control" name="video[]">';
                html +='</div>';
                html +='<div class="col-md-2">';
                html +='<button type="button" class="btn btn-danger btn-sm removeListingVideoRow"><i class="fas fa-trash" aria-hidden="true"></i></button>';
                html +='</div>';
                html +='</div>';
                html +='</div>';
                $("#video-row").append(html)
            })
            $(document).on('click', '.removeListingVideoRow', function () {
                $(this).closest('.removeVideoRow').remove();
            });

            // end video row

        });

        })(jQuery);


    </script>

@endsection
