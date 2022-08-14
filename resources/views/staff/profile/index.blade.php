@extends('layouts.staff.layout')
@section('title')
<title>{{ $websiteLang->where('id',72)->first()->custom_text }}</title>
@endsection
@section('staff-content')
       <!-- DataTales Example -->
       <div class="row">
           <div class="col-md-6">
               <div class="card shadow mb-4">
                   <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',72)->first()->custom_text }}</h6>
                   </div>
                   <div class="card-body">
                       @if (Session::has('update-profile'))
                           <p class="alert alert-success">{{ Session::get('update-profile') }}</p>
                       @endif
                    <form action="{{ route('staff.update.profile') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',126)->first()->custom_text }}</label>
                            <br>
                            @if ($admin->image)
                            <img class="img-thumbnail ml-3  custom_img_width" src="{{ $admin->image ? url($admin->image) : '' }}" alt="default user image">
                            <input type="hidden" name="old_image" value="{{ $admin->image }}">
                            @else
                            <img class="img-thumbnail ml-3 custom_img_width" src="{{ $default_profile->image ? url($default_profile->image) : '' }}" alt="default user image" >
                            <input type="hidden" name="old_image" value="default-user.jpg">
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',121)->first()->custom_text }}</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',37)->first()->custom_text }}</label>
                            <input type="text" class="form-control" value="{{ ucfirst($admin->name) }}" name="name">

                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',38)->first()->custom_text }}</label>
                            <input type="text" class="form-control" value="{{ $admin->email }}" name="email">

                        </div>

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',150)->first()->custom_text }}</label>
                            <input  type="password" class="form-control" name="password">

                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',67)->first()->custom_text }}</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <button class="btn btn-success" type="submit">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                    </form>
                   </div>
               </div>
           </div>
       </div>
@endsection
