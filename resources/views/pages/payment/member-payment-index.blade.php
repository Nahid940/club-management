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
    }
    .search_frm{
        margin-bottom:.6rem
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
                                <input type="text" value="{{ request()->input('name') }}" class="form-control" id="name" name="name" placeholder="Transaction ID "/>
                            </div>
                            <div class="col-3">
                                <input type="date" value="{{ request()->input('email') }}" class="form-control" id="email" name="payment_date"/>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" value="{{ request()->input('mobile_number') }}" id="mobile_number" name="mobile_number" placeholder="Mobile Number" require/>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary search_btn"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
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
                                <th>Payment Type</th>
                                <th>Payment Date</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>TWERT</td>
                                <td>TETER</td>
                                <td>OOOO</td>
                                <td>DCVFGR</td>
                                <td>
                                    <a href="" title="View" type="button" class=" action_button">View </a>
                                    <button type="button" class="action_btn btn" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a type="button" href="" title="Edit" class="btn btn-info action_button btn-xs"><i class="fas fa-edit"></i> Edit</a></li>
                                        <li class="dropdown-item"><a type="button" title="Delete" class="btn btn-danger action_button delete btn-xs" data-id=""><i class="fas fa-trash"></i> Delete</a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        <!-- /.card -->
        </div>
    </div>
@stop