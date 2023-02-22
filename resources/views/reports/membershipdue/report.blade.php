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
        <th colspan="2" style="border: none"><div class="text-lg" align="center">Membership-wise Due Report</div></th>
        </thead>
        <tr>
            <td>Membership Type: {{empty($type_name->type_name)?"All":$type_name->type_name}}</td>
            <td>Print Date : <b>{{date('d-m-Y')}}</b></td>
        </tr>
    </table>
</div>
<div class="report_body">
    <table>
        <thead>
            <tr>
                <th><div align="center">Member Name</div></th>
                <th style="width: 10%"><div align="center">Membership Type</div></th>
                <th style="width: 20%"><div align="center">Membership Fee Due</div></th>
                <th style="width: 20%"><div align="center">Monthly Payment Due</div></th>
            </tr>
        </thead>
        <tbody>
        @php
            $membership_fee_due=0;
            $monthly_fee_due=0;
        @endphp
        @foreach($membership_dues as $member)
            <tr>
                <td><div align="center">{{$member['name']}}</div></td>
                <td><div align="center">{{$member['membership_type']}}</div></td>
                <td><div align="right">{{$member['membership_fee_due']}}</div></td>
                <td><div align="right">{{$member['monthly_fee_due']}}</div></td>
            </tr>
            @php
                $membership_fee_due+=$member['membership_fee_due'];
                $monthly_fee_due+=$member['monthly_fee_due'];
            @endphp
        @endforeach
        <tr style="background-color: #d8d8d8;font-weight: bold">
            <td colspan="2">Total</td>
            <td><div align="right">{{$membership_fee_due}}</div></td>
            <td><div align="right">{{$monthly_fee_due}}</div></td>
        </tr>
        </tbody>
    </table>
</div>