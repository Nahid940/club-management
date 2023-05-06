@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .table td, .table th {
    padding: .2rem;
    text-align:center;
    vertical-align: middle;
    }
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <h5>Monthly Fee Payment Schedule</h5>
                    <table class="table table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="width: 10%"><div align="center">Member Name</div></th>
                                <th style="width: 10%"><div align="center">Membership Type</div></th>
                                <th style="width: 10%"><div align="center">Registration Date</div></th>
                                <th style="width: 10%"><div align="center">Year</div></th>
                                <th style="width: 10%"><div align="center">Month</div></th>
                                <th style="width: 10%"><div align="center">Payable</div></th>
                            </tr>
                        </thead>
                        <tbody>

                        @php
                            $total_schedule=0;
                            $total_payable=0;
                            $total_paid=0;
                        @endphp
                        @foreach($report_data as $report_dt)
                            @php
                                $member_row=0;
                            @endphp
                            @foreach($report_dt['schedule'] as $key=>$data)
                                @php
                                    $year_row=0;
                                @endphp
                                @foreach($data as $month=>$schedule_data)
                                    @php
                                        $payable=isset($report_dt['payables'][$key][$month])?$report_dt['payables'][$key][$month]:0;
                                    @endphp
                                    <tr>
                                        @if($member_row==0)
                                            <td rowspan="{{$report_dt['total_schedule']}}"><div align="center">{{$report_dt['name']}}</div></td>
                                            <td rowspan="{{$report_dt['total_schedule']}}"><div align="center">{{$report_dt['type_name']}}</div></td>
                                            <td rowspan="{{$report_dt['total_schedule']}}"><div align="center">{{date('d-m-Y',strtotime($report_dt['registration_date']))}}</div></td>
                                        @endif
                                        @if($year_row==0)
                                            <td rowspan="{{sizeof($data)}}"><div align="center">{{$key}}</div></td>
                                        @endif
                                        <td style="background-color: #e3b40c91"><div align="center"><b>{{date("F", mktime(0, 0, 0, $month, 10))}}</b></div></td>
                                        <td style="background-color: #e3b40c91"><div align="right"><b>{{$payable}}</b></div></td>
                                    </tr>
                                    @php
                                        $member_row++;
                                        $year_row++;
                                        $total_payable+=empty($payable)?0:$payable;
                                        $total_paid+=empty($schedule_data)?0:$schedule_data;
                                    @endphp
                                @endforeach
                                @php

                                        @endphp
                            @endforeach
                        @endforeach

                        <tr style="background-color: #d8d8d8;font-weight: bold">
                            <td colspan="5"><div align="right">Total</div></td>
                            <td><div align="right">{{$total_payable}}</div></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        <!-- /.card -->
        </div>

    </div>
@stop
@section('script')
    $('.delete').on('click',function(){
    let id=$(this).attr('data-id')
    $('#member_id').val(id)
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
    {{-- Swal.fire(
    'Deleted!',
    'Your file has been deleted.',
    'success'
    ) --}}
    $('#member_del').submit();
    }
    })
    })

@stop