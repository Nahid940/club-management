@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    @media print
    {
    .no-print, .no-print *
    {
    display: none !important;
    }
    }
@stop
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2 col-sm-12">
            <div class="card card-primary">
                @if(session('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-check"></i> {{session('message')}}
                    </div>
                @endif
                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-check"></i> {{session('warning')}}
                    </div>
                @endif
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-credit-card" aria-hidden="true"></i> Bill Details</h3>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> Club Notredamians Bangladesh Ltd.
                                        <small class="float-right">Date: {{date('d-m-Y',strtotime($bill->date))}}</small>
                                    </h4>
                                </div>
                            </div>

                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    Member Details
                                    <address>
                                        <strong>Name: {{$bill->member_name}}</strong><br>
                                        {{$bill->member_code==0?"":$bill->member_code}}<br>
                                    </address>
                                </div>

                                <div class="col-sm-4 invoice-col">

                                </div>

                                <div class="col-sm-4 invoice-col">
                                    <b>Bill No.:</b> #{{$bill->id}}
                                    <br>
                                    <b>Bill Status:
                                        @if($bill->status==1)
                                            <i class="fa fa-check text-success" aria-hidden="true"></i> Approved
                                        @elseif($bill->status==0)
                                            <i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i> Unapproved
                                        @else
                                            <i class="fa fa-times text-danger" aria-hidden="true"></i> Declined
                                        @endif</b>
                                    <br>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>Lounge Bill Amount</td>
                                            <td><b>{{number_format(($bill->lounge_cash_amount+$bill->lounge_card_amount),2,".",",")}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Restaurant Bill Amount</td>
                                            <td><b>{{number_format($bill->restaurant_cash_amount+$bill->restaurant_card_amount,2,".",",")}}</b></td>
                                        </tr>
                                        @php
                                            $total=$bill->lounge_cash_amount+$bill->lounge_card_amount+$bill->restaurant_cash_amount+$bill->restaurant_card_amount;
                                        @endphp
                                        <tr>
                                            <td>Total</td>
                                            <td><b>{{number_format(($total),2,".",",")}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Billing Date</td>
                                            <td>{{date('d-m-Y',strtotime($bill->date))}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p>{{$bill->remarks}}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop