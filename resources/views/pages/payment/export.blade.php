@extends('main')
@section('style')
    .table td, .table th {
    padding: .2rem;
    }
@stop
@section('content')
    <div class="row">
        <div class="col-md-6  col-sm-12  col-xs-12  offset-lg-3 offset-xl-3">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="nav-icon fas fa-file-excel"></i> Export Payment Data to Excel</h3>
                </div>
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
                    <div class="alert alert-warning alert-dismissible mt-1">{{session('message')}}</div>
                @endif
            <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('payment-export')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">From Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('date_from') is-invalid @enderror" value="{{ old('date_from') }}" id="date_from" name="date_from" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">To Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('date_to') is-invalid @enderror" value="{{ old('date_to') }}" id="to_date" name="date_to" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="payment_type">Payment Type <span class="text-danger">*</span></label>
                                <select name="payment_type" id="" class="form-control" required>
                                    <option value="">--Select--</option>
                                    <option value="0">All</option>
                                    @foreach($payment_types as $payment_type)
                                        <option value="{{$payment_type->id}}" {{old('payment_type')==$payment_type->id?'selected':''}}>{{$payment_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer float-right">
                            <button type="submit" class="btn btn-success btn-xs"><b><i class="fa fa-download"></i> Download Excel</b></button>
                            <a href="{{route('payment-index')}}" class="btn btn-warning btn-xs"><b>Cancel</b></a>
                        </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop