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
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fas fa-users"></i> Add new user</h3>
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
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('user-save')}}" method="POST">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">First Name *</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" placeholder="First Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email *</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Username *</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">User role *</label>
                      <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                          <option value="" selected="selected">---Select Role---</option>
                          <option value="1">Super Admin</option>
                          <option value="2">Admin</option>
                          <option value="3">Branch</option>
                          <option value="71">Support Analyst</option>
                          <option value="73">IT Officer</option>
                          <option value="74">Field Officer All</option>
                          <option value="75">Financial Report Reviewer</option>
                          <option value="76">Accountant (Field) New</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Current status *</label>
                      <select name="current_status" class="form-control  @error('current_status') is-invalid @enderror">
                        <option value="" selected="selected">--Select--</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                      </select>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password *</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                          </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password *</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="confirm_password" name="password_confirmation" placeholder="Confirm Password">
                          </div>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer float-right">
                  <button type="submit" class="btn btn-danger"><b>Save</b></button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
    </div>
@stop