@extends('main')
@section('pageHeading'){{$title}}@stop
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-credit-card" aria-hidden="true"></i> Add New Bill</h3>
                    <a href="{{route('home')}}" class="btn btn-danger btn-xs float-right"> <i class="fa fa-times"></i></a>
                    <a href="{{route('bill-index')}}" class="btn btn-success btn-xs float-right mr-1"> <i class="fa fa-list"></i> Billing List</a>
                </div>
                @if(session('message'))
                    <div class="alert alert-success mt-1 mb-1">
                        {{session('message')}}
                    </div>
                @endif
                <form action="{{route('bill-add')}}" method="POST" id="form_submit">
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
                            <span id="sv_btn" class="text-danger text-lg"></span>
                            <div class="col-md-12">
                                @if(session('id'))
                                    <a href="{{route('payment-view',session('id'))}}" class="btn btn-xs btn-warning float-right mb-1">View Payment Details</a>
                                @endif

                                <div class="icheck-primary">
                                    <input type="checkbox" name="guest_bill"  {{old('guest_bill')==1?"checked":""}} class="guest_bill"  id="guest_bill" value="1">
                                    <label for="guest_bill">
                                        Guest Bill
                                    </label>
                                </div>
                                <div class="form-group mt-3" style="">
                                    <label for=""><i class="fa fa-search" aria-hidden="true"></i> <span id="search_title">Search Member</span> <span class="text-danger">*</span></label>
                                    <input autocomplete="off" type="text" class="form-control member_search" name="person_name" placeholder="Type Member ID" id="member_search" required>
                                    <input type="hidden" id="member_id" name="member_id">
                                </div>
                                <div class="suggestion-area hidden_area">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="date">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" value="{{empty(old('date'))?date('Y-m-d'):old('date')}}" name="date" id="date" required>
                                </div>
                            </div>

                            <div class="col-md-12"><p class="text-purple" style="font-size: 14px;border-bottom: 1px dashed gray;font-weight: bold">LOUNGE Bill</p></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lounge_cash_amount">Cash Amount <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" value="{{empty(old('lounge_cash_amount'))?0:old('lounge_cash_amount')}}"  name="lounge_cash_amount" id="lounge_cash_amount" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lounge_card_amount">Card Amount <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" value="{{empty(old('lounge_card_amount'))?0:old('lounge_card_amount')}}"  name="lounge_card_amount" id="lounge_card_amount" required>
                                </div>
                            </div>
                            <div class="col-md-12"><p class="text-purple" style="font-size: 14px;border-bottom: 1px dashed gray;font-weight: bold">CAFE Bill</p></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="restaurant_cash_amount">Cash Amount <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" value="{{empty(old('restaurant_cash_amount'))?0:old('restaurant_cash_amount')}}"  name="restaurant_cash_amount" id="restaurant_cash_amount" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="restaurant_card_amount">Card Amount <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" value="{{empty(old('restaurant_card_amount'))?0:old('restaurant_card_amount')}}"  name="restaurant_card_amount" id="restaurant_card_amount" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="payment_ref_no">Reference No.</label>
                                    <input type="text" class="form-control" value="{{old('payment_ref_no')}}"  name="payment_ref_no" id="payment_ref_no" placeholder="Reference No." required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <input type="text" class="form-control" value="{{old('remarks')}}" name="remarks" id="remarks" placeholder="Remarks">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary btn-xs align-content-center save_btn" style="float: right">Save</button>
                        <a href="" class="btn btn-warning btn-xs align-content-center mr-1" style="float: right"><i class="fa fa-spinner" aria-hidden="true"></i> Refresh</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-calculator" aria-hidden="true"></i> Bill Summery</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <td class="text-lg" style="width: 150px"><b>Lounge Bill</b></td>
                            <td>:</td>
                            <td class="text-lg"><b><span id="lounge_bill_amnt">0</span></b></td>
                            <td class="text-lg">/-</td>
                        </tr>
                        <tr>
                            <td class="text-lg" style="width: 180px"><b>Cafe Bill</b></td>
                            <td>:</td>
                            <td class="text-lg"><b><span id="restaurant_bill_amnt">0</span></b></td>
                            <td class="text-lg">/-</td>
                        </tr>
                        <tr style="background-color: #dcefff">
                            <td class="text-lg" style="width: 150px"> <b>Total</b></td>
                            <td>:</td>
                            <td class="text-lg"><b><span id="ttl_amnt">0</span></b></td>
                            <td class="text-lg">/-</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script_link')
    <script src="{{asset('js/search-member-on-billing.js')}}"></script>
    <script src="{{asset('js/bill.js')}}"></script>
@stop

@section('script')


@stop