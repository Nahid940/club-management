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
    margin-top:0px
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
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-donate" aria-hidden="true"></i> Edit Donation</h3>
                    <a href="{{route('home')}}" class="btn btn-danger btn-xs float-right"> <i class="fa fa-times"></i></a>
                    <a href="{{route('donation-index')}}" class="btn btn-success btn-xs float-right mr-1"> <i class="fa fa-list"></i> Donation List</a>
                </div>
                <form action="{{route('donation-update')}}" method="POST">
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
                            @if(session('message'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                                    {{session('message')}}
                                </div>
                            @endif
                            <div class="col-md-12">
                                <label for=""><i class="fa fa-search" aria-hidden="true"></i> Search Donor <span class="text-danger">*</span></label>
                                <div class="input-group input-group-sm">
                                    <input autocomplete="off" type="text" value="{{$payment->donor->name}}" class="form-control" style="font-size: inherit" placeholder="Type Donor Name/Code" id="member_search" required>
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-info btn-btn-xs" id="add-donor" data-toggle="modal" data-target="#modal-default">Add New Donor</button>
                                    </span>
                                    <input type="hidden" value="{{$payment->donor->id}}" id="member_id" name="member_id">
                                </div>
                                <div class="suggestion-area hidden_area">

                                </div>
                            </div>
                            <input type="hidden" value="{{$payment->id}}" name="payment_sl">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" value="{{$payment->payment_date}}" name="date" id="date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" value="{{$payment->amount}}" name="amount" id="amount" required>
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
                                    <input type="text" class="form-control" value="{{$payment->payment_ref_no}}" name="payment_ref_no" id="payment_ref_no" placeholder="Reference No." required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <input type="text" class="form-control" value="{{$payment->remarks}}" name="remarks" id="remarks" placeholder="Remarks">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-xs align-content-center" style="float: right">Update</button>
                        <a href="{{route('donation-add')}}" class="btn btn-warning btn-xs align-content-center mr-1" style="float: right"><i class="fa fa-spinner" aria-hidden="true"></i> Refresh</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Donor Information</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="donor_data_form" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name"> Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Donor Name" name="name" id="name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="origin"> Origin</label>
                                    <input type="text" class="form-control" placeholder="Origin" name="origin" id="origin">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone">Mobile/Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Mobile/Phone" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="donor_type">Donor Type</label>
                                    <input type="text" class="form-control" placeholder="Donor Type" name="donor_type" id="donor_type">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="reference_person_name">Reference Person Name</label>
                                    <input type="text" class="form-control" placeholder="Reference Person Name" id="reference_person_name" name="reference_person_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="reference_person_phone">Reference Person Phone</label>
                                    <input type="text" class="form-control" placeholder="Reference Person Contact" id="reference_person_phone" name="reference_person_phone">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="reference_person_phone">Donor Address</label>
                                    <input type="text" class="form-control" placeholder="Donor Address" id="address" name="address">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-warning btn-xs" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-xs" id="save_donor">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('script_link')
    <script src="{{asset('js/donor-search.js')}}"></script>
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


@stop