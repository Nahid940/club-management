@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')

@stop
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2 col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-credit-card" aria-hidden="true"></i> Payment Details</h3>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> Club Notredamians Bangladesh Ltd.
                                        <small class="float-right">Date: {{date('d-m-Y',strtotime($payment->payment_date))}}</small>
                                    </h4>
                                </div>

                            </div>

                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    Member Details
                                    <address>
                                        <strong>{{$payment->member->first_name}}</strong><br>
                                        {{$payment->member_member_code}}<br>
                                        <b>
                                            @if($payment->member->member_type==1)
                                                Donor Member
                                            @elseif($payment->member->member_type==2)
                                                Life Member
                                            @elseif($payment->member->member_type==3)
                                                NRB Member
                                            @else
                                                General Member
                                            @endif
                                        </b>
                                        <br>
                                        Phone: {{$payment->member->mobile_number}}<br>
                                        Email: {{$payment->member->email}}
                                    </address>
                                </div>

                                <div class="col-sm-4 invoice-col">

                                </div>

                                <div class="col-sm-4 invoice-col">
                                    <b>Payment No.:</b> 4F3S8J<br>
                                    <b>Payment Due:</b> {{date('d-m-Y',strtotime($payment->payment_date))}}<br>
                                    <b>Payment Method:
                                        @if($payment->payment_method==1)
                                            Pay Order
                                        @elseif($payment->payment_method==2)
                                            Cash
                                        @else
                                            Cheque
                                        @endif
                                    </b>
                                    </br>
                                    <b>Payment Status:
                                        @if($payment->status==1)
                                            <i class="fa fa-check text-success" aria-hidden="true"></i> Approved
                                        @elseif($payment->status==0)
                                            <i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i> Unapproved
                                        @else
                                            <i class="fa fa-times text-danger" aria-hidden="true"></i> Declined
                                        @endif</b>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Qty</th>
                                            <th>Product</th>
                                            <th>Serial #</th>
                                            <th>Description</th>
                                            <th>Subtotal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Call of Duty</td>
                                            <td>455-981-221</td>
                                            <td>El snort testosterone trophy driving gloves handsome</td>
                                            <td>$64.50</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Need for Speed IV</td>
                                            <td>247-925-726</td>
                                            <td>Wes Anderson umami biodiesel</td>
                                            <td>$50.00</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Monsters DVD</td>
                                            <td>735-845-642</td>
                                            <td>Terry Richardson helvetica tousled street art master</td>
                                            <td>$10.70</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Grown Ups Blue Ray</td>
                                            <td>422-568-642</td>
                                            <td>Tousled lomo letterpress</td>
                                            <td>$25.99</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-6">
                                    <p class="lead">Amount Due 2/22/2014</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody><tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>$250.30</td>
                                            </tr>
                                            <tr>
                                                <th>Tax (9.3%)</th>
                                                <td>$10.34</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping:</th>
                                                <td>$5.80</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>$265.24</td>
                                            </tr>
                                            </tbody></table>
                                    </div>
                                </div>

                            </div>


                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                        Payment
                                    </button>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Generate PDF
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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
@stop