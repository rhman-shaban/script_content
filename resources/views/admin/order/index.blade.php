@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',73)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',378)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',37)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',38)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',86)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',151)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',152)->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('id',344)->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('id',135)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ $order->listingPackage->package_name }}</td>
                            <td>{{ $order->purchase_date }}</td>
                            <td>{{ $order->expired_date }}</td>
                            <td>{{ $order->currency_icon }}{{ $order->amount_real_currency }}</td>
                            <td>
                                @if ($order->status==1)
                                    <span class="badge badge-success">{{ $websiteLang->where('id',140)->first()->custom_text }}</span>
                                @else
                                <span class="badge badge-danger">{{ $websiteLang->where('id',141)->first()->custom_text }}</span>
                                @endif
                            </td>
                            <td>
                                <a onclick="return confirm('{{ $confirmNotify }}')" href="{{ route('admin.order-delete',$order->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash" aria-hidden="true"></i></a>
                                <a href="{{ route('admin.order-show',$order->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>
@endsection
