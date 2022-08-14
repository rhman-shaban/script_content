@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',423)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',423)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.paginator.update') }}" method="post">
                    @csrf
                    <table class="table table-bordered">

                        <tr>
                            <th>{{ $websiteLang->where('id',414)->first()->custom_text }}</th>
                            <th>{{ $websiteLang->where('id',292)->first()->custom_text }}</th>
                        </tr>
                        @foreach ($paginators  as $paginator)
                        <tr>
                            <td>{{ $paginator->page }}</td>
                            <td><input type="text" name="qtys[]" value="{{ $paginator->qty }}" class="form-control"></td>
                            <input type="hidden" name="ids[]" value="{{ $paginator->id }}">
                        </tr>
                        @endforeach


                    </table>
                    <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
