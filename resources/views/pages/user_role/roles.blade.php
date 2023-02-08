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
        <div class="col-sm-12 col-md-6 offset-md-3">
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
                        <h5><i class="fa fa-user text-cyan" aria-hidden="true"></i> Manage User Roles</h5>
                        <thead>
                        {{-- <tr>
                            <th colspan="5"><a class="btn btn-success" href="{{route('member-admission')}}">+</a></th>
                        </tr> --}}
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{ucfirst($role->name)}}</td>
                                <td>
                                    <div class>
                                        <button type="button" class="action_btn btn" data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item"><a  href="{{route('permission-index',[$role->id,$role->name])}}" title="Assign permission" class="btn btn-warning action_button"><i class="fa fa-check"></i> Permission</a></li>
                                            {{--<li class="dropdown-item"><a type="button" href="" title="Edit" class="btn btn-info action_button"><i class="fas fa-edit"></i> Edit</a></li>--}}
                                            {{--<li class="dropdown-item"><a type="button" title="Delete" class="btn btn-danger action_button delete" data-id={{$role->id}}><i class="fas fa-trash"></i> Delete</a></li>--}}
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        {{ $roles->links() }}
        <!-- /.card -->
        </div>
    </div>
@stop
@section('script')
    $('.delete').on('click',function(){
    let id=$(this).attr('data-id')
    $('#member_id').val(id)
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
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
    $('#member_del').submit();
    }
    })
    })

@stop