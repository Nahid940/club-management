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
                        <h5><i class="fa fa-cogs text-cyan" aria-hidden="true"></i> Donation Purposes</h5>
                        <a href="{{route('purpose-add')}}" class="btn btn-xs btn-success float-right mb-1"><i class="fa fa-plus"></i> Add New</a>
                        <a href="{{route('purpose-index')}}" class="btn btn-xs btn-warning float-right mb-1 mr-1"><i class="fa fa-recycle"></i> Refresh </a>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><div align="left">Purpose Title</div></th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp
                        @foreach ($purposes as $purpose)
                            <tr @if($purpose->status==0) style="background-color: #ffb1ba"@endif>
                                <td>{{++$i}}</td>
                                <td><div align="left"><b>{{ucfirst($purpose->purpose)}}</b></div></td>
                                <td>{{date('d-m-Y',strtotime($purpose->created_at))}}</td>
                                <td>
                                    @if($purpose->status==1)
                                        <i class="fa fa-check text-green" title="Active"></i>
                                    @elseif($purpose->status==0)
                                        <i class="fa fa-times text-danger" title="Inactive"></i>
                                    @endif
                                </td>
                                <td>
                                    <a data-id="{{$purpose->id}}" style="cursor: pointer" class="del_btn"><i class="fa fa-trash text-danger" title="Delete"></i></a>
                                    <a data-id="{{$purpose->id}}" href="{{route('purpose-edit',[$purpose->id])}}" style="cursor: pointer"><i class="fa fa-pen text-success" title="Edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        {{ $purposes->links() }}
        <!-- /.card -->
        </div>
    </div>

    <form action="{{route('purpose-delete')}}" method="POST" id="usr_del">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="delete" />
        <input type="hidden" name="id" id="del_user_id"/>
    </form>
@stop
@section('script')
    $('.del_btn').on('click',function(){
    let id=$(this).attr('data-id')
    $('#del_user_id').val(id)
    Swal.fire({
    title: 'Are you sure?',
    text: "Purpose will be deleted!!",
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
    text: "Type be changed!!",
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