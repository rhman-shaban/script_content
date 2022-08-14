@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',73)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 col-xxl-10 ms-auto">
        <div class="dashboard_content">
          <div class="my_listing invoice">
            <div class="wsus__invoice_header">
              <div class="row">
                <div class="col-xl-12">
                  <div class="wsus__invoice_top">
                    <a class="invoice_logo" href="#">
                      <img src="{{ asset($logo->logo) }}" alt="logo" class="img-fluid w-100">
                    </a>
                    <div class="wsus__invoice_number">
                      <h5>{{ $websiteLang->where('id',485)->first()->custom_text }}#{{ $order->order_id }}</h5>
                      <p>{{ $websiteLang->where('id',488)->first()->custom_text }}: {{ $order->created_at->format('d F Y') }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-6">
                  <div class="wsus__invoice_header_left">
                    <h5>{{ $websiteLang->where('id',486)->first()->custom_text }}</h5>
                    <h6>{{ $order->user->name }}</h6>
                    <a class="call_mail" href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a>

                    @if ($order->user->phone)
                    <a class="call_mail" href="callto:{{ $order->user->phone }}">{{ $order->user->phone }}</a>
                    @endif


                  </div>
                </div>
                <div class="col-xl-6 col-6">
                  <div class="wsus__invoice_header_left invoice_right">
                    <h5>{{ $websiteLang->where('id',487)->first()->custom_text }}</h5>
                    <h6>{{ $websiteLang->where('id',487)->first()->custom_text }}</h6>
                    <a class="call_mail" href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a>
                    @if ($order->user->phone)
                    <a class="call_mail" href="callto:{{ $order->user->phone }}">{{ $order->user->phone }}</a>
                    @endif


                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                        <th width="10%">{{ $websiteLang->where('id',86)->first()->custom_text }}</th>
                        <th width="15%">{{ $websiteLang->where('id',151)->first()->custom_text }}</th>
                        <th width="15%">{{ $websiteLang->where('id',152)->first()->custom_text }}</th>
                        <th width="10%">{{ $websiteLang->where('id',153)->first()->custom_text }}</th>
                        <th width="20%">{{ $websiteLang->where('id',154)->first()->custom_text }}</th>
                        <th width="15%">{{ $websiteLang->where('id',155)->first()->custom_text }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>
                            {{ $order->listingPackage->package_name }}
                        </td>
                        <td>{{ $order->purchase_date }}</td>
                        <td>{{ $order->expired_date == null ? $websiteLang->where('id',425)->first()->custom_text :$order->expired_date }}</td>
                        <td>{{ $order->currency_icon }}{{ $order->amount_real_currency }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{!! clean(nl2br(e($order->transaction_id))) !!}</td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <button type="submit" class="read_btn" onclick="window.print()">{{ $websiteLang->where('id',430)->first()->custom_text }}</button>
          </div>
        </div>
    </div>
  </div>

@endsection
