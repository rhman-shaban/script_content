@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',261)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',263)->first()->custom_text }}
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('id',38)->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('id',135)->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscribers as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if ($item->status)
                                    <span class="badge badge-success">{{ $websiteLang->where('id',11)->first()->custom_text }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.subscriber.delete',$item->id) }}" onclick="return confirm('{{ $confirmNotify }}')"class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

