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

    fieldset {
    display: block;
    margin-left: 2px;
    margin-right: 2px;
    padding-top: 0.35em;
    padding-bottom: 0.625em;
    padding-left: 0.75em;
    padding-right: 0.75em;
    border: 2px groove (internal value);
    }
@stop
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-credit-card" aria-hidden="true"></i> Add New Bill</h3>
                    <a href="{{route('home')}}" class="btn btn-danger btn-xs float-right"> <i class="fa fa-times"></i></a>
                    <a href="{{route('payment-index')}}" class="btn btn-success btn-xs float-right mr-1"> <i class="fa fa-list"></i> Billing List</a>
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

                                <div class="icheck-primary">
                                    <input type="checkbox" name="payment_method"  {{old('payment_method')==1?"checked":""}} class="member_type"  id="mem1" value="1">
                                    <label for="mem1">
                                        Guest Bill
                                    </label>
                                </div>
                                <div class="form-group mt-3" style="">
                                    <label for=""><i class="fa fa-search" aria-hidden="true"></i> Search Member <span class="text-danger">*</span></label>
                                    <input autocomplete="off" type="text" class="form-control" placeholder="Type Member ID" id="member_search" required>
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

                            <h5 class="box-title text-purple">Lounge Bill</h5>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="amount">Amount <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" value="{{old('amount')}}"  name="amount" id="amount" required>
                                </div>
                            </div>
                            <h5 class="box-title text-purple">Restaurant Bill</h5>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="amount">Amount <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" value="{{old('amount')}}"  name="amount" id="amount" required>
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
                        <a href="" class="btn btn-warning btn-xs align-content-center mr-1" style="float: right"><i class="fa fa-spinner" aria-hidden="true"></i> Refresh</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('script_link')
    <script src="{{asset('js/member-search.js')}}"></script>
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