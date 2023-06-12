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
        <th style="border: none"><div class="text-lg" align="center">Duration wise due Report</div></th>
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
                <th style="width: 10%"><div align="center">Registration Date</div></th>
                <th style="width: 10%"><div align="center">Membership Type</div></th>
                <th style="width: 10%"><div align="center">Due Period</div></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report_data as $data)
                <tr>
                    <td><div align='center'>{{$data['name']}}</div></td>
                    <td><div align='center'>{{$data['registration_date']}}</div></td>
                    <td><div align='center'>{{$data['type_name']}}</div></td>
                    <td><div align='center'>{{$data['due']}} Months</div> </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="report-footer" style="margin-top:20px;">

</div>