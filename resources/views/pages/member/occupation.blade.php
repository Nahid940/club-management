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
                        <h5><i class="fa fa-list text-cyan" aria-hidden="true"></i> Occupations</h5>
                        <a href="{{route('occupation-add')}}" class="btn btn-xs btn-success float-right mb-1"><i class="fa fa-plus"></i> Add New</a>
                        <a href="{{route('occupation-index')}}" class="btn btn-xs btn-warning float-right mb-1 mr-1"><i class="fa fa-recycle"></i> Refresh </a>
                        <thead>
                        {{-- <tr>
                            <th colspan="5"><a class="btn btn-success" href="{{route('member-admission')}}">+</a></th>
                        </tr> --}}
                            <tr>
                                <th>#</th>
                                <th>Occupation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp
                        @foreach ($occupations as $occupation)
                            <tr>
                                <td>{{++$i}}</td>
                                <td><div align="left"><b>{{ucfirst($occupation->occupation)}}</b></div></td>
                                <td>
                                    <a data-id="{{$occupation->id}}" href="{{route('occupation-edit',$occupation->id)}}" class="edit_btn"><i class="fa fa-pen text-success" title="Edit"></i></a>
                                    <a data-id="{{$occupation->id}}" class="del_btn"><i class="fa fa-trash text-danger" title="Delete"></i></a>
                                </td>
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

    <form action="{{route('occupation-delete')}}" method="POST" id="usr_del">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="delete" />
        <input type="hidden" name="id" id="occupation_id"/>
    </form>
@stop
@section('script')
    $('.del_btn').on('click',function(){
    let id=$(this).attr('data-id')
    $('#occupation_id').val(id)
    Swal.fire({
    title: 'Are you sure?',
    text: "Data will be deleted!!",
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
@stop