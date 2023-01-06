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
                    <h3 class="card-title"><i class="fa fa-credit-card" aria-hidden="true"></i> Donation Details</h3>
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
                                        <strong>Name: {{$payment->donor->name}}</strong><br>
                                        <br>
                                        Phone: {{$payment->donor->mobile_number}}<br>
                                        Email: {{$payment->donor->email}}
                                    </address>
                                </div>

                                <div class="col-sm-4 invoice-col">

                                </div>

                                <div class="col-sm-4 invoice-col">
                                    <b>Payment No.:</b> 4F3S8J<br>
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
                                        <tbody>
                                        <tr>
                                            <td>Amount</td>
                                            <td><b>{{number_format($payment->amount,2,".",",")}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Payment Date</td>
                                            <td>{{date('d-m-Y',strtotime($payment->payment_date))}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p>{{$payment->remarks}}</p>
                            </div>
                            <div class="row no-print">
                                <div class="col-12">
                                    <a id="print" rel="noopener" onclick="window.print()" class="btn btn-default btn-xs"><i class="fas fa-print"></i> Print</a>
                                    @role('admin|super-admin')
                                    <a href="{{route('donation-index')}}" class="btn btn-primary btn-xs"><i class="fas fa-list"></i> View List</a>
                                    @if($payment->status==0)
                                        <button id="decline" type="button" class="btn btn-danger  btn-xs float-right" style="margin-right: 5px;">
                                            <i class="fas fa-times"></i> Decline
                                        </button>
                                        <button id="approve" type="button" class="btn btn-primary  btn-xs float-right" style="margin-right: 5px;">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    @elseif($payment->status==-1)
                                        <button id="revert" type="button" class="btn btn-warning  btn-xs float-right" style="margin-right: 5px;">
                                            <i class="fas fa-check"></i> Revert
                                        </button>
                                    @endif
                                    @else
                                        <a href="{{route('donation-index')}}" class="btn btn-primary btn-xs"><i class="fas fa-list"></i> View List</a>
                                        @endrole
                                        <form action="{{route('process-donation')}}" method="POST" id="process_payment_form">
                                            {{csrf_field()}}
                                            <input type="hidden" id="action_type" name="action_type">
                                            <input type="hidden" name="process_payment" value="{{$payment->id}}">
                                        </form>
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
    {{--<script>--}}
    $('#approve').on('click',function () {
    $('#action_type').val(1)

    Swal.fire({
    title: 'Are you sure?',
    text: "You want to approve this payment!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, approve it!'
    }).then((result) => {
    if (result.isConfirmed) {
    $('#process_payment_form').submit();
    }
    })

    });

    $('#decline').on('click',function () {
    $('#action_type').val(2)
    Swal.fire({
    title: 'Are you sure?',
    text: "You want to decline this payment!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, decline it!'
    }).then((result) => {
    if (result.isConfirmed) {
    $('#process_payment_form').submit();
    }
    })
    });


    $('#revert').on('click',function () {
    $('#action_type').val(3)

    Swal.fire({
    title: 'Are you sure?',
    text: "You want to revert this payment!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, revert it!'
    }).then((result) => {
    if (result.isConfirmed) {
    $('#process_payment_form').submit();
    }
    })
    })


    {{--</script>--}}
@stop