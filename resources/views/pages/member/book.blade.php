<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text&family=Roboto&family=Source+Sans+Pro:wght@200;300;400;600&display=swap" rel="stylesheet">
    <style>

        body{
            font-family: 'Source Sans Pro', sans-serif;
        }
        .main{
            width: 60%;
            border: 4px solid #0088ff;
            padding: 10px;
            margin: 10px auto 10px auto;
            background-color: #008ff957;
            color:#000;
        }
        .my_table{
            width: 100%;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="main">
    @include('reports.report_header')
    <hr>
    <table id="" class="my_table">
        <tbody>
        @php $i=1; @endphp
        @foreach ($members as $member)
            <tr>
                <td rowspan="7" class="bordernone">
                    @if(isset($member->member_photo) && !empty($member->member_photo))
                        <img style="width: 140px" src="{{asset('public/storage/member_photo/'.$member->member_photo)}}" alt="">
                    @else
                        <img style="width: 140px" src="{{asset('public/img/user.jpeg')}}" alt="">
                    @endif
                </td>
                <td class="bordernone"><div align="left" class="text-bold">Member ID</div></td>
                <td class="bordernone">:</td>
                <td class="bordernone"><div align="left" class="text-bold">{{$member->member_code}}</div></td>
            </tr>
            <tr>
                <td class="bordernone"><div align="left" class="text-bold">Name</div></td>
                <td class="bordernone">:</td>
                <td class="bordernone"><div align="left" class="text-bold">{{$member->first_name}}</div></td>
            </tr>
            @if($member->privacy_mode==0)
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
                            @elseif($member->member_type==5)
                                User Member
                            @elseif($member->member_type==6)
                                Foundation Member
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
            @else
                <tr>
                    <td class="bordernone"><div align="left" class="text-bold">Type Of Membership</div></td>
                    <td class="bordernone">:</td>
                    <td class="bordernone">&nbsp;</td>
                </tr>
                <tr>
                    <td class="bordernone" colspan=""><div align="left" class="text-bold">Blood Group</div></td>
                    <td class="bordernone" colspan="">:</td>
                    <td class="bordernone" colspan="">&nbsp;</td>
                </tr>
                <tr>
                    <td class="bordernone" colspan=""><div align="left" class="text-bold">Mobile</div></td>
                    <td class="bordernone" colspan="">:</td>
                    <td class="bordernone" colspan="">&nbsp;</td>
                </tr>
                <tr>
                    <td class="bordernone"colspan=""><div align="left" class="text-bold">Email</div></td>
                    <td class="bordernone"colspan="">:</td>
                    <td class="bordernone"colspan="">&nbsp;</td>
                </tr>
                <tr>
                    <td class="bordernone" colspan=""><div align="left" class="text-bold">Address</div></td>
                    <td class="bordernone" colspan="">:</td>
                    <td class="bordernone" colspan="">&nbsp;</td>
                </tr>
            @endif
            <tr style="">
                <td colspan="4" class="">
                    <hr></td>
            </tr>

        @endforeach

        </tbody>
    </table>
    {{$members->links()}}
</div>

</body>
</html>
