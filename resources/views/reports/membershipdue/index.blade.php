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
                                <label for="profession" class="lbl_passing_year">Membership Type</label>
                                <select name="membership_type" id="membership_type" class="form-control">
                                    <option value="">--Select--</option>
                                    @foreach($member_types as $member_type)
                                        <option value="{{$member_type->id}}">{{$member_type->type_name}}</option>
                                    @endforeach
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
    <script src="{{asset('js/membershipdue-report.js')}}"></script>
@stop

