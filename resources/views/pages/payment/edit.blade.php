@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .form-control{
    height: calc(1.40rem);
    padding: .1rem 0.75rem;
    border: 1px solid #b4bae2b5;
    font-size: 0.7rem;
    }
    .suggestion-area, .suggestion-area1 {
    position: absolute;
    width: 98%;
    background-color: #fff;
    z-index: 11;
    display: block;
    height: auto;
    margin-top:-16px
    }
    .search-item{
    border-bottom:1px solid #fff;
    }
    .suggestion-area .search-item, .suggestion-area1 .search-item, .suggestion-area2 .search-item {
    background-color: #0b64d4;
    color:#fff;
    padding: 5px;
    list-style: none;
    overflow: hidden;
    }
    .search-content{
    color:#fff
    }
    .search-item:hover{
    background-color: #1975e6;
    cursor:pointer
    }
    .hidden_area{
    display:none
    }
@stop
@section('content')
    <div class="row">

        <div class="col-md-6 offset-md-3 col-sm-12">
            @if(session('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    {{session('message')}}
                </div>
            @endif
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-credit-card" aria-hidden="true"></i> Edit Payment</h3>
                    <a href="{{route('home')}}" class="btn btn-danger btn-xs float-right"> <i class="fa fa-times"></i></a>
                    <a href="{{route('payment-index')}}" class="btn btn-success btn-xs float-right mr-1"> <i class="fa fa-list"></i> Payment List</a>
                </div>
                <form action="{{route('payment-update',$payment->id)}}" method="POST">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="form-group" style="">
                                    <label for=""><i class="fa fa-search" aria-hidden="true"></i> Search Member <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Type Member Name/Code" value="{{$payment->member->first_name." ".$payment->member->member_code}}" id="member_search" required>
                                    <input type="hidden" id="member_id"  value="{{$payment->member->id}}" name="member_id">
                                </div>
                                <div class="suggestion-area hidden_area">

                                </div>
                            </div>
                            <input type="hidden" value="{{$payment->id}}" name="payment_sl">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date" id="date"  value="{{$payment->payment_date}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mr_no">Money Receipt No.</label>
                                    <input type="text" class="form-control" value="{{$payment->mr_no}}" name="mr_no" id="date" placeholder="Money Receipt No." required>
                                </div>
                            </div>
                            @php
                                $count=1;
                            @endphp
                            <input type="hidden" value="{{count($payment_details)}}" id="total_payments">
                            <div class="col-md-12">
                                <a class="btn btn-xs btn-success float-right" id="add_new_row"><i class="fa fa-plus-circle"></i></a>
                                <table class="table" id="pay_row">
                                    @foreach($payment_details as $payment_detail)
                                    <tr style="padding: 2px">
                                        <td>{{$count++}}. </td>
                                        <td>
                                            <div class="form-group exp_group">
                                                {{--<label for="year">Year <span class="text-danger">*</span></label>--}}
                                                <select name="year[]" id="year" class="form-control exp-form-control" required>
                                                    <option value="">--Year--</option>
                                                    @for($i=2018;$i<=2030;$i++)
                                                        <option value="{{$i}}" {{$payment_detail->payment_year==$i?'selected':''}}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group exp_group">
                                                {{--<label for="month">Month <span class="text-danger">*</span></label>--}}
                                                <select name="month[]" id="month" class="form-control exp-form-control" required>
                                                    <option value="">--Month--</option>
                                                    <option value="1" {{$payment_detail->payment_month==1?"selected":"" }}>January</option>
                                                    <option value="2" {{$payment_detail->payment_month==2?"selected":"" }}>February</option>
                                                    <option value="3" {{$payment_detail->payment_month==3?"selected":"" }}>March</option>
                                                    <option value="4" {{$payment_detail->payment_month==4?"selected":"" }}>April</option>
                                                    <option value="5" {{$payment_detail->payment_month==5?"selected":"" }}>May</option>
                                                    <option value="6" {{$payment_detail->payment_month==6?"selected":"" }}>June</option>
                                                    <option value="7" {{$payment_detail->payment_month==7?"selected":"" }}>July</option>
                                                    <option value="8" {{$payment_detail->payment_month==8?"selected":"" }}>August</option>
                                                    <option value="9" {{$payment_detail->payment_month==9?"selected":"" }}>September</option>
                                                    <option value="10" {{ $payment_detail->payment_month==10?"selected":"" }}>October</option>
                                                    <option value="11" {{ $payment_detail->payment_month==11?"selected":"" }}>November</option>
                                                    <option value="12" {{ $payment_detail->payment_month==12?"selected":"" }}>December</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group exp_group">
                                                {{--<label for="amount">Amount <span class="text-danger">*</span></label>--}}
                                                <input type="number" class="form-control exp-form-control amount_val" value="{{$payment_detail->amount}}"  name="amount[]" id="amount" placeholder="Amount" required>
                                            </div>
                                        </td>
                                        <td><a class="btn btn-xs btn-danger ext_close_btn" data-id="{{$payment_detail->id}}">x</a></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <span>
                                <a class="mb-1 text-danger add_purpose ml-1" style="cursor: pointer"><i class="fa fa-hand-point-up"></i> Add Donation Purpose</a>
                                <a class="mb-1 text-danger close_purpose hidden_area ml-1" style="cursor: pointer"><i class="fa fa-times"></i> Close</a>
                            </span>
                            <div class="col-md-12 hidden_area" id="purpose_div">
                                <div class="form-group clearfix">
                                    <label for="" class="mem_type">Donation Purpose: </label>
                                    <select name="purpose_id" id="" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach($donation_purposes as $donation_purpose)
                                            <option value="{{$donation_purpose->id}}" {{$payment->purpose_id==$donation_purpose->id?"selected":""}}>{{$donation_purpose->purpose}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <label for="" class="mem_type">Payment Type: <span class="text-danger">*</span></label>
                                    <select name="payment_type" id="" class="form-control" required>
                                        <option value="">--Select--</option>
                                        @foreach($payment_types as $payment_type)
                                            <option value="{{$payment_type->id}}" {{$payment->payment_type==$payment_type->id?"selected":""}}>{{$payment_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <label for="" class="mem_type">Payment Method: <span class="text-danger">*</span></label>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="payment_method" class="member_type" {{$payment->payment_method==1?"checked":""}}  id="mem1" value="1">
                                        <label for="mem1">
                                            Pay Order
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="payment_method" class="member_type" {{$payment->payment_method==2?"checked":""}}  id="mem2" value="2">
                                        <label for="mem2">
                                            Cash
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="payment_method" class="member_type" {{$payment->payment_method==3?"checked":""}}  id="mem3" value="3">
                                        <label for="mem3">
                                            Cheque
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="payment_ref_no">Reference No. <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="payment_ref_no" id="payment_ref_no" value="{{$payment->payment_ref_no}}" placeholder="Reference No." required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <input type="text" class="form-control" name="remarks" value="{{$payment->remarks}}" id="remarks" placeholder="Remarks">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-xs align-content-center" style="float: right">Update</button>
                        <a href="{{route('payment-edit',$payment->id)}}" class="btn btn-warning btn-xs align-content-center mr-1" style="float: right"><i class="fa fa-spinner" aria-hidden="true"></i> Refresh</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <form action="{{route('paymentdetals-delete')}}" method="POST" id="payment_detls_del">
        {{ csrf_field() }}
        <input type="hidden" name="payment_details_id" id="payment_details_id"/>
    </form>
@stop
@section('script_link')
    <script src="{{asset('js/member-search.js')}}"></script>
    <script src="{{asset('js/pay_row.js')}}"></script>
    <script>
        $(document).on('click','.ext_close_btn',function () {
            let sl=$(this).data('id');
            $('#payment_details_id').val(sl);
            Swal.fire({
                title: '<div style="font-size:20px;font-weight:bold;">Do you want to delete this information?</div>',
                html: '<div style="font-size:10px">Your current information will be deleted!!</div>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0ba70c',
                cancelButtonColor: '#dd2900',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#payment_detls_del').submit();
                }
            });
        });


        $("body").on("click", ".listitem", function () {
            let name=$(this).data('name');
            let id=$(this).data('id');
            $('#member_search').val(name);
            $('#member_id').val(id);
            $('.suggestion-area').addClass('hidden_area');
            $('.suggestion-area').html();
        });

        $('.add_purpose').on('click',function(){
            $('#purpose_div').removeClass('hidden_area')
            $('.close_purpose').removeClass('hidden_area')
            $('.add_purpose').addClass('hidden_area')
        });

        $('.close_purpose').on('click',function(){
            $('#purpose_div').addClass('hidden_area')
            $('.close_purpose').addClass('hidden_area')
            $('.add_purpose').removeClass('hidden_area')
        });
    </script>
@stop

@section('script')

@stop