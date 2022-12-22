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
                    <h3 class="card-title"><i class="fa fa-credit-card" aria-hidden="true"></i> Add New Payment</h3>
                </div>
                <form>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="">
                                    <label for=""><i class="fa fa-search" aria-hidden="true"></i> Search Member</label>
                                    <input type="text" class="form-control" placeholder="Type Member Name/Code" id="member">
                                </div>
                                <div class="suggestion-area hidden_area">
                                    <li class="search-item listitem" data-code="3839" data-title="Kemei KM-1873 Blackhead Remover Pore Vacuum">
                                        <a href="show/Kemei-KM-1873-Blackhead-Remover-Pore-Vacuum/3839">
                                            <div class="title-name">
                                                <div class="search-content">
                                                    <span class="content-title">Name: Kemei KM-1873 Blackhead Remover Pore Vacuum</span><br>
                                                    <span>Email: s@mail.com</span><br>
                                                    <span>ID: 52345243</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="search-item listitem" data-code="3839" data-title="Kemei KM-1873 Blackhead Remover Pore Vacuum">
                                        <a href="show/Kemei-KM-1873-Blackhead-Remover-Pore-Vacuum/3839">
                                            <div class="title-name">
                                                <div class="search-content">
                                                    <span class="content-title">Kemei KM-1873 Blackhead Remover Pore Vacuum</span><br>
                                                    <span>s@mail.com</span><br>
                                                    <span>52345243</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="search-item listitem" data-code="3839" data-title="Kemei KM-1873 Blackhead Remover Pore Vacuum">
                                        <a href="show/Kemei-KM-1873-Blackhead-Remover-Pore-Vacuum/3839">
                                            <div class="title-name">
                                                <div class="search-content">
                                                    <span class="content-title">Kemei KM-1873 Blackhead Remover Pore Vacuum</span><br>
                                                    <span>s@mail.com</span><br>
                                                    <span>52345243</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="date" class="form-control" name="date" id="date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input type="number" class="form-control" name="amount" id="email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <label for="" class="mem_type">Payment Method: <span class="txt-info">*</span></label>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="pay_order" class="member_type"  id="mem1" value="1">
                                        <label for="mem1">
                                            Pay Order
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="cash" class="member_type"  id="mem2" value="2">
                                        <label for="mem2">
                                            Cash
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="cheque" class="member_type"  id="mem3" value="3">
                                        <label for="mem3">
                                            Cheque
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="payment_ref_no">Reference No.</label>
                                    <input type="text" class="form-control" name="payment_ref_no" id="payment_ref_no" placeholder="Reference No.">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-xs align-content-center" style="float: right">Save</button>
                        <a href="{{route('payment-index')}}" class="btn btn-warning btn-xs align-content-center mr-1" style="float: right"><i class="fa fa-spinner" aria-hidden="true"></i> Refresh</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop