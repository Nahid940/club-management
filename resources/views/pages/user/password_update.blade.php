@extends('main')
@section('style')
    .table td, .table th {
        padding: .2rem;
    }
@stop
@section('content')
    <div class="row">
        <div class="col-md-6  offset-lg-3 offset-xl-3">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Update Password</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{route('password-update')}}" method="POST">
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
                        <div class="alert alert-danger">
                            {{session('message')}}
                        </div>
                    @endif
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Current Password *</label>
                            <div class="col-sm-9">
                                <input type="password" name="current_password" class="form-control" id="inputPassword3" placeholder="Password" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">New Password *</label>
                            <div class="col-sm-9">
                                <input type="password" name="new_password" class="form-control" id="inputPassword3" placeholder="New Password" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Confirm New Password *</label>
                            <div class="col-sm-9">
                                <input type="password" name="new_password_confirmation" class="form-control" id="inputPassword3" placeholder="Confirm New Password " required />
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{route('home')}}" class="btn btn-warning btn-xs">Cancel</a>
                        <button type="submit" class="btn btn-danger float-right btn-xs">Update</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
@stop