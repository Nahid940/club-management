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
        <div class="row">
            @role('member')
            <div class="col-md-6">
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
                            <a class="esp_icons" style="color: #0da2c3"><i class="fa fa-book" aria-hidden="true"></i></a>
                            <div class="iLmjWS">Member list</div>
                        </div>
                        <div class="ilqBSQ">
                            <a href="{{route('settings')}}" class="esp_icons" style="color: #004edc"><i class="fa fa-cog" aria-hidden="true"></i></a>
                            <div class="iLmjWS">Settings</div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-sticky-note text-orange" aria-hidden="true"></i>
                            Notice Board
                        </h3>
                    </div>
                    @foreach($notices as $notice)
                        <div class="card-row card-secondary">
                            <div class="card-warning card-outline">
                                <div class="card-header">
                                    <p class="text-sm">{{$notice->title}}</p>
                                    <span style="color: #0d626b">{{date('d-m-Y h:i A',strtotime($notice->created_at))}}<br> Posted by Admin</span>
                                </div>
                                <div class="card-body">
                                    <p>{!! $notice->notice !!}</p>
                                    <a href="">Read more</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @else
                <div class="col-md-6">
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
                                <div class="short_cut_icon"></div>
                                <div class="iLmjWS">Member</div>
                            </div>
                            <div class="ilqBSQ">
                                <div class="short_cut_icon"></div>
                                <div class="iLmjWS">Add customer</div>
                            </div>
                            <div class="ilqBSQ">
                                <div class="short_cut_icon"></div>
                                <div class="iLmjWS">Add customer</div>
                            </div>
                            <div class="ilqBSQ">
                                <div class="short_cut_icon"></div>
                                <div class="iLmjWS">Add customer</div>
                            </div>
                            <div class="ilqBSQ">
                                <div class="short_cut_icon"></div>
                                <div class="iLmjWS">Add customer</div>
                            </div>
                            <div class="ilqBSQ">
                                <div class="short_cut_icon"></div>
                                <div class="iLmjWS">Add customer</div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            @endrole

        </div>
        <div class="row">
            
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
@stop
