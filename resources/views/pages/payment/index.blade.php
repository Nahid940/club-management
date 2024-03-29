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
    font-size: 10px;
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
    }
    .search_frm{
    margin-bottom:.6rem
    }
    .action_btn{
    padding: 0.1rem .1rem
    }
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="">
                        <div class="row search_frm">
                            <div class="col-lg-2 col-sm-12">
                                <input type="text" value="{{ request()->input('name') }}" class="form-control" id="name" name="name" placeholder="Member Name"/>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <input type="text" value="{{ request()->input('member_code') }}" class="form-control" id="member_code" name="member_code" placeholder="Member Code"/>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <input type="text" value="{{ request()->input('email') }}" class="form-control" id="email" name="email" placeholder="Email"/>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <input type="text" class="form-control" value="{{ request()->input('mobile_number') }}"  id="mobile_number" name="mobile_number" placeholder="Mobile Number"/>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <select class="form-control" id="purpose" name="purpose">
                                    <option value="">--Select Purpose--</option>
                                    @foreach($purposes as $purpose)
                                        <option value="{{$purpose->id}}" {{request()->input('purpose')==$purpose->id?"selected":""}}>{{$purpose->purpose}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <button type="submit" class="btn btn-primary search_btn">Search</button>
                            </div>
                        </div>
                    </form>
                    <a href="{{route('home')}}" class="btn btn-danger btn-xs mb-1 float-right ml-1"><i class="fa fa-window-close"></i> Close</a>
                    <a href="{{route('payment-add')}}" class="btn btn-success btn-xs mb-1 float-right"><i class="fa fa-plus"></i> Add New</a>
                    <a href="{{route('payment-index')}}" class="btn btn-warning btn-xs mb-1 float-right mr-1"><i class="fa fa-spinner"></i> Refresh</a>
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
                        <div class="alert alert-danger alert-dismissible"><i class="fa fa-trash" aria-hidden="true"></i> {{session('message')}}</div>
                    @endif
                    <table id="example2" class="table table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Member Name</th>
                                <th>Member Code</th>
                                <th>Payment Date</th>
                                <th>Payment Method</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = $payments->perPage() * ($payments->currentPage() - 1) + 1;
                        @endphp
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$payment->member->first_name}}</td>
                                    <td>{{$payment->member->member_code}}</td>
                                    <td>{{date('d-m-Y',strtotime($payment->payment_date))}}</td>
                                    <td>
                                        @if($payment->payment_method==1)
                                            Pay Order
                                        @elseif($payment->payment_method==2)
                                            Cash
                                        @else
                                            Cheque
                                        @endif
                                    </td>
                                    <td><div align="right">{{number_format($payment->amount,2,".",",")}}</div></td>
                                    <td>
                                        @if($payment->status==0)
                                            <span class="badge badge-danger"><i class="fa fa-exclamation-triangle"></i> Unapproved</span>
                                        @elseif($payment->status==1)
                                            <span class="badge badge-success"><i class="fa fa-check"></i> Approved</span>
                                        @elseif($payment->status==-1)
                                            <span class="badge badge-warning"><i class="fa fa-times"></i> Declined</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class>
                                            <a href="{{route('payment-view',$payment->id)}}" title="View" type="button" class=" action_button">View </a>
                                            <button type="button" class="action_btn btn" data-toggle="dropdown">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </button>
                                            @if($payment->status!=1)
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item"><a type="button" href="{{route('payment-edit',$payment->id)}}" title="Edit" class="btn btn-info action_button"><i class="fas fa-edit"></i> Edit</a></li>
                                                    <li class="dropdown-item"><a type="button" title="Delete" class="btn btn-danger action_button delete" data-id={{$payment->id}}><i class="fas fa-trash"></i> Delete</a></li>
                                                </ul>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        {{$payments->links()}}
        <!-- /.card -->
        </div>
        <form action="{{route('payment-delete')}}" method="POST" id="payment_del">
            {{ csrf_field() }}
            <input type="hidden" name="payment_id" id="payment_id"/>
        </form>
    </div>
@stop
@section('script')
    $('.delete').on('click',function(){
    let id=$(this).attr('data-id')
    $('#payment_id').val(id)
    Swal.fire({
    title: 'Are you sure?',
    text: "You want to delete this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
    {{-- Swal.fire(
    'Deleted!',
    'Your file has been deleted.',
    'success'
    ) --}}
    $('#payment_del').submit();
    }
    })
    })

@stop