@extends('layouts.staff.layout')
@section('title')
<title>{{ $websiteLang->where('id',387)->first()->custom_text }}</title>
@endsection
@section('staff-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 d-inline"><a href="{{ route('staff.listing.index') }}" class="btn btn-success"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('id',368)->first()->custom_text }} </a></h1>
    <h1 class="h3 mb-2 text-gray-800 d-inline"><a href="{{ route('staff.listing.new.schedule',$listing->id) }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true" ></i> {{ $websiteLang->where('id',137)->first()->custom_text }} </a></h1>

    <!-- DataTales Example -->
    <div class="card shadow mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $listing->title }} {{ $websiteLang->where('id',130)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="10%">{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('id',132)->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('id',133)->first()->custom_text }}</th>
                            <th width="20%">{{ $websiteLang->where('id',134)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',135)->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->day->day }}</td>
                            <td>{{ $item->start_time }}</td>
                            <td>{{ $item->end_time }}</td>

                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="listingScheduleStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="listingScheduleStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="{{ route('staff.listing.schedule.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a onclick="return confirm('{{ $confirmNotify }}')" href="{{ route('staff.listing.schedule.delete',$item->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>


                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        function listingScheduleStatus(id){
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
                url:"{{url('/staff/listing-schedule-status/')}}"+"/"+id,
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
