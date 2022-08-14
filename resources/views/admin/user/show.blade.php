@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',330)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.user') }}" class="btn btn-success"> <i class="fas fa-backward" aria-hidden="true"></i> {{ $websiteLang->where('id',142)->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',332)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>{{ $websiteLang->where('id',121)->first()->custom_text }}</td>
                    <td> <img src="{{ $user->image ? asset($user->image) : '' }}" alt="user image" class="custom_img_width"> </td>
                </tr>
                <tr>
                    <td>{{ $websiteLang->where('id',37)->first()->custom_text }}</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>{{ $websiteLang->where('id',38)->first()->custom_text }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>{{ $websiteLang->where('id',333)->first()->custom_text }}</td>
                    <td>{{ $user->about }}</td>
                </tr>
                <tr>
                    <td>{{ $websiteLang->where('id',39)->first()->custom_text }}</td>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <td>{{ $websiteLang->where('id',135)->first()->custom_text }}</td>
                    <td>
                        @if ($user->status==1)
                                <a href="" onclick="userStatus({{ $user->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="userStatus({{ $user->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                    </td>
                </tr>

                @if ($user->facebook)
                <tr>
                    <td>Facebook</td>
                    <td><a href="{{ $user->facebook }}">{{ $user->facebook }} </a></td>
                </tr>
                @endif
                @if ($user->twitter)
                <tr>
                    <td>Twitter</td>
                    <td><a href="{{ $user->twitter }}">{{ $user->twitter }} </a></td>
                </tr>
                @endif
                @if ($user->linkedin)
                <tr>
                    <td>linkedin</td>
                    <td><a href="{{ $user->linkedin }}">{{ $user->linkedin }} </a></td>
                </tr>
                @endif
                @if ($user->pinterest)
                <tr>
                    <td>pinterest</td>
                    <td><a href="{{ $user->pinterest }}">{{ $user->pinterest }} </a></td>
                </tr>
                @endif
                @if ($user->whatsapp)
                <tr>
                    <td>whatsapp</td>
                    <td><a href="{{ $user->whatsapp }}">{{ $user->whatsapp }} </a></td>
                </tr>
                @endif
                @if ($user->youtube)
                <tr>
                    <td>youtube</td>
                    <td><a href="{{ $user->youtube }}">{{ $user->youtube }} </a></td>
                </tr>
                @endif
                @if ($user->tumblr)
                <tr>
                    <td>tumblr</td>
                    <td><a href="{{ $user->tumblr }}">{{ $user->tumblr }} </a></td>
                </tr>
                @endif
                @if ($user->instagram)
                <tr>
                    <td>instagram</td>
                    <td><a href="{{ $user->instagram }}">{{ $user->instagram }} </a></td>
                </tr>
                @endif

            </table>
        </div>
    </div>

    <script>

        function userStatus(id){
            $.ajax({
                type:"get",
                url:"{{url('/admin/user-status/')}}"+"/"+id,
                success:function(response){
                   toastr.success(response)
                },
                error:function(err){
                    console.log(err);

                }
            })
        }
    </script>
@endsection
