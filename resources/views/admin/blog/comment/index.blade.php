@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',232)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',242)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',37)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',38)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',39)->first()->custom_text }}</th>
                            <th width="40%">{{ $websiteLang->where('id',46)->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('id',230)->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('id',135)->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->comment }}</td>
                            <td><a target="_blank" href="{{ url('blog-details/'.$item->blog->slug) }}">{{ $websiteLang->where('id',243)->first()->custom_text }}</a></td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="commentStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="commentStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.delete.blog.comment',$item->id) }}"  class="btn btn-danger btn-sm" onclick="return confirm('{{ $confirmNotify }}')"><i class="fas fa-trash    "></i></a>


                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/blog/") }}'+"/"+id)
        }

        function commentStatus(id){
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
                url:"{{url('/admin/blog-comment-status/')}}"+"/"+id,
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
