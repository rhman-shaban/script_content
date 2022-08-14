@extends('layouts.user.layout')
@section('title')
    <title>{{ $websiteLang->where('id',220)->first()->custom_text }}</title>
@endsection

@section('user-content')

    <!--==========================
         BREADCRUMB PART START
    ===========================-->
    <div id="breadcrumb_part" style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
        <div class="bread_overlay">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center text-white">
                    <h4>{{ $websiteLang->where('id',220)->first()->custom_text }}</h4>
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{ $menus->where('id',1)->first()->navbar }} </a></li>
                            <li class="breadcrumb-item active" aria-current="page"> {{ $websiteLang->where('id',220)->first()->custom_text }} </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!--==========================
         BREADCRUMB PART END
    ===========================-->


        <!--==========================
        CUSTOM PAGE START
    ===========================-->
    <section id="wsus__custom_page">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__payment">
                            <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                @if ($paymentSetting->stripe_status==1)
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{ $websiteLang->where('id',221)->first()->custom_text }}</button>
                                @endif

                                @if ($paymentSetting->paypal_status==1)
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{ $websiteLang->where('id',222)->first()->custom_text }}</button>
                                @endif

                                @if ($razorpay->razorpay_status==1)
                                    <button class="nav-link" id="razorpay_payment_tab" data-bs-toggle="tab" data-bs-target="#razorpay_payment" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{ $websiteLang->where('id',502)->first()->custom_text }}</button>
                                @endif

                                @if ($flutterwave->status==1)
                                    <button class="nav-link" id="flutterwave_payment_tab" data-bs-toggle="tab" data-bs-target="#flutterwave_payment" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{ $websiteLang->where('id',523)->first()->custom_text }}</button>
                                @endif

                                @if ($paystack->paystack_status==1)
                                    <button class="nav-link" id="paystack_payment_tab" data-bs-toggle="tab" data-bs-target="#paystack_payment" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{ $websiteLang->where('id',535)->first()->custom_text }}</button>
                                @endif

                                @if ($mollie->mollie_status==1)
                                    <button class="nav-link" id="mollie_payment_tab" data-bs-toggle="tab" data-bs-target="#mollie_payment" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{ $websiteLang->where('id',536)->first()->custom_text }}</button>
                                @endif

                                @if ($instamojo->status==1)
                                    <button class="nav-link" id="instamojo_payment_tab" data-bs-toggle="tab" data-bs-target="#instamojo_payment" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{ $websiteLang->where('id',540)->first()->custom_text }}</button>
                                @endif

                                @if ($paymongo->status==1)
                                    <button class="nav-link" id="paymongo_payment_tab" data-bs-toggle="tab" data-bs-target="#paymongo_payment" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{ $websiteLang->where('id',545)->first()->custom_text }}</button>
                                @endif



                                @if ($paymentSetting->bank_status==1)
                                    <button class="nav-link" id="bank_payment_tab" data-bs-toggle="tab" data-bs-target="#bank_payment" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{ $websiteLang->where('id',503)->first()->custom_text }}</button>
                                @endif

                            </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                @if ($paymentSetting->stripe_status==1)
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <form role="form" action="{{ route('user.stripe.payment',$id) }}" method="post" class="require-validation"
                                        data-cc-on-file="false"
                                        data-stripe-publishable-key="{{ $stripe->stripe_key }}"
                                        id="payment-form">
                                        @csrf

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="wsus__payment_input">
                                                    <label>{{ $websiteLang->where('id',225)->first()->custom_text }}</label>
                                                    <input type="text" name="card_digit" class="card-number">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="wsus__payment_input">
                                                    <label>{{ $websiteLang->where('id',226)->first()->custom_text }}</label>
                                                    <input type="text" class="card-cvc">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="wsus__payment_input">
                                                    <label>{{ $websiteLang->where('id',227)->first()->custom_text }}</label>
                                                    <input type="text" class="card-expiry-month">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="wsus__payment_input">
                                                    <label>{{ $websiteLang->where('id',228)->first()->custom_text }}</label>
                                                    <input type="text" class="card-expiry-year">
                                                </div>
                                            </div>

                                            <div class='col-xl-12 error form-group d-none stripe-card-error'>
                                                <div class='alert-danger alert'>{{ $websiteLang->where('id',229)->first()->custom_text }}</div>
                                            </div>

                                            <div class="col-xl-12">
                                                <button type="submit" class="read_btn">{{ $websiteLang->where('id',223)->first()->custom_text }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @endif

                                @if ($paymentSetting->paypal_status==1)
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <form action="{{ route('user.paypal',$id) }}" method="POST">
                                        @csrf
                                        <div class="wsus__cash_delivery">
                                            <button type="submit" class="read_btn">{{ $websiteLang->where('id',224)->first()->custom_text }}</button>
                                        </div>
                                    </form>
                                </div>
                                @endif

                                @if ($razorpay->razorpay_status==1)
                                    <div class="tab-pane fade" id="razorpay_payment" role="tabpanel" aria-labelledby="razorpay_payment_tab">
                                        <form action="{{ route('user.razorpay-payment',$package->id) }}" method="POST" >
                                            @csrf

                                            @php
                                            $payableAmount = round($package_price * $razorpay->currency_rate,2);
                                            @endphp

                                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                    data-key="{{ $razorpay->razorpay_key }}"
                                                    data-amount= "{{ $payableAmount* 100 }}"
                                                    data-buttontext="{{ $websiteLang->where('id',514)->first()->custom_text }} {{ $payableAmount }} {{ $razorpay->currency_code }}"
                                                    data-name="{{ $razorpay->name }}"
                                                    data-description="{{ $razorpay->description }}"
                                                    data-image="{{ asset($razorpay->image) }}"
                                                    data-prefill.name=""
                                                    data-prefill.email=""
                                                    data-theme.color="{{ $razorpay->theme_color }}">
                                            </script>
                                        </form>
                                    </div>
                                @endif


                                @php
                                $usd_amount=$package_price / $setting->currency_rate;
                                $tnx_ref = substr(rand(0,time()),0,7);
                                @endphp
                                @if ($flutterwave->status == 1)
                                    <div class="tab-pane fade" id="flutterwave_payment" role="tabpanel" aria-labelledby="flutterwave_payment_tab">
                                        <div class="wsus__bank_details">

                                            <button type="submit" class="read_btn" onClick="makePayment()">{{ $websiteLang->where('id',526)->first()->custom_text }}</button>
                                        </div>
                                    </div>
                                @endif


                                <div class="tab-pane fade" id="paystack_payment" role="tabpanel" aria-labelledby="paystack_payment_tab">
                                    <div class="wsus__bank_details">
                                        <button type="submit" class="read_btn" onClick="payWithPaystack()">{{ $websiteLang->where('id',542)->first()->custom_text }}</button>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="mollie_payment" role="tabpanel" aria-labelledby="mollie_payment_tab">
                                    <div class="wsus__bank_details">
                                        <a href="{{ route('user.mollie-payment', $package->id) }}" class="read_btn" >{{ $websiteLang->where('id',543)->first()->custom_text }}</a>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="instamojo_payment" role="tabpanel" aria-labelledby="instamojo_payment_tab">
                                    <div class="wsus__bank_details">
                                        <a href="{{ route('user.pay-with-instamojo', $package->id) }}" class="read_btn" >{{ $websiteLang->where('id',544)->first()->custom_text }}</a>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="paymongo_payment" role="tabpanel" aria-labelledby="paymongo_payment_tab">
                                    <div class="wsus__bank_details">
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#paymentWithPaymongo" class="read_btn" >{{ $websiteLang->where('id',546)->first()->custom_text }}</a>

                                        <a href="{{ route('user.pay-with-grab-pay', $package->id) }}" class="read_btn" >{{ $websiteLang->where('id',547)->first()->custom_text }}</a>
                                        <a href="{{ route('user.pay-with-gcash', $package->id) }}" class="read_btn" >{{ $websiteLang->where('id',548)->first()->custom_text }}</a>
                                    </div>
                                </div>


                                @if ($paymentSetting->bank_status==1)
                                <div class="tab-pane fade" id="bank_payment" role="tabpanel" aria-labelledby="bank_payment_tab">
                                    <p>{!! clean(nl2br(e($stripe->bank_account))) !!}</p>
                                    <form action="{{ route('user.bank-payment') }}" method="POST">
                                        @csrf
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <div class="blog_single_input">
                                                    <textarea placeholder="{{ $websiteLang->where('id',513)->first()->custom_text }}" name="tran_id"  id="" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="package_id" value="{{ $package->id }}">

                                        <button type="submit" class="read_btn">{{ $websiteLang->where('id',515)->first()->custom_text }}</button>
                                    </form>
                                </div>
                                @endif

                            </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==========================
        CUSTOM PAGE END
    ===========================-->




  <!-- Modal -->
  <div class="modal fade" id="paymentWithPaymongo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $websiteLang->where('id',549)->first()->custom_text }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body wsus__payment">
            <form  action="{{ route('user.pay-with-paymongo',$package->id) }}" method="post" >
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__payment_input">
                            <label>{{ $websiteLang->where('id',225)->first()->custom_text }}</label>
                            <input type="text" name="card_number" required>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="wsus__payment_input">
                            <label>{{ $websiteLang->where('id',226)->first()->custom_text }}</label>
                            <input type="text" name="cvc" required>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="wsus__payment_input">
                            <label>{{ $websiteLang->where('id',227)->first()->custom_text }}</label>
                            <input type="text" name="month" required>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="wsus__payment_input">
                            <label>{{ $websiteLang->where('id',228)->first()->custom_text }}</label>
                            <input type="text" name="year" required>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <button type="submit" class="read_btn">{{ $websiteLang->where('id',515)->first()->custom_text }}</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>


<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

@php
    // start paystack
    $public_key = $paystack->paystack_public_key;
    $currency = $paystack->paystack_currency_code;
    $currency = strtoupper($currency);

    $ngn_amount = $package_price * $paystack->paystack_currency_rate;
    $ngn_amount = $ngn_amount * 100;
    $ngn_amount = round($ngn_amount);
    // end paystack

    //start fluterwave
    $payable_amount = $package_price * $flutterwave->currency_rate;
    $payable_amount = round($payable_amount, 2);
    // end flutterwave

@endphp

<script>
    function makePayment() {
        FlutterwaveCheckout({
        public_key: "{{ $flutterwave->public_key }}",
        tx_ref: "RX1_{{ $tnx_ref }}",
        amount: {{ $payable_amount }},
        currency: "{{ $flutterwave->currency_code }}",
        country: "{{ $flutterwave->country_code }}",
        payment_options: " ",
        customer: {
            email: "{{ $user->email }}",
            phone_number: "{{ $user->phone }}",
            name: "{{ $user->name }}",
        },
        callback: function (data) {
            var tnx_id = data.transaction_id;
            var _token = "{{ csrf_token() }}";
            var package_id = '{{ $package->id }}';
            $.ajax({
                type: 'post',
                data : {tnx_id,_token,package_id},
                url: "{{ url('user/flutterwave-payment/') }}",
                success: function (response) {
                    if(response.status == 'success'){
                        toastr.success(response.message);
                        window.location.href = "{{ route('user.my-order') }}";
                    }else{
                        toastr.error(response.message);
                        window.location.reload();

                    }
                },
                error: function(err) {}
            });

        },
        customizations: {
            title: "{{ $flutterwave->title }}",
            logo: "{{ asset($flutterwave->logo) }}",
        },
        });
    }


    function payWithPaystack(){
        var package_id = '{{ $package->id }}';
        var handler = PaystackPop.setup({
            key: '{{ $public_key }}',
            email: '{{ $user->email }}',
            amount: '{{ $ngn_amount }}',
            currency: "{{ $currency }}",
            callback: function(response){
            let reference = response.reference;
            let tnx_id = response.transaction;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                type: "post",
                data: {reference, tnx_id, _token, package_id},
                url: "{{ route('user.paystack-payment') }}",
                success: function(response) {
                    if(response.status == 'success'){
                        window.location.href = "{{ route('user.my-order') }}";
                    }else{
                        window.location.reload();
                    }
                }
            });
            },
            onClose: function(){
                alert('window closed');
            }
        });
        handler.openIframe();
    }
</script>

@endsection
