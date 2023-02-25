@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .table td, .table th {
    padding: .2rem;
    text-align:center;
    }
    .action_button{
    font-weight: 400;
    padding: 0.2rem .2rem;
    font-size: .7rem;
    border-radius: .3re
    }
    .form-control{
    height: calc(1.40rem);
    padding: .1rem 0.75rem;
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
        <div class="col-sm-12 col-md-8 offset-md-2">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
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
                        <h5><i class="fa fa-credit-card text-cyan" aria-hidden="true"></i> Membership Fees</h5>
                        {{--<a href="" class="btn btn-xs btn-success float-right mb-1"><i class="fa fa-plus"></i> Add New</a>--}}
                        <a href="{{route('membership-fees')}}" class="btn btn-xs btn-warning float-right mb-1 mr-1"><i class="fa fa-recycle"></i> Refresh </a>
                        <thead>
                        {{-- <tr>
                            <th colspan="5"><a class="btn btn-success" href="{{route('member-admission')}}">+</a></th>
                        </tr> --}}
                            <tr>
                                <th>#</th>
                                <th><div align="left">Membership Type</div></th>
                                <th>Membership Fee</th>
                                <th>Monthly Fee</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @foreach ($fees as $fee)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$fee->type_name}}</td>
                                <td>{{$fee->admission_fee}}</td>
                                <td>{{$fee->monthly_fee}}</td>
                                <td><a href="{{route('fee-edit',$fee->id)}}" class="del_btn"><i class="fa fa-pen text-success" title="Edit"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        <!-- /.card -->
        </div>
    </div>
@stop