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
                                <input type="text" value="{{ request()->input('member_code') }}" class="form-control" id="member_code" name="member_code" placeholder="Member ID"/>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <input type="date" class="form-control" value="{{ request()->input('date') }}"  id="date" name="date" placeholder=""/>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <button type="submit" class="btn btn-primary search_btn">Search</button>
                            </div>
                        </div>
                    </form>
                    <a href="{{route('home')}}" class="btn btn-danger btn-xs mb-1 float-right ml-1"><i class="fa fa-window-close"></i> Close</a>
                    <a href="{{route('home')}}" class="btn btn-success btn-xs mb-1 float-right"><i class="fa fa-plus"></i> Add New Bill</a>
                    @if(session('message'))
                        <div class="alert alert-danger alert-dismissible"><i class="fa fa-trash" aria-hidden="true"></i> {{session('message')}}</div>
                    @endif
                    <table id="example2" class="table table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <td colspan="6">&nbsp;</td>
                                <td colspan="2" style="background-color: #eafbf8"><b>B & G Lounge</b></td>
                                <td colspan="2" style="background-color: #f7e3e9"><b>Cafe</b></td>
                                <td colspan="2">&nbsp;</td>

                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Bill No</th>
                                <th>Member Name</th>
                                <th>Member ID</th>
                                <th>Billing Date</th>
                                <th><div align="right" style="background-color: #eafbf8">Cash Amount</div></th>
                                <th><div align="right" style="background-color: #eafbf8">Card Amount</div></th>
                                <th><div align="right" style="background-color: #f7e3e9">Cash Amount</div></th>
                                <th><div align="right" style="background-color: #f7e3e9">Card Amount</div></th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = $bills->perPage() * ($bills->currentPage() - 1) + 1;
                        @endphp
                        @foreach($bills as $bill)
                            <tr>
                                <td>{{$i++}}</td>
                                <td><b>#{{$bill->id}}</b></td>
                                <td>{{$bill->member_name}}</td>
                                <td>{{$bill->member_code==0?"-":$bill->member_code}}</td>
                                <td>{{date('d-m-Y',strtotime($bill->date))}}</td>
                                <td><div align="right" style="background-color: #eafbf8">{{number_format($bill->lounge_cash_amount,0,'.',',')}}</div></td>
                                <td><div align="right" style="background-color: #eafbf8">{{number_format($bill->lounge_card_amount,0,'.',',')}}</div></td>
                                <td><div align="right" style="background-color: #f7e3e9">{{number_format($bill->restaurant_cash_amount,0,'.',',')}}</div></td>
                                <td><div align="right" style="background-color: #f7e3e9">{{number_format($bill->restaurant_card_amount,0,'.',',')}}</div></td>
                                <td>@if($bill->status==1) <span class="badge badge-success">Succeed</span> @else <span class="badge badge-danger">Failed</span> @endif</td>
                                <td>
                                    <a href="{{route('bill-view',$bill->id)}}" title="View"><i class="fa fa-eye text-success"></i></a>
                                    | <a href="{{route('bill-edit',$bill->id)}}" title="Edit"><i class="fa fa-pen text-info"></i></a> |
                                    <a title="Delete" class="delete" data-id="{{$bill->id}}"><i class="fa fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        {{$bills->links()}}
        <!-- /.card -->
        </div>
        <form action="{{route('bill-delete')}}" method="POST" id="payment_del">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="payment_id"/>
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