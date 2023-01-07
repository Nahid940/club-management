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
                        <h5><i class="fa fa-user text-cyan" aria-hidden="true"></i> Member Classifications</h5>
                        <a data-toggle="modal" data-target="#modal-default" class="btn btn-xs btn-warning float-right mb-2"> <i class="fa fa-plus"></i> Add New</a>
                        <thead>
                        {{-- <tr>
                            <th colspan="5"><a class="btn btn-success" href="{{route('member-admission')}}">+</a></th>
                        </tr> --}}
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp
                        @foreach ($classifications as $classification)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{ucfirst($classification->name)}}</td>
                                <td>
                                    <div class>
                                        <button type="button" class="action_btn btn" data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item"><a type="button" href="{{route('classification-edit',$classification->id)}}" title="Edit" class="btn btn-info action_button"><i class="fas fa-edit"></i> Edit</a></li>
                                            <li class="dropdown-item"><a type="button" title="Delete" class="btn btn-danger action_button delete" data-id={{$classification->id}}><i class="fas fa-trash"></i> Delete</a></li>
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
        {{ $classifications->links() }}
        <!-- /.card -->
        </div>
        <form action="{{route('classification-delete')}}" method="POST" id="class_del">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="delete" />
            <input type="hidden" name="id" id="id"/>
        </form>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Classification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="classification_form" method="POST" action="{{route('classification-new')}}">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name"> Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Classification Name" name="name" id="name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-warning btn-xs" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-xs" id="save_classification">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('script')
    $('#save_classification').on('click',function(){
    let id=$(this).attr('data-id')
    $('#member_id').val(id)
    Swal.fire({
        title: 'Do you want to add this?',
        text: "This data will be saved!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
        }).then((result) => {
        if (result.isConfirmed) {
            $('#classification_form').submit();
            }
        })
    })

    $('.delete').on('click',function(){
    let id=$(this).attr('data-id')
    $('#id').val(id)
    Swal.fire({
        title: 'Do you want to delete this?',
        text: "This data will be deleted!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#class_del').submit();
            }
        })
    })

@stop