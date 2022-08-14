@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',164)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',164)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.google.analytic.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',206)->first()->custom_text }}</label>
                            <select name="google_analytic" id="google_analytic" class="form-control">
                                <option {{ $setting->google_analytic==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                <option {{ $setting->google_analytic==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                            </select>
                        </div>

                        @if ($setting->google_analytic==1)
                            <div class="form-group" id="hidden_link">
                                <label for="google_analytic_code">{{ $websiteLang->where('id',207)->first()->custom_text }}</label>
                                <input type="text" class="form-control" name="google_analytic_code" id="google_analytic_code" value="{{ $setting->google_analytic_code }}">
                            </div>
                        @endif

                        <div class="form-group d-none" id="hidden_link">
                            <label for="google_analytic_code">{{ $websiteLang->where('id',207)->first()->custom_text }}</label>
                            <input type="text" class="form-control" name="google_analytic_code" id="google_analytic_code" value="{{ $setting->google_analytic_code }}">
                        </div>

                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $("#google_analytic").on("change",function(e){
                var id=$(this).val()
                if(id==1){
                    $("#hidden_link").removeClass('d-none');
                }else{
                    $("#hidden_link").addClass('d-none');
                }
            })

        });

        })(jQuery);
    </script>

@endsection
