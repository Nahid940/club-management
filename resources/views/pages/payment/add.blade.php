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
    .exp_group{
        margin-bottom: 0rem!important;
    }
    .exp-form-control{
        height: calc(1.1rem);
    }
    #pay_row td{
        padding:0.3rem
    }
@stop
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3 col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-credit-card" aria-hidden="true"></i> Add New Payment</h3>
                    <a href="{{route('home')}}" class="btn btn-danger btn-xs float-right"> <i class="fa fa-times"></i></a>
                    <a href="{{route('payment-index')}}" class="btn btn-success btn-xs float-right mr-1"> <i class="fa fa-list"></i> Payment List</a>
                </div>
                @if(session('message'))
                    <div class="alert alert-success mt-1 mb-1">
                        {{session('message')}}
                    </div>
                @endif
                <form action="{{route('payment-add')}}" method="POST" id="form_submit">
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
                                @if(session('id'))
                                    <a href="{{route('payment-view',session('id'))}}" class="btn btn-xs btn-warning float-right mb-1">View Payment Details</a>
                                @endif
                                <div class="form-group" style="">
                                    <label for=""><i class="fa fa-search" aria-hidden="true"></i> Search Member <span class="text-danger">*</span></label>
                                    <input autocomplete="off" type="text" class="form-control" placeholder="Type Member ID" id="member_search" required>
                                    <input type="hidden" id="member_id" name="member_id">
                                </div>
                                <div class="suggestion-area hidden_area">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" value="{{old('date')}}" name="date" id="date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mr_no">Money Receipt No.</label>
                                    <input type="text" class="form-control" value="{{old('mr_no')}}" name="mr_no" id="date" placeholder="Money Receipt No." required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                 <a class="btn btn-xs btn-success float-right" id="add_new_row">Add Row</a>
                                 <table class="table" id="pay_row">
                                     <tr style="padding: 2px">
                                         <td>
                                             <div class="form-group exp_group">
                                                 {{--<label for="year">Year <span class="text-danger">*</span></label>--}}
                                                 <select name="year[]" id="year" class="form-control exp-form-control" required>
                                                     <option value="">--Year--</option>
                                                     @for($i=2018;$i<=2030;$i++)
                                                         <option value="{{$i}}" {{$i==date('Y')?'selected':''}}>{{$i}}</option>
                                                     @endfor
                                                 </select>
                                             </div>
                                         </td>
                                         <td>
                                             <div class="form-group exp_group">
                                                 {{--<label for="month">Month <span class="text-danger">*</span></label>--}}
                                                 <select name="month[]" id="month" class="form-control exp-form-control" required>
                                                     <option value="">--Month--</option>
                                                     <option value="1" {{ old('month')==1?"selected":"" }}>January</option>
                                                     <option value="2" {{ old('month')==2?"selected":"" }}>February</option>
                                                     <option value="3" {{ old('month')==3?"selected":"" }}>March</option>
                                                     <option value="4" {{ old('month')==4?"selected":"" }}>April</option>
                                                     <option value="5" {{ old('month')==5?"selected":"" }}>May</option>
                                                     <option value="6" {{ old('month')==6?"selected":"" }}>June</option>
                                                     <option value="7" {{ old('month')==7?"selected":"" }}>July</option>
                                                     <option value="8" {{ old('month')==8?"selected":"" }}>August</option>
                                                     <option value="9" {{ old('month')==9?"selected":"" }}>September</option>
                                                     <option value="10" {{ old('month')==10?"selected":"" }}>October</option>
                                                     <option value="11" {{ old('month')==11?"selected":"" }}>November</option>
                                                     <option value="12" {{ old('month')==12?"selected":"" }}>December</option>
                                                 </select>
                                             </div>
                                         </td>
                                         <td>
                                             <div class="form-group exp_group">
                                                 {{--<label for="amount">Amount <span class="text-danger">*</span></label>--}}
                                                 <input type="number" class="form-control exp-form-control" value="{{old('amount')}}"  name="amount[]" id="amount" placeholder="Amount" required>
                                             </div>
                                         </td>
                                     </tr>
                                 </table>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <label for="" class="mem_type">Payment Type: <span class="text-danger">*</span></label>
                                    <select name="payment_type" id="" class="form-control" required>
                                        <option value="">--Select--</option>
                                        @foreach($payment_types as $payment_type)
                                            <option value="{{$payment_type->id}}" {{old('payment_type')==$payment_type->id?'selected':''}}>{{$payment_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                                            <option value="{{$donation_purpose->id}}" {{old('purpose_id')==$donation_purpose->id?"selected":""}}>{{$donation_purpose->purpose}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <label for="" class="mem_type">Payment Method: <span class="text-danger">*</span></label>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="payment_method"  {{old('payment_method')==1?"checked":""}} class="member_type"  id="mem1" value="1">
                                        <label for="mem1">
                                            Pay Order
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="payment_method" {{old('payment_method')==2?"checked":""}} class="member_type"  id="mem2" value="2">
                                        <label for="mem2">
                                            Cash
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="payment_method" {{old('payment_method')==3?"checked":""}} class="member_type"  id="mem3" value="3">
                                        <label for="mem3">
                                            Cheque
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="payment_ref_no">Reference No. <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{old('payment_ref_no')}}"  name="payment_ref_no" id="payment_ref_no" placeholder="Reference No." required>
                                </div>
                            </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="remarks">Remarks</label>
                                        <input type="text" class="form-control" value="{{old('remarks')}}" name="remarks" id="remarks" placeholder="Remarks">
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary btn-xs align-content-center save_btn" style="float: right">Save</button>
                        <a href="{{route('payment-add')}}" class="btn btn-warning btn-xs align-content-center mr-1" style="float: right"><i class="fa fa-spinner" aria-hidden="true"></i> Refresh</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('script_link')
    <script src="{{asset('js/member-search.js')}}"></script>
    <script src="{{asset('js/pay_row.js')}}"></script>
@stop

@section('script')
    $("body").on("click", ".listitem", function () {
        let name=$(this).data('name');
        let id=$(this).data('id');
        $('#member_search').val(name);
        $('#member_id').val(id);
        $('.suggestion-area').addClass('hidden_area');
        $('.suggestion-area').html();
    });

    $('.save_btn').on('click',function(){
        Swal.fire({
            title: 'Do you want to save this data?',
            text: "Click on Yes to proceed",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {
            $('.save_btn').attr('disabled','disabled')
                $('#form_submit').submit();
            }
        })
    })

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
@stop