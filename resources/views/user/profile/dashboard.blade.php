@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',68)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
          <div class="row">
        <div class="col-xl-9 col-xxl-10 ms-auto">
            <div class="dashboard_content">
              <div class="manage_dasboard">
                <div class="row">
                  <div class="col-xl-6 col-12 col-sm-6 col-lg-3 col-xxl-3">
                      <div class="manage_dashboard_single">
                        <i class="fas fa-list-ul"></i>
                        <h3>{{ $listings->count() }}</h3>
                        <p>{{ $websiteLang->where('id',75)->first()->custom_text }}</p>
                      </div>
                  </div>
                  <div class="col-xl-6 col-12 col-sm-6 col-lg-3 col-xxl-3">
                      <div class="manage_dashboard_single orange">
                        <i class=" far fa-star"></i>
                        <h3>{{ $reviews }}</h3>
                        <p>{{ $websiteLang->where('id',77)->first()->custom_text }}</p>
                      </div>
                  </div>
                  <div class="col-xl-6 col-12 col-sm-6 col-lg-3 col-xxl-3">
                      <div class="manage_dashboard_single green">
                        <i class="far fa-heart"></i>
                        <h3>{{ $wishlists->count() }}</h3>
                        <p>{{ $websiteLang->where('id',78)->first()->custom_text }}</p>
                      </div>
                  </div>
                  <div class="col-xl-6 col-12 col-sm-6 col-lg-3 col-xxl-3">
                      <div class="manage_dashboard_single red">
                        <i class="fas fa-eye"></i>
                        <h3>{{ $listings->sum('views') }}</h3>
                        <p>{{ $websiteLang->where('id',76)->first()->custom_text }}</p>
                      </div>
                  </div>
                  @if ($activeOrder)
                  <div class="col-xl-12">
                    <div class="active_package">
                      <h4>{{ $websiteLang->where('id',435)->first()->custom_text }}</h4>
                      <div class="table-responsive">
                        @php
                            $unlimited=$websiteLang->where('id',425)->first()->custom_text;
                        @endphp
                        <table class="table dashboard_table">
                          <tbody>

                            <tr>
                                <td class="active_left">{{ $websiteLang->where('id',343)->first()->custom_text }}</td>
                                <td class="package_right">{{ $activeOrder->listingPackage->package_name }}</td>
                            </tr>


                            <tr>
                                <td class="active_left">{{ $websiteLang->where('id',153)->first()->custom_text }}</td>
                                <td class="package_right">{{ $currency->currency_icon  }}{{ $activeOrder->listingPackage->price }}</td>
                            </tr>
                            <tr>
                                <td class="active_left">{{ $websiteLang->where('id',151)->first()->custom_text }}</td>
                                <td class="package_right">{{ date('d F, Y',strtotime($activeOrder->purchase_date)) }}</td>
                            </tr>
                            <tr>
                                <td class="active_left">{{ $websiteLang->where('id',152)->first()->custom_text }}</td>
                                <td class="package_right">{{ $activeOrder->expired_date== null ? $websiteLang->where('id',425)->first()->custom_text : date('d F, Y',strtotime($activeOrder->expired_date)) }}</td>
                            </tr>
                            <tr>
                                <td class="active_left">{{ $websiteLang->where('id',431)->first()->custom_text }}</td>
                                <td class="package_right">{{ $activeOrder->listingPackage->number_of_listing==-1 ? $unlimited : $activeOrder->listingPackage->number_of_listing  }}</td>
                            </tr>
                            <tr>
                                <td class="active_left">{{ $websiteLang->where('id',434)->first()->custom_text }}</td>
                                <td class="package_right">{{ $activeOrder->listingPackage->number_of_aminities== -1 ? $unlimited : $activeOrder->listingPackage->number_of_aminities }}</td>
                            </tr>
                            <tr>
                                <td class="active_left">{{ $websiteLang->where('id',432)->first()->custom_text }}</td>
                                <td class="package_right">{{ $activeOrder->listingPackage->number_of_photo == -1 ? $unlimited : $activeOrder->listingPackage->number_of_photo }}</td>
                            </tr>
                            <tr>
                                <td class="active_left">{{ $websiteLang->where('id',433)->first()->custom_text }}</td>
                                <td class="package_right">{{ $activeOrder->listingPackage->number_of_video ==-1 ? $unlimited : $activeOrder->listingPackage->number_of_video }}</td>
                            </tr>
                            <tr>
                                <td class="active_left">{{ $websiteLang->where('id',20)->first()->custom_text }}</td>
                                <td class="package_right">{{ $activeOrder->listingPackage->is_featured ==1 ? $websiteLang->where('id',123)->first()->custom_text : $websiteLang->where('id',124)->first()->custom_text }}</td>
                            </tr>
                            @if ($activeOrder->listingPackage->is_featured==1)
                                <tr>
                                    <td class="active_left">{{ $websiteLang->where('id',351)->first()->custom_text }}</td>
                                    <td class="package_right">{{ $activeOrder->listingPackage->number_of_feature_listing == -1 ? $unlimited : $activeOrder->listingPackage->number_of_feature_listing }}</td>
                                </tr>
                            @endif
                          </tbody>
                        </table>
                     </div>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
        </div>
      </div>
@endsection
