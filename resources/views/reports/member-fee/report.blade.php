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
        <th style="border: none"><div class="text-lg" align="center">Membership Fee Due Report</div></th>
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
                <th style="width: 10%"><div align="center">Membership Fee</div></th>
                <th style="width: 10%"><div align="center">Paid Amount</div></th>
                <th style="width: 10%"><div align="center">Due Amount</div></th>
            </tr>
        </thead>
        <tbody>

        @php
            $admission_fee=0;
            $paid=0;
            $due=0;
        @endphp
        @foreach($report_data as $data)
            <tr>
                <td><div align="center">{{$data['name']}}</div></td>
                <td><div align="center">{{$data['membership_type']}}</div></td>
                <td><div align="center">{{date('d-m-Y',strtotime($data['registration_date']))}}</div></td>
                <td><div align="right">{{$data['admission_fee']}}</div></td>
                <td><div align="right">{{$data['paid']}}</div></td>
                <td><div align="right">{{$data['due']}}</div></td>
            </tr>
            @php
                $admission_fee+=$data['admission_fee'];
                $paid+=$data['paid'];
                $due+=$data['due'];
            @endphp
        @endforeach

        <tr style="background-color: #d8d8d8;font-weight: bold">
            <td colspan="3">Total</td>
            <td><div align="right">{{$admission_fee}}</div></td>
            <td><div align="right">{{$paid}}</div></td>
            <td><div align="right">{{$due}}</div></td>
        </tr>
        </tbody>
    </table>
</div>