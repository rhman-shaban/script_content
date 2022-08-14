@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',161)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',161)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.update.captcha.setting') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',198)->first()->custom_text }}</label>
                            <select name="allow_captcha" id="catpcha_type" class="form-control">
                                <option {{ $setting->allow_captcha==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                <option {{ $setting->allow_captcha==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                            </select>
                        </div>

                        @if ($setting->allow_captcha==1)
                            <div id="hidden_captcha_info">
                                <div class="form-group">
                                    <label for="captcha_key">{{ $websiteLang->where('id',199)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="captcha_key" id="captcha_key" value="{{ $setting->captcha_key }}">
                                </div>
                                <div class="form-group">
                                    <label for="captcha_secret">{{ $websiteLang->where('id',200)->first()->custom_text }}</label>
                                    <input type="text" class="form-control" name="captcha_secret" id="captcha_secret" value="{{ $setting->captcha_secret }}">
                                </div>
                            </div>
                        @endif
                        <div id="hidden_captcha_info" class="d-none">
                            <div class="form-group">
                                <label for="captcha_key">{{ $websiteLang->where('id',199)->first()->custom_text }}</label>
                                <input type="text" class="form-control" name="captcha_key" id="captcha_key" value="{{ $setting->captcha_key }}">
                            </div>
                            <div class="form-group">
                                <label for="captcha_secret">{{ $websiteLang->where('id',200)->first()->custom_text }}</label>
                                <input type="text" class="form-control" name="captcha_secret" id="captcha_secret" value="{{ $setting->captcha_secret }}">
                            </div>
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
            $("#catpcha_type").on("change",function(e){
                var id=$(this).val()
                if(id==1){
                    $("#hidden_captcha_info").removeClass('d-none');
                }else{
                    $("#hidden_captcha_info").addClass('d-none');
                }
            })

        });

        })(jQuery);
    </script>
@endsection
