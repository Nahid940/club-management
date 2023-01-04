<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .bordernone{
            border:none !important;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-spacing: 0 0px;
        }
        .table tr, .table td{
            background-color: #efeedf;
        }

        .table td, .table th {
            padding: .2rem;
            text-align: center;
            vertical-align: middle;
        }
        body{
            font-size: 25px;
        }
        .text-bold{
            font-weight: bold;
        }
    </style>
</head>
<body>
    <table class="table">
        <tbody>
        @php $i=1; @endphp
        @foreach ($members as $member)
            <tr>
                <td rowspan="7" class="bordernone"><img height="330" width="280"  src="{{ public_path('storage/member_photo/'.$member->member_photo)}}"  alt=""></td>
                <td class="bordernone"><div align="left" class="text-bold">Membership ID</div></td>
                <td class="bordernone">:</td>
                <td class="bordernone"><div align="left" class="text-bold">P645645</div></td>
            </tr>
            <tr>
                <td class="bordernone"><div align="left" class="text-bold">Name</div></td>
                <td class="bordernone">:</td>
                <td class="bordernone"><div align="left" class="text-bold">{{$member->first_name}}</div></td>
            </tr>
            <tr>
                <td class="bordernone"><div align="left" class="text-bold">Type Of Membership</div></td>
                <td class="bordernone">:</td>
                <td class="bordernone">
                    <div align="left" class="text-bold">
                        @if($member->member_type==1)
                            Donor Member
                        @elseif($member->member_type==2)
                            Life Member
                        @elseif($member->member_type==3)
                            NRB Member
                        @elseif($member->member_type==4)
                            General Member
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                <td class="bordernone"><div align="left" class="text-bold">Blood Group</div></td>
                <td class="bordernone">:</td>
                <td class="bordernone"><div align="left" class="text-bold">{{$member->blood_group}}</div></td>
            </tr>
            <tr>
                <td class="bordernone"><div align="left" class="text-bold">Mobile</div></td>
                <td class="bordernone">:</td>
                <td class="bordernone"><div align="left" class="text-bold">{{$member->mobile_number}}</div></td>
            </tr>
            <tr>
                <td class="bordernone"><div align="left" class="text-bold">E-mail</div></td>
                <td class="bordernone">:</td>
                <td class="bordernone"><div align="left" class="text-bold">{{$member->email}}</div></td>
            </tr>
            <tr>
                <td class="bordernone"><div align="left" class="text-bold">Address</div></td>
                <td class="bordernone">:</td>
                <td class="bordernone"><div align="left" class="text-bold">{{$member->present_address}}</div></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>