@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',167)->first()->custom_text }}</title>
@endsection
@section('admin-content')
<a href="{{ route('admin.email.template') }}" class="btn btn-success mb-2"><i class="fas fa-backward" aria-hidden="true"></i> {{ $websiteLang->where('id',142)->first()->custom_text }}</a>
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">'{{ $email->name }}' {{ $websiteLang->where('id',167)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <th>{{ $websiteLang->where('id',209)->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('id',210)->first()->custom_text }}</th>
                        </thead>
                        <tbody>
                            <tr>
                                @php
                                    $name="{{user_name}}";
                                @endphp
                                <td>{{ $name }}</td>
                                <td>{{ $websiteLang->where('id',211)->first()->custom_text }}</td>
                            </tr>

                            <tr>
                                @php
                                    $payment_method="{{payment_method}}";
                                @endphp
                                <td>{{ $payment_method }}</td>
                                <td>{{ $websiteLang->where('id',154)->first()->custom_text }}</td>
                            </tr>
                            <tr>
                                @php
                                    $amount="{{amount}}";
                                @endphp
                                <td>{{ $amount }}</td>
                                <td>{{ $websiteLang->where('id',401)->first()->custom_text }}</td>
                            </tr>
                            <tr>
                                @php
                                    $order_details="{{order_details}}";
                                @endphp
                                <td>{{ $order_details }}</td>
                                <td>{{ $websiteLang->where('id',377)->first()->custom_text }}</td>
                            </tr>





                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">

                    <form action="{{ route('admin.email.update',$email->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',40)->first()->custom_text }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $email->subject }}" name="subject">
                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',103)->first()->custom_text }} <span class="text-danger">*</span></label>
                            <textarea name="description" cols="30" rows="10" class="form-control summernote">{{ $email->description }}</textarea>

                        </div>

                        <button class="btn btn-success" type="submit">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

