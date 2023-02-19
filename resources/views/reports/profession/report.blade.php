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
        <th colspan="2" style="border: none"><div class="text-lg" align="center">Profession-wise Member Report</div></th>
        </thead>
        <tr>
            <td>Profession: {{isset($occupation->occupation)?$occupation->occupation:"All"}}</td>
            <td>Print Date : <b>{{date('d-m-Y')}}</b></td>
        </tr>
    </table>
</div>
<div class="report_body">
    <table>
        <thead>
        <tr>
            <th><div align="center">Member Name</div></th>
            <th style="width: 20%"><div align="center">Member ID</div></th>
            <th style="width: 20%"><div align="center">Email</div></th>
            <th style="width: 15%"><div align="center">Phone</div></th>
            <th style="width: 5%"><div align="center">Profession</div></th>
            <th style="width: 20%"><div align="center">Registration Date</div></th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
            <tr>
                <td><div align="center">{{$member->first_name}}</div></td>
                <td><div align="center">{{$member->member_code}}</div></td>
                <td><div align="center">{{$member->email}}</div></td>
                <td><div align="center">{{$member->mobile_number}}</div></td>
                <td><div align="center">{{$member->occupation}}</div></td>
                <td><div align="center">{{date('d-m-Y',strtotime($member->registration_date))}}</div></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>