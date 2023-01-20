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
                        <h5><i class="fa fa-users text-cyan" aria-hidden="true"></i> Donors</h5>
                        <a href="{{route('donor-index')}}" class="btn btn-xs btn-warning float-right mb-1 mr-1"><i class="fa fa-recycle"></i> Refresh </a>
                        <thead>
                        {{-- <tr>
                            <th colspan="5"><a class="btn btn-success" href="{{route('member-admission')}}">+</a></th>
                        </tr> --}}
                            <tr>
                                <th>#</th>
                                <th><div align="left">Name</div></th>
                                <th>Origin</th>
                                <th>Donor Type</th>
                                <th>Email</th>
                                <th>phone</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp
                        @foreach ($donors as $donor)
                            <tr>
                                <td>{{++$i}}</td>
                                <td><div align="left"><b>{{ucfirst($donor->name)}}</b></div></td>
                                <td>
                                    {{$donor->origin}}
                                </td>
                                <td>{{$donor->donor_type}}</td>
                                <td>{{$donor->email}}</td>
                                <td>{{$donor->phone}}</td>
                                <td>{{$donor->address}}</td>
                                <td>
                                    @if($donor->status!=-2)
                                        <a data-id="{{$donor->id}}" class="del_btn"><i class="fa fa-trash text-danger" title="Delete"></i></a>
                                    @endif
                                        <a href="{{route('donor-edit',$donor->id)}}" class=""><i class="fa fa-pen text-success" title="Edit"></i></a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        {{ $donors->links() }}
        <!-- /.card -->
        </div>
    </div>

    <form action="{{route('donor-delete')}}" method="POST" id="usr_del">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="delete" />
        <input type="hidden" name="donor_id" id="del_user_id"/>
    </form>
    <form action="{{route('user-status')}}" method="POST" id="usr_sts">
        {{ csrf_field() }}
        <input type="hidden" name="status" id="status">
        <input type="hidden" name="user_id" id="sts_user_id"/>
    </form>
@stop
@section('script')
    $('.del_btn').on('click',function(){
    let id=$(this).attr('data-id')
    $('#del_user_id').val(id)
    Swal.fire({
    title: 'Are you sure?',
    text: "Donor will be dumped!!",
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
    $('#usr_del').submit();
    }
    })
    })

    $('.status_change').on('click',function(){
    let id=$(this).attr('data-id')
    let status=$(this).attr('data-status')
    $('#sts_user_id').val(id)
    $('#status').val(status)
    Swal.fire({
    title: 'Are you sure?',
    text: "Donor account will be changed!!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes!'
    }).then((result) => {
    if (result.isConfirmed) {
    {{-- Swal.fire(
    'Deleted!',
    'Your file has been deleted.',
    'success'
    ) --}}
    $('#usr_sts').submit();
    }
    })
    })

@stop