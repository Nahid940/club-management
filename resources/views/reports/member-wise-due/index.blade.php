@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .table td, .table th {
    padding: .2rem;
    text-align:center;
    vertical-align: middle;
    }
    .action_button{
    font-weight: 400;
    padding: 0.2rem .2rem;
    font-size: 10px;
    border-radius: .3re
    }
    .form-control{
    height: calc(1.40rem);
    padding: .1rem 0.75rem;
    font-size:inherit
    }
    .search_btn{
    padding: .0rem .5rem;
    line-height: 1.3;
    }
    .search_frm{
    margin-bottom:.6rem
    }
    .action_btn{
    padding: 0.1rem .1rem
    }
    .report_div::-webkit-scrollbar {
    width: 5px;
    }
    .report_div::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    }
    .report_div::-webkit-scrollbar-thumb {
    background-color: #f1df8a;
    outline: 1px solid slategrey;
    }
    @media print{
    .report_div {
    height: 100% !important;
    width: 100% !important;
    display: inline-block;
    }
    .no-print, .no-print *
    {
    display: none !important;
    }
    }
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body no-print">
                    <form id="report_form">
                        <div class="row search_frm">
                            <div class="col-md-2 col-sm-12">
                                <label for="from_year" class="lbl_member"> Member</label>
                                <select name="member_id" id="member_id" class="form-control">
                                    <option value="">--Select Member--</option>
                                    @foreach($members as $member)
                                        <option value="{{$member->id}}">{{$member->first_name." (".$member->member_code.")"}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger member_span"></span>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="from_year" class="lbl_passing_year"> From Year</label>
                                <select name="from_year" id="from_year" class="form-control">
                                    @for($i=2016;$i<=2035;$i++)
                                        <option value="{{$i}}" {{$i==date('Y')?'selected':''}}>{{$i}}</option>
                                    @endfor
                                </select>
                                <span class="text-danger from_year"></span>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="from_month" class="lbl_passing_year"> From Month</label>
                                <select name="from_month" id="from_month" class="form-control">
                                    <option value="1" {{ date('m')==1?"selected":"" }}>January</option>
                                    <option value="2" {{ date('m')==2?"selected":"" }}>February</option>
                                    <option value="3" {{ date('m')==3?"selected":"" }}>March</option>
                                    <option value="4" {{ date('m')==4?"selected":"" }}>April</option>
                                    <option value="5" {{ date('m')==5?"selected":"" }}>May</option>
                                    <option value="6" {{ date('m')==6?"selected":"" }}>June</option>
                                    <option value="7" {{ date('m')==7?"selected":"" }}>July</option>
                                    <option value="8" {{ date('m')==8?"selected":"" }}>August</option>
                                    <option value="9" {{ date('m')==9?"selected":"" }}>September</option>
                                    <option value="10" {{ date('m')==10?"selected":"" }}>October</option>
                                    <option value="11" {{ date('m')==11?"selected":"" }}>November</option>
                                    <option value="12" {{ date('m')==12?"selected":"" }}>December</option>

                                </select>

                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="to_year" class="lbl_passing_year"> To Year</label>
                                <select name="to_year" id="to_year" class="form-control">
                                    @for($i=2016;$i<=2035;$i++)
                                        <option value="{{$i}}" {{$i==date('Y')?'selected':''}}>{{$i}}</option>
                                    @endfor
                                </select>
                                <span class="text-danger to_year"></span>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="to_month" class="lbl_passing_year"> To Month</label>
                                <select name="to_month" id="to_month" class="form-control">
                                    <option value="1" {{ date('m')==1?"selected":"" }}>January</option>
                                    <option value="2" {{ date('m')==2?"selected":"" }}>February</option>
                                    <option value="3" {{ date('m')==3?"selected":"" }}>March</option>
                                    <option value="4" {{ date('m')==4?"selected":"" }}>April</option>
                                    <option value="5" {{ date('m')==5?"selected":"" }}>May</option>
                                    <option value="6" {{ date('m')==6?"selected":"" }}>June</option>
                                    <option value="7" {{ date('m')==7?"selected":"" }}>July</option>
                                    <option value="8" {{ date('m')==8?"selected":"" }}>August</option>
                                    <option value="9" {{ date('m')==9?"selected":"" }}>September</option>
                                    <option value="10" {{ date('m')==10?"selected":"" }}>October</option>
                                    <option value="11" {{ date('m')==11?"selected":"" }}>November</option>
                                    <option value="12" {{ date('m')==12?"selected":"" }}>December</option>

                                </select>
                            </div>
                            <div class="col-2" style="margin-top: 19px;font-size: inherit">
                                <button type="button" class="btn btn-primary btn-xs" id="show-payment-report">View Report</button>
                                <a href="" class="btn btn-warning btn-xs" id="show-payment-report">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="report_div" style="width: 900px;height: 500px;overflow-y: scroll; margin: auto;background-color: #fff">
        <div class="" id="report_area" style="">
            <div class="loading" style="margin: 20% 45%;font-size:5rem;color: #71d2ef;"></div>
        </div>
    </div>
@stop
@section('script_link')
    <script src="{{asset('js/member-wise-due.js')}}"></script>
@stop

