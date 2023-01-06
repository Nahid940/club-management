@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .ilqBSQ {
        width: 33%px;
        margin: 18px 10px 5px;
        float: left;
        padding: 2px;
        text-align: center;
        border-radius: 8px;
        cursor: pointer;
        display: block;
        background-color: initial;
        border: none;
    }
    .short_cut_icon {
        background-color: rgb(244, 245, 248);
        background-size: 80px;
        background-position: center center;
        background-repeat: no-repeat;
        {{--background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMiIgdmlld0JveD0iMCAwIDEyMCAxMjIiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik02NC45NDU0IDc4Ljc4OEM2NS4wMzcxIDc1LjY3NzcgNjQuMTgyNSA3Mi42MTM3IDYyLjQ5NjYgNzAuMDA4MUM2MC42MTIzIDY3LjI3MzggNTcuOTE2NCA2Ni40NDc4IDU1LjMwNTMgNjQuNjk2MUM1NC4wOTE0IDYzLjg3MDEgNTQuMDQyIDYyLjE0NjkgNTQuMjg5IDYwLjgwODJDNTQuNjEzNyA1OS4wNjM2IDU1LjMzMzUgNTQuOTYyMSA1NS44NjI4IDUzLjMxMDFDNTYuNjc0OSA1Mi43NzQyIDU3LjM1MjYgNTIuMDU1MyA1Ny44NDI1IDUxLjIxMDFDNTguMzMyNCA1MC4zNjQ5IDU4LjYyMSA0OS40MTY1IDU4LjY4NTcgNDguNDM5NUM1OC42ODU3IDQ2LjYxNjYgNTcuODM4OCA0NS42MzQgNTYuNTY4NSA0NC42OTRWNDIuOTA2N0M1Ni41MTkxIDM2LjYyNjMgNTcuNTAwMSAyOSA0NS4yNDE3IDI5QzQyLjI2MzYgMjkgMzcuMzggMzAuMDgyMyAzNy4zOCAzMy4zOTM1QzM3LjM4IDMzLjU4NTcgMzMuNDg0NCAzMi45MzA2IDMzLjk2NDMgNDIuODc4M1Y0NC42NjU2QzMyLjY3OTkgNDUuNjA1NSAzMS44NDcyIDQ2LjU4ODEgMzEuODQ3MiA0OC40MTFDMzEuOTA4OSA0OS4zODM2IDMyLjE5MjcgNTAuMzI4NyAzMi42NzYyIDUxLjE3MjNDMzMuMTU5OCA1Mi4wMTYgMzMuODMwMSA1Mi43MzU0IDM0LjYzNDggNTMuMjc0NUMzNS4xNzExIDU0LjkzMzYgMzUuODkwOSA1OS4wMjggMzYuMjE1NiA2MC43Nzk3QzM2LjQ2MjYgNjIuMTE4NCAzNi40MDYxIDYzLjg0MTYgMzUuMTk5MyA2NC42Njc2QzMyLjU4ODIgNjYuNDU0OSAyOS44OTIzIDY3LjI0NTMgMjguMDAxIDY5Ljk3OTdDMjYuMzAyIDcyLjU5MDggMjUuNDM5NyA3NS42NjU4IDI1LjUzMSA3OC43ODhDMzEuMDgxMSA4My40MDgxIDM4LjA0NjYgODUuOTQ0NiA0NS4yNDE3IDg1Ljk2NTdDNTIuNDQxNyA4NS45ODQ4IDU5LjQxODEgODMuNDQzNSA2NC45NDU0IDc4Ljc4OFY3OC43ODhaIiBmaWxsPSJ3aGl0ZSIgc3Ryb2tlPSIjMDA4NDgxIiBzdHJva2Utd2lkdGg9IjMiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgo8cGF0aCBkPSJNNDAuMDQ3OSAzNS4xNzM2QzQwLjA0NzkgMzUuMTczNiA0NS4wNTg1IDM2LjkzOTYgNTEuOTgxNiAzNS4xNzM2IiBzdHJva2U9IiMwMEMxQkYiIHN0cm9rZS13aWR0aD0iMS41IiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPgo8ZyBzdHlsZT0ibWl4LWJsZW5kLW1vZGU6bXVsdGlwbHkiIG9wYWNpdHk9IjAuMiI+CjxwYXRoIGQ9Ik01NS4yNDIxIDcxLjAxMjJDNTUuMjQzMyA3My40MTQ2IDU0LjY2NTggNzUuNzgxNCA1My41NTk0IDc3LjkwODdDNTIuNDUzIDgwLjAzNjEgNTAuODUwNyA4MS44NjAyIDQ4Ljg5MDYgODMuMjI0MkM1My44MjA0IDgyLjU3MDggNTguNDkzMiA4MC42MjEgNjIuNDQwNCA3Ny41NzAzQzYyLjM1MTIgNzUuMzY1OSA2MS42NzA2IDczLjIyNzMgNjAuNDcxNSA3MS4zODI0QzU5LjQ4MzUgNjkuOTU4MyA1OC4xNTY3IDY5LjIwMzUgNTYuNDcwMSA2OC4yNTY0QzU1LjkxOTYgNjcuOTQzMSA1NS4zNTUgNjcuNjIyNyA1NC43NzYzIDY3LjI2NjdDNTUuMDkxMSA2OC40ODk2IDU1LjI0NzcgNjkuNzQ4NiA1NS4yNDIxIDcxLjAxMjJWNzEuMDEyMloiIGZpbGw9IiMwMEMxQkYiLz4KPC9nPgo8cGF0aCBkPSJNNTIuOTEyOSA2Ny4yNjY3QzUwLjg1NTMgNjkuMjc3OCA0OC4xMDI5IDcwLjQwMjQgNDUuMjM4MiA3MC40MDI0QzQyLjM3MzQgNzAuNDAyNCAzOS42MjExIDY5LjI3NzggMzcuNTYzNSA2Ny4yNjY3IiBzdHJva2U9IiMwMEMxQkYiIHN0cm9rZS13aWR0aD0iMS41IiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPgo8cGF0aCBkPSJNNjIuOTIwOCA3NS40OTgyQzYxLjkwMzggNzYuMDE4NCA2MS4wMTYxIDc2Ljc2MzEgNjAuMzIzNyA3Ny42NzcxQzU4LjY5MzUgNzkuOTkxNCA1OC4wNjU0IDgxLjAzMSA1OC4wNjU0IDgzLjgyOTRDNjMuMDA1NSA4Ny44MzEzIDY5LjQwNjMgOTEgNzYuMjY1OSA5MUM4My4xMjU1IDkxIDg5LjU0MDUgODcuODgxMSA5NC40NjY0IDgzLjgyOTRDOTQuNDY2NCA4MS4wMzgxIDkzLjgzODMgNzkuOTk4NSA5Mi4yMDgxIDc3LjY4NDNDOTEuNTE3MyA3Ni43ODgxIDkwLjYzNzQgNzYuMDU4NCA4OS42MzIzIDc1LjU0ODFWNTEuODY0NkM4OS41NTIgNDguMzQyMyA4OC4xMDg5IDQ0Ljk5MTUgODUuNjExNyA0Mi41MjlDODMuMTE0NCA0MC4wNjY1IDc5Ljc2MTIgMzguNjg3OCA3Ni4yNjk1IDM4LjY4NzhDNzIuNzc3NyAzOC42ODc4IDY5LjQyNDUgNDAuMDY2NSA2Ni45MjczIDQyLjUyOUM2NC40MyA0NC45OTE1IDYyLjk4NjkgNDguMzQyMyA2Mi45MDY3IDUxLjg2NDZWNzUuNTA1M0w2Mi45MjA4IDc1LjQ5ODJaIiBmaWxsPSJ3aGl0ZSIgc3Ryb2tlPSIjMDA4NDgxIiBzdHJva2Utd2lkdGg9IjMiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgo8cGF0aCBkPSJNODYuOTQ5OCA3NC4yMTY1Qzg2LjA3MTggNzMuODM4IDg1LjIyNDYgNzMuMzkwNCA4NC40MTYzIDcyLjg3NzhDODMuNjM0IDcyLjI4ODcgODMuMDI4NyA3MS40OTI1IDgyLjY2NzUgNzAuNTc3NUM4Mi4zMDYyIDY5LjY2MjUgODIuMjAzMiA2OC42NjQ0IDgyLjM2OTcgNjcuNjkzOUM4My4wMTE5IDY1LjM0NDEgODUuNTM4NCA2My4xNTA5IDg1LjUzODQgNjAuNjU4N1Y1My43MDE3Qzg1LjUxNDEgNTEuNjMyNSA4NC44MDcxIDQ5LjYzMDUgODMuNTI5IDQ4LjAxMjFDODIuMjUwOSA0Ni4zOTM3IDgwLjQ3NDcgNDUuMjUxMiA3OC40ODEyIDQ0Ljc2NTNDNzcuNzg4MSA0Ny4yOTkgNzYuMjg3MiA0OS41MzE5IDc0LjIxMDYgNTEuMTE4OEM3Mi4xMzM5IDUyLjcwNTggNjkuNTk3IDUzLjU1ODUgNjYuOTkyIDUzLjU0NTFWNjAuNjY1OEM2Ni45OTIgNjMuMTU4IDY5LjUyNTYgNjUuMzUxMiA3MC4xNjA3IDY3LjcwMTFDNzAuMzMwNSA2OC42NzEgNzAuMjI5NiA2OS42Njk0IDY5Ljg2OTUgNzAuNTg0OEM2OS41MDkzIDcxLjUwMDIgNjguOTA0IDcyLjI5NjYgNjguMTIxMiA3Mi44ODQ5QzY3LjMxNTggNzMuMzk2NSA2Ni40NzA5IDczLjg0MTggNjUuNTk0NyA3NC4yMTY1IiBzdHJva2U9IiMwMEMxQkYiIHN0cm9rZS13aWR0aD0iMS41IiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPgo8ZyBzdHlsZT0ibWl4LWJsZW5kLW1vZGU6bXVsdGlwbHkiIG9wYWNpdHk9IjAuMTUiPgo8cGF0aCBkPSJNODUuNTUxNyA3OS4xNzk2Qzg1LjU1MTUgODAuODY2MSA4NS4xNyA4Mi41MzAzIDg0LjQzNjMgODQuMDQ1NkM4My43MDI1IDg1LjU2MDkgODIuNjM1OCA4Ni44ODczIDgxLjMxNzQgODcuOTIzOEM4NS4xNjQxIDg2Ljk0NDMgODguNzY4MyA4NS4xNzIgOTEuOTAzMiA4Mi43MTg2QzkxLjc1NSA4MS41NzIyIDkxLjMwMzMgODAuODk1NyA5MC4xNjcxIDc5LjI4NjRDODkuNDYxNCA3OC4yNzUzIDg3LjkyMjkgNzcuNTg0NiA4Ni4zMDY4IDc2Ljg1MTFDODUuOTE4NyA3Ni42NzMxIDg1LjUzMDUgNzYuNDk1MSA4NS4xMzUzIDc2LjMwMjlDODUuMzk2OCA3Ny4yMzk2IDg1LjUzNjcgNzguMjA2NiA4NS41NTE3IDc5LjE3OTZaIiBmaWxsPSIjMDBDMUJGIi8+CjwvZz4KPHBhdGggZD0iTTgzLjk0MzEgNzUuNzU0NkM4Mi43MTUyIDc2Ljk2NTEgODAuMzI5OSA3OC44ODA2IDc4LjUzNzMgODAuMjY5MUM3Ny44ODc0IDgwLjc3ODQgNzcuMDg3OCA4MS4wNTQ4IDc2LjI2NDkgODEuMDU0OEM3NS40NDIgODEuMDU0OCA3NC42NDI1IDgwLjc3ODQgNzMuOTkyNSA4MC4yNjkxQzcyLjIwNyA3OC44NDUgNjkuODIxNyA3Ni45NjUxIDY4LjU5MzggNzUuNzU0NiIgc3Ryb2tlPSIjMDBDMUJGIiBzdHJva2Utd2lkdGg9IjEuNSIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBzdHJva2UtbGluZWNhcD0icm91bmQiLz4KPC9zdmc+Cg==);--}}
        width: 80px;
        height: 80px;
        margin: 0px auto 8px;
        border-radius: 50%;
        border: 2px solid rgb(212, 215, 220);
    }
    .iLmjWS {
        text-overflow: ellipsis;
        overflow: hidden;
        max-height: 2.4em;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
    .esp_icons{
        font-size:35px
    }
@stop
@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
            @role('member')
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-archive text-blue" aria-hidden="true"></i>
                            Summery
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card card-widget widget-user-2 shadow-sm">
                            <div class="widget-user-header bg-gradient-gray">
                                <div class="widget-user-image">
                                    @if(!empty($info->member_photo))
                                        <img style="width: 50px;border-radius: 10px" src="{{asset('storage/member_photo/'.$info->member_photo)}}" alt=""></div>
                                    @else
                                        <img style="width: 50px;border-radius: 10px" src="{{asset('img/user.jpeg')}}" alt=""></div>
                                    @endif
                                <h3 class="widget-user-username">{{$info->first_name}}</h3>
                                <h6 class="widget-user-desc">
                                    @if($info->member_type==1)
                                        Donor Member
                                    @elseif($info->member_type==2)
                                        Life Member
                                    @elseif($info->member_type==3)
                                        NRB Member
                                    @elseif($info->member_type==4)
                                        General Member
                                    @endif
                                </h6>
                            </div>
                            <div class="card-footer p-0">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Date of Join <span class="float-right ">{{date('d-m-Y',strtotime($info->registration_date))}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Total Payment <span class="float-right  ">{{$payment->amount}} /-</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Last Payment Date <span class="float-right ">{{date('d-m-Y',strtotime($payment->payment_date))}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-bookmark text-purple" aria-hidden="true"></i>
                            Shortcuts
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="ilqBSQ">
                            <a class="esp_icons" href="{{route('member-admission')}}" style="color: #fd4f0c;"><i class="fa fa-address-card" aria-hidden="true"></i></a>
                            <div class="iLmjWS">Membership<br>application</div>
                        </div>
                        <div class="ilqBSQ">
                            <a class="esp_icons" href="{{route('member-profile')}}" style="color: #c78409;"><i class="fa fa-address-book" aria-hidden="true"></i></a>
                            <div class="iLmjWS">Profile</div>
                        </div>
                        <div class="ilqBSQ">
                            <a href="{{route('member-payment-index')}}" class="esp_icons" style="color: #f7323b"><i class="fa fa-credit-card" aria-hidden="true"></i></a>
                            <div class="iLmjWS">Payment</div>
                        </div>
                        <div class="ilqBSQ">
                            <a href="{{route('member-book')}}" class="esp_icons" style="color: #0da2c3"><i class="fa fa-book" aria-hidden="true"></i></a>
                            <div class="iLmjWS">Member Book</div>
                        </div>
                        <div class="ilqBSQ">
                            <a href="{{route('settings')}}" class="esp_icons" style="color: #004edc"><i class="fa fa-cog" aria-hidden="true"></i></a>
                            <div class="iLmjWS">Settings</div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            {{--</div>--}}
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-sticky-note text-orange" aria-hidden="true"></i>
                            Notice Board
                        </h3>
                    </div>
                    @if(empty(!$notices->isEmpty()))
                        <div class="card-row card-secondary">
                            <div class="card-warning card-outline">
                                <div class="card-body">
                                    <div class="alert bg-gray">No Notice Posted Yet!</div>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($notices as $notice)
                            <div class="card-row card-secondary">
                                <div class="card-warning card-outline">
                                    <div class="card-header">
                                        <p class="text-sm">{{$notice->title}}</p>
                                        <span style="color: #0d626b">{{date('d-m-Y h:i A',strtotime($notice->created_at))}}<br> Posted by Admin</span>
                                    </div>
                                    <div class="card-body">
                                        <p>{!! substr($notice->notice,0,500) !!}...<a href="{{route('notice-view',$notice->id)}}">Read more</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title mr-1">
                                    <i class="fa fa-mail-bulk"></i>
                                    Summery
                                </h3>
                                <span style="font-size: 19px;font-weight: bold;color:#085dc7;float: right">Date: {{date('d-m-Y',strtotime($today))}}</span>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-1">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Total Registered Members</span>
                                                <span class="info-box-number">{{$active_member}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-clipboard-check"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">New Members This Month</span>
                                                <span class="info-box-number">{{$this_month_new_member}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-gradient-pink elevation-1"><i class="fas fa-clipboard-list"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Pending Applications</span>
                                                <span class="info-box-number">{{$new_member_application}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-gradient-green elevation-1"><i class="fas fa-credit-card"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Total Payment</span>
                                                <span class="info-box-number">{{number_format($total_payment,2,".",",")}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-bullhorn"></i>
                                    Shortcuts
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="ilqBSQ">
                                    <a href="{{route('member-index')}}" class="esp_icons" style="color: #0da2c3"><i class="fa fa-book" aria-hidden="true"></i></a>
                                    <div class="iLmjWS">Member list</div>
                                </div>
                                <div class="ilqBSQ">
                                    <a href="{{route('payment-add')}}" class="esp_icons" style="color: #3d4cc3"><i class="fa fa-credit-card" aria-hidden="true"></i></a>
                                    <div class="iLmjWS">New Payment</div>
                                </div>
                                <div class="ilqBSQ">
                                    <a href="{{route('user-add')}}" class="esp_icons" style="color: #33c36b"><i class="fa fa-user" aria-hidden="true"></i></a>
                                    <div class="iLmjWS">New User</div>
                                </div>
                                <div class="ilqBSQ">
                                    <a href="{{route('notice-add')}}" class="esp_icons" style="color: #ffb812"><i class="fa fa-clipboard" aria-hidden="true"></i></a>
                                    <div class="iLmjWS">Post Notice</div>
                                </div>
                                <div class="ilqBSQ">
                                    <a href="{{route('notice-add')}}" class="esp_icons" style="color: #c31015"><i class="fa fa-tools" aria-hidden="true"></i></a>
                                    <div class="iLmjWS">Password Update</div>
                                </div>
                                <div class="ilqBSQ">
                                    <a href="{{route('member-index')}}" class="esp_icons" style="color: #c3365f"><i class="fa fa-mail-bulk" aria-hidden="true"></i></a>
                                    <div class="iLmjWS">Email Config</div>
                                </div>
                                <div class="ilqBSQ">
                                    <a href="{{route('payment-add')}}" class="esp_icons" style="color: #e25c00"><i class="fa fa-toolbox" aria-hidden="true"></i></a>
                                    <div class="iLmjWS">Settings</div>
                                </div>
                                <div class="ilqBSQ">
                                    <a href="{{route('user-add')}}" class="esp_icons" style="color: #ff0b4f"><i class="fa fa-user-cog" aria-hidden="true"></i></a>
                                    <div class="iLmjWS">User Role</div>
                                </div>
                                <div class="ilqBSQ">
                                    <a href="{{route('member-book')}}" class="esp_icons" style="color: #083aff"><i class="fa fa-book" aria-hidden="true"></i></a>
                                    <div class="iLmjWS">Member Book</div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            @endrole
        <div class="row">
            
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
@stop
