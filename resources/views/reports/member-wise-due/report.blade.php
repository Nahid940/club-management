<style>
    th, td {
        border: 1px solid #b3b0af;
        padding: 8px;
    }

    thead th {
        width: 25%;
    }
    table{
        width: 100%;
    }
</style>
<a title="Print" class="no-print badge badge-primary m-2" style="cursor: pointer" onclick="window.print()"><i class="fas fa-print mr-1" aria-hidden="true" style=""></i>Print</a>
<div class="mb-2">
    @include('reports.report_header')
    <table id="heading">
        <thead>
        <th style="border: none"><div class="text-lg" align="center">Member-wise Due Report</div></th>
        </thead>
        <tr>
            <td>Print Date : <b>{{date('d-m-Y')}}</b></td>
        </tr>
    </table>
</div>
<div class="report_body">
    <table>
        <thead>
            <tr>
                <th style="width: 10%"><div align="center">Member Name</div></th>
                <th style="width: 10%"><div align="center">Membership Type</div></th>
                <th style="width: 10%"><div align="center">Registration Date</div></th>
                <th style="width: 10%"><div align="center">Year</div></th>
                <th style="width: 10%"><div align="center">Month</div></th>
                <th style="width: 10%"><div align="center">Payment Status</div></th>
            </tr>
        </thead>
        <tbody>

        @php
            $total_schedule=0;
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
                    <tr>
                        @if($member_row==0)
                            <td rowspan="{{$report_dt['total_schedule']}}"><div align="center">{{$report_dt['name']}}</div></td>
                            <td rowspan="{{$report_dt['total_schedule']}}"><div align="center">{{$report_dt['type_name']}}</div></td>
                            <td rowspan="{{$report_dt['total_schedule']}}"><div align="center">{{date('d-m-Y',strtotime($report_dt['registration_date']))}}</div></td>
                        @endif
                        @if($year_row==0)
                            <td rowspan="{{sizeof($data)}}"><div align="center">{{$key}}</div></td>
                        @endif
                        <td style="background-color: {{empty($schedule_data)?'#f7acac38':'#d1f5c538'}}"><div align="center">{{date("F", mktime(0, 0, 0, $month, 10))}}</div></td>
                        <td style="background-color: {{empty($schedule_data)?'#f7acac38':'#d1f5c538'}}"><div align="center">{{empty($schedule_data)?'Due':'Paid'}}</div></td>
                    </tr>
                    @php
                        $member_row++;
                    $year_row++;
                    @endphp
                @endforeach
                @php

                @endphp
            @endforeach
        @endforeach

        <tr style="background-color: #d8d8d8;font-weight: bold">
            {{--<td colspan="2">Total</td>--}}
            {{--<td><div align="right"></div></td>--}}
            {{--<td><div align="right"></div></td>--}}
        </tr>
        </tbody>
    </table>
</div>