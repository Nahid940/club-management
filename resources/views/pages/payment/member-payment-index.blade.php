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
        height: calc(1.40rem);
        padding: .1rem 0.75rem;
        font-size:inherit
    }
    .search_frm{
        margin-bottom:.6rem;
    }
    .action_btn{
        padding: 0.1rem .1rem;
    }
    .action_button{
        font-weight: 400;
        padding: 0.2rem .2rem;
        font-size: .7rem;
        border-radius: .3re
    }
@stop
@section('content')
    <div class="row">
        <div class="col-md-8 col-sm-12 offset-md-2">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <h6><i class="fa fa-list text-danger" aria-hidden="true"></i> Payment Statements</h6>
                    <form action="">
                        <div class="row search_frm">
                            <div class="col-3">
                                <input type="text" value="{{ request()->input('trx_id') }}" class="form-control" id="name" name="trx_id" placeholder="Transaction ID "/>
                            </div>
                            <div class="col-3">
                                <input type="date" value="{{ request()->input('payment_date') }}" class="form-control" id="payment_date" name="payment_date"/>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary search_btn"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                            </div>
                            <div class="col-2">
                                <a href="{{route('member-payment-index')}}" class="btn btn-warning search_btn"><i class="fa fa-recycle" aria-hidden="true"></i> Reload</a>
                            </div>
                        </div>
                    </form>
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
                        <div class="alert alert-danger alert-dismissible">{{session('message')}}</div>
                    @endif
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Transaction ID</th>
                                <th>Payment Method</th>
                                <th>Payment Date</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$payment->id}}</td>
                                    <td>
                                        @if($payment->payment_method==1)
                                            <span class="badge badge-info">Pay Order</span>
                                        @elseif($payment->payment_method==2)
                                            <span class="badge badge-info">Cash</span>
                                        @else
                                            <span class="badge badge-info">Cheque</span>
                                        @endif
                                    </td>
                                    <td>{{date('d-m-Y',strtotime($payment->payment_date))}}</td>
                                    <td><div align="right">{{$payment->amount}}</div></td>
                                    <td>
                                        <button type="button" class="action_btn btn" data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item">
                                                <a href="{{route('member-payment-view',$payment->id)}}" title="View" type="button" class="btn btn-xs btn-success action_button">View </a>
                                            </li>
                                            {{--<li class="dropdown-item"><a type="button" title="Delete" class="btn btn-danger action_button delete btn-xs" data-id=""><i class="fas fa-trash"></i> Delete</a></li>--}}
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        {{ $payments->links() }}
        <!-- /.card -->
        </div>
    </div>
@stop