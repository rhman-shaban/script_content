@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',73)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 col-xxl-10 ms-auto">
        <div class="dashboard_content">
          <div class="row">
            <div class="col-xl-12">
              <div class="dashboard_breadcrumb">
                <span>{{ $websiteLang->where('id',73)->first()->custom_text }}</span>
                <ul>
                  <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }} <i class="fas fa-caret-right"></i></a></li>
                  <li><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }} <i class="fas fa-caret-right"></i></a></li>
                  <li><a class="bread_active" href="#">{{ $websiteLang->where('id',73)->first()->custom_text }}</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="my_listing p_xm_0">
            <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>

                    <th width="15%">{{ $websiteLang->where('id',86)->first()->custom_text }}</th>
                    <th width="15%">{{ $websiteLang->where('id',151)->first()->custom_text }}</th>
                    <th width="15%">{{ $websiteLang->where('id',152)->first()->custom_text }}</th>
                    <th width="10%">{{ $websiteLang->where('id',153)->first()->custom_text }}</th>
                    <th width="10%">{{ $websiteLang->where('id',154)->first()->custom_text }}</th>
                    <th width="15%">{{ $websiteLang->where('id',155)->first()->custom_text }}</th>
                    <th width="5%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>

                    </tr>
                  </thead>
                  <tbody>


                    @foreach ($orders as $index => $order)
                    <tr>
                        <td>
                            {{ $order->listingPackage->package_name }}

                            <br>
                            @if ($order->status==1)
                                @if ($order->payment_status==1)
                                    <span class="custom_badge">{{ $websiteLang->where('id',426)->first()->custom_text }}</span>
                                @endif
                            @endif


                        </td>
                        <td>{{ $order->purchase_date }}</td>
                        <td>{{ $order->expired_date == null ? $websiteLang->where('id',425)->first()->custom_text :$order->expired_date }}</td>
                        <td>{{ $order->currency_icon }}{{ $order->amount_real_currency }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{!! clean(nl2br(e($order->transaction_id))) !!}</td>
                        <td>
                            <a href="{{ route('user.order.details',$order->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-eye" aria-hidden="true"></i> </a>
                        </td>
                    </tr>
                    @endforeach



                  </tbody>
                </table>
            </div>

            <br>
            {{ $orders->links() }}
          </div>
        </div>
    </div>
  </div>
@endsection
