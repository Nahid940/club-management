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
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="nav-icon fas fa-cogs"></i> Update Donation Purpose</h3>
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
                <form action="{{route('purpose-update',$purpose->id)}}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{$purpose->id}}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Purpose Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('purpose') is-invalid @enderror" value="{{ $purpose->purpose }}" id="purpose" name="purpose" placeholder="Donation Purpose Title" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Donation For <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('donation_for') is-invalid @enderror" value="{{ $purpose->donation_for}}" id="donation_for" name="donation_for" placeholder="Donation for Person/Organization/Others" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer float-right">
                            <button type="submit" class="btn btn-success btn-xs"><b>Update</b></button>
                            <a href="{{route('home')}}" class="btn btn-warning btn-xs"><b>Cancel</b></a>
                            <a href="{{route('purpose-index')}}" class="btn btn-info btn-xs"><b>Go to List</b></a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop