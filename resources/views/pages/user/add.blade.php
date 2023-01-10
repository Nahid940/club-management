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
              @if(session('message'))
                 <div class="alert alert-success alert-dismissible">{{session('message')}}</div>
              @endif
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('user-save')}}" method="POST">
                {{ csrf_field() }}
                <div class="card-body">
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="name">Name <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name" placeholder="First Name">
                             </div>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="status" value="1">
                  <div class="form-group">
                    <label for="exampleInputPassword1">User role <span class="text-danger">*</span></label>
                      <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                          <option value="" selected="selected">---Select Role---</option>
                          <option value="1" {{old ('role_id') == '1' ? 'selected' : ''}}>Super Admin</option>
                          <option value="2" {{old ('role_id') == '2' ? 'selected' : ''}}>Admin</option>
                          <option value="4" {{old ('role_id') == '4' ? 'selected' : ''}}>Accountant</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Current status <span class="text-danger">*</span></label>
                      <select name="current_status" class="form-control  @error('current_status') is-invalid @enderror">
                        <option value="" selected="selected">--Select--</option>
                        <option value="active" {{old ('current_status') == 'active' ? 'selected' : ''}}>Active</option>
                        <option value="inactive" {{old ('current_status') == 'inactive' ? 'selected' : ''}}>Inactive</option>
                      </select>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                          </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="confirm_password" name="password_confirmation" placeholder="Confirm Password">
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