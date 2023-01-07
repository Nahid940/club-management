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
<div class="mb-2">
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
    </table>
</div>
<div class="report_body">
    <table>
        <thead>
            <tr>
                <th><div align="center">Member Name</div></th>
                <th><div align="center">Payment Date</div></th>
                <th><div align="right">Amount</div></th>
            </tr>
        </thead>
        <tbody>
        @php
            $current_id=0;
            $sub_total=0;
        @endphp
        @foreach($payments as $payment)
            @foreach($payment['payment'] as $member_payment)
                <tr>@if($payment['id']!=$current_id)
                        <td rowspan="{{count($payment['payment'])}}"><div align="center"><b>{{$payment['name']}}</b></div></td>
                    @endif
                    <td><div align="center">{{date('d-m-Y',strtotime($member_payment['payment_date']))}}</div></td>
                    <td><div align="right">{{number_format($member_payment['amount'],2,'.',',')}}</div></td>
                </tr>
                @php
                    $current_id=$payment['id'];
                    $sub_total+=$member_payment['amount'];
                @endphp
            @endforeach
            <tr style="background-color: #d8d8d8;font-weight: bold">
                <td colspan="2">Sub Total</td>
                <td><div align="right">{{number_format($sub_total,2,'.',',')}}</div></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>