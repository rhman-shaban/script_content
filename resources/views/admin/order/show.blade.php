@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',377)->first()->custom_text }}</title>
@endsection
@section('admin-content')
<h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.order') }}" class="btn btn-success"><i class="fas fa-backward" aria-hidden="true"></i> {{ $websiteLang->where('id',142)->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',377)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">

                   <tr>
                       <td>{{ $websiteLang->where('id',37)->first()->custom_text }}</td>
                       <td>{{ $order->user->name }}</td>
                   </tr>
                   <tr>
                       <td>{{ $websiteLang->where('id',38)->first()->custom_text }}</td>
                       <td>{{ $order->user->email }}</td>
                   </tr>
                   <tr>
                       <td>{{ $websiteLang->where('id',86)->first()->custom_text }}</td>
                       <td>{{ $order->listingPackage->package_name }}</td>
                   </tr>
                   <tr>
                       <td>{{ $websiteLang->where('id',481)->first()->custom_text }}</td>
                       <td>${{ $order->amount_usd }}</td>
                   </tr>

                   <tr>
                       <td>{{ $websiteLang->where('id',480)->first()->custom_text }}</td>
                       <td>{{ $order->currency_icon }}{{ $order->amount_real_currency }}</td>
                   </tr>



                   <tr>
                       <td>{{ $websiteLang->where('id',154)->first()->custom_text }}</td>
                       <td>{{ $order->payment_method }}</td>
                   </tr>
                   <tr>
                       <td>{{ $websiteLang->where('id',155)->first()->custom_text }}</td>
                       <td>{!! clean(nl2br(e($order->transaction_id))) !!}</td>
                   </tr>
                   <tr>
                       <td>{{ $websiteLang->where('id',151)->first()->custom_text }}</td>
                       <td>{{ $order->purchase_date }}</td>
                   </tr>
                   <tr>
                       <td>{{ $websiteLang->where('id',152)->first()->custom_text }}</td>
                       <td>
                            @if ($order->expired_date==null)
                                <span class="badge badge-success">{{ $websiteLang->where('id',425)->first()->custom_text }}</span>
                            @elseif(date('Y-m-d') < $order->expired_date)
                            <span class="badge badge-success">{{ $websiteLang->where('id',140)->first()->custom_text }}</span>
                            @else
                                <span class="badge badge-success">{{ $websiteLang->where('id',82)->first()->custom_text }}</span>
                            @endif
                       </td>
                   </tr>
                   <tr>
                       <td>{{ $websiteLang->where('id',135)->first()->custom_text }}</td>
                       <td>
                           @if ($order->expired_date==null)
                                <span class="badge badge-success">{{ $websiteLang->where('id',140)->first()->custom_text }}</span>
                            @elseif(date('Y-m-d') < $order->expired_date)
                            <span class="badge badge-success">{{ $websiteLang->where('id',140)->first()->custom_text }}</span>
                            @else
                            <span class="badge badge-danger">{{ $websiteLang->where('id',141)->first()->custom_text }}</span>
                            @endif
                    </td>
                   </tr>
                </table>

                <a href="{{ route('admin.order-delete',$order->id) }}" class="btn btn-danger">{{ $websiteLang->where('id',509)->first()->custom_text }}</a>
            </div>
        </div>
    </div>
@endsection
