@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',330)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',331)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('id',37)->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('id',38)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',39)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',121)->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('id',56)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',135)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td> <img src="{{ $item->image ? url($item->image) : "" }}" class="blog_img_width">
                            </td>
                            <td>{{ $item->listings->count() }}</td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="userStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="userStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.user.show',$item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.user.delete',$item->id) }}" onclick="return confirm('{{ $confirmNotify }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>



                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function userStatus(id){
            // project demo mode check
         var isDemo="{{ env('PROJECT_MODE') }}"
         var demoNotify="{{ env('NOTIFY_TEXT') }}"
         if(isDemo==0){
             toastr.error(demoNotify);
             return;
         }
         // end

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
