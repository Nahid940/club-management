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
        <th colspan="2" style="border: none"><div class="text-lg" align="center">Daily Statement</div></th>
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
                <th colspan="2">&nbsp;</th>
                <th colspan="2"><div align="center"><b>B&G Lounge</b></div></th>
                <th colspan="2"><div align="center"><b>Cafe</b></div></th>
            </tr>
            <tr>
                <th style="width: 10%"><div align="center">Bill No</div></th>
                <th style="width: 20%"><div align="center">Member's ID No</div></th>
                <th style="width: 15%;background-color: #f5f5f5"><div align="center">Cash</div></th>
                <th style="width: 15%;background-color: #f5f5f5"><div align="center">Card</div></th>
                <th style="width: 15%"><div align="center">Cash</div></th>
                <th style="width: 15%"><div align="center">Card</div></th>
            </tr>
        </thead>
        <tbody>
        @php
            $current_id=0;
            $sub_total=0;
            $grand_total1=0;
            $grand_total2=0;
            $grand_total3=0;
            $grand_total4=0;
        @endphp
        @foreach($bills as $bill)
            <tr>
                <td style="width: 10%"><div align="center">#{{$bill->id}}</div></td>
                <td style="width: 10%"><div align="center">{{empty($bill->member_code)?'-':$bill->member_code}}</div></td>
                <td style="width: 15%;background-color: #f5f5f5"><div align="right">{{number_format($bill->lounge_cash_amount,0,'.',',')}}</div></td>
                <td style="width: 15%;background-color: #f5f5f5"><div align="right">{{number_format($bill->lounge_card_amount,0,'.',',')}}</div></td>
                <td style="width: 15%"><div align="right">{{number_format($bill->restaurant_cash_amount,0,'.',',')}}</div></td>
                <td style="width: 15%"><div align="right">{{number_format($bill->restaurant_card_amount,0,'.',',')}}</div></td>
            </tr>
            @php
                $grand_total1+=$bill->lounge_cash_amount;
                $grand_total2+=$bill->lounge_card_amount;

                $grand_total3+=$bill->restaurant_cash_amount;
                $grand_total4+=$bill->restaurant_card_amount;
            @endphp
        @endforeach
        <tr style="background-color: #f1f1f1;font-weight: bold">
            <td colspan="2"><div align="right">Sub Total</div></td>
            <td colspan=""><div align="right">{{number_format($grand_total1,2,'.',',')}}</div></td>
            <td colspan=""><div align="right">{{number_format($grand_total2,2,'.',',')}}</div></td>
            <td colspan=""><div align="right">{{number_format($grand_total3,2,'.',',')}}</div></td>
            <td colspan=""><div align="right">{{number_format($grand_total4,2,'.',',')}}</div></td>
        </tr>
        <tr style="background-color: #f1f1f1;font-weight: bold">
            <td colspan="2"><div align="right">Grand Total</div></td>
            <td colspan="2"><div align="right">{{number_format($grand_total1+$grand_total2,2,'.',',')}}</div></td>
            <td colspan="2"><div align="right">{{number_format($grand_total3+$grand_total4,2,'.',',')}}</div></td>
        </tr>
        </tbody>
    </table>
</div>