@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',158)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',158)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.update.comment.setting') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',183)->first()->custom_text }}</label>
                            <select name="comment_type" class="form-control" id="comment_type">
                                <option {{ $setting->comment_type==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('id',184)->first()->custom_text }}</option>
                                <option {{ $setting->comment_type==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('id',185)->first()->custom_text }}</option>
                            </select>
                        </div>
                        @if ($setting->comment_type==0)
                            <div class="form-group" id="hiddenFacebookId">
                                <label for="facebook_comment_script">{{ $websiteLang->where('id',186)->first()->custom_text }}</label>
                                <input type="text" class="form-control" name="facebook_comment_script" id="facebook_comment_script" value="{{ $setting->facebook_comment_script }}">
                            </div>
                        @endif
                        <div class="form-group d-none" id="hiddenFacebookId">
                            <label for="facebook_comment_script">{{ $websiteLang->where('id',186)->first()->custom_text }}</label>
                            <input type="text" class="form-control" name="facebook_comment_script" id="facebook_comment_script" value="{{ $setting->facebook_comment_script }}">
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
        $("#comment_type").on("change",function(e){
            var id=$(this).val()
            if(id==0){
                $("#hiddenFacebookId").removeClass('d-none');
            }else{
                $("#hiddenFacebookId").addClass('d-none');
            }
        })

    });

    })(jQuery);
</script>

@endsection
