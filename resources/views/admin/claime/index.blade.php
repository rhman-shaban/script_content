@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',457)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',461)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',37)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',38)->first()->custom_text }}</th>
                            <th width="30%">{{ $websiteLang->where('id',457)->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('id',56)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($claimes as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->comment }}</td>

                            <td><a target="_blank" href="{{ route('listing.show',$item->listing->slug) }}">{{ $item->listing->title }}</a></td>

                            <td>
                                @if ($item->listing->verified==1)
                                <a href="javascript:;" class="btn btn-success btn-sm">{{ $websiteLang->where('id',11)->first()->custom_text }}</a>
                                @else
                                <a href="{{ route('admin.verfiy-listing',$item->listing_id) }}" onclick="return confirm('{{ $confirmNotify }}')"class="btn btn-primary btn-sm">{{ $websiteLang->where('id',462)->first()->custom_text }}</a>
                                @endif

                                <a href="{{ route('admin.delete-claim',$item->id) }}" onclick="return confirm('{{ $deleteConfirmNotify }}')" class="btn btn-danger btn-sm"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

