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
                    <h3 class="card-title"><i class="nav-icon fas fa-credit-card"></i> Add Fees</h3>
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
                    <div class="alert alert-success alert-dismissible mt-1">{{session('message')}}</div>
            @endif
            <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('membership-fees-add')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Membership Type Name<span class="text-danger">*</span></label>
                                    <select name="membership_type_id" id="" class="form-control" required>
                                        <option value="">--Select--</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="admission_fee">Membership Fee <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{old('admission_fee')}}" id="admission_fee" name="admission_fee" placeholder="Membership Fee">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="monthly_fee">Monthly Fee <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{old('monthly_fee')}}" id="monthly_fee" name="monthly_fee" placeholder="Monthly Fee">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="monthly_fee">Opening Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" value="{{old('opening_date')}}" id="monthly_fee" name="opening_date" placeholder="Monthly Fee">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer float-right">
                            <button type="submit" class="btn btn-danger btn-xs"><b>Save</b></button>
                            <a href="{{route('home')}}" class="btn btn-warning btn-xs"><b>Cancel</b></a>
                        </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop