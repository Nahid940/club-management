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
            <th colspan="2" style="border: none"><div class="text-lg" align="center">Memberwise Payment Report</div></th>
        </thead>
        <tr>
            @if(!empty($date_from) && !empty($date_to))
            <td style="border: none">Report Date : <b>From {{date('d-m-Y',strtotime($date_from))}} to {{date('d-m-Y',strtotime($date_to))}}</b></td>
            @elseif((!empty($date_from) && empty($date_to)))
                <td style="border: none">Report Date : <b>From {{date('d-m-Y',strtotime($date_from))}}</b></td>
            @endif
            <td style="border: none">Print Date : <b>{{date('d-m-Y')}}</b></td>
        </tr>
        @if(isset($purpose))
            <tr>
                <td style="border: none">Purpose : {{$purpose->purpose}}</td>
            </tr>
        @endif
    </table>
</div>
<div class="report_body">
    <table>
        <thead>
            <tr>
                <th><div align="center">Member Name</div></th>
                <th><div align="center">Payment Date</div></th>
                <th><div align="center">Payment Month</div></th>
                <th><div align="center">Payment Type</div></th>
                <th><div align="right">Amount</div></th>
            </tr>
        </thead>
        <tbody>
            @php
                $current_id=0;
                $sub_total=0;
                $grand_total=0;
            @endphp
            @foreach($payments as $payment)
                @foreach($payment['payment'] as $member_payment)
                    @if(isset($payment['id']))
                        <tr>@if($payment['id']!=$current_id)
                                <td rowspan="{{count($payment['payment'])}}"><div align="center"><b>{{$payment['name']}}</b></div></td>
                            @endif
                            <td><div align="center">{{date('d-m-Y',strtotime($member_payment['payment_date']))}}</div></td>
                            <td><div align="right">{{date("F", mktime(0, 0, 0, $member_payment['payment_month'], 10))."-".$member_payment['payment_year']}}</div></td>
                            <td><div align="center">{{$member_payment['payment_type']}}</div></td>
                            <td><div align="right">{{number_format($member_payment['amount'],2,'.',',')}}</div></td>
                        </tr>
                        @php
                            $current_id=$payment['id'];
                            $sub_total+=$member_payment['amount'];
                        @endphp
                    @endif
                @endforeach
                <tr style="background-color: #d8d8d8;font-weight: bold">
                    <td colspan="4">Sub Total</td>
                    <td><div align="right">{{number_format($sub_total,2,'.',',')}}</div></td>
                </tr>
                @php $grand_total+=$sub_total @endphp
            @endforeach
            <tr style="background-color: #d8d8d8;font-weight: bold">
                <td colspan="4">Grand Total</td>
                <td><div align="right">{{number_format($grand_total,2,'.',',')}}</div></td>
            </tr>
        </tbody>
    </table>
</div>