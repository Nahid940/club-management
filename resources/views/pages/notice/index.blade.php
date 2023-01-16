@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .table td, .table th {
    padding: .2rem;
    text-align:center;
    vertical-align: middle;
    }
    .action_button{
    font-weight: 400;
    padding: 0.2rem .2rem;
    font-size: 10px;
    border-radius: .3re
    }
    .form-control{
    height: calc(1.40rem);
    padding: .1rem 0.75rem;
    font-size:inherit
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
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="">
                        <div class="row search_frm">
                            <div class="col-2">
                                <input type="text" value="{{ request()->input('title') }}"  class="form-control" id="name" name="title" placeholder="Title"/>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary search_btn">Search</button>
                            </div>
                        </div>
                    </form>
                    <a href="{{route('home')}}" class="btn btn-danger btn-xs mb-1 float-right ml-1"><i class="fa fa-window-close"></i> Close</a>
                    <a href="{{route('notice-add')}}" class="btn btn-success btn-xs mb-1 float-right"><i class="fa fa-plus"></i> Add New</a>
                    <a href="{{route('notice-index')}}" class="btn btn-warning btn-xs mb-1 float-right mr-1"><i class="fa fa-spinner"></i> Refresh</a>
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
                        <div class="alert alert-danger alert-dismissible"><i class="fa fa-trash" aria-hidden="true"></i> {{session('message')}}</div>
                    @endif
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Posted by</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @foreach($notices as $notice)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$notice->title}}</td>
                                <td>{{date('d-m-Y',strtotime($notice->created_at))}}</td>
                                <td>{{!empty($notice->createdBy->name)?$notice->createdBy->name:""}}</td>
                                <td>
                                    <div class>
                                        <a href="{{route('notice-view',$notice->id)}}" title="View" type="button" class=" action_button">View </a>
                                        <button type="button" class="action_btn btn" data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item"><a type="button" href="{{route('notice-edit',$notice->id)}}" title="Edit" class="btn btn-info action_button"><i class="fas fa-edit"></i> Edit</a></li>
                                            <li class="dropdown-item"><a type="button" title="Delete" class="btn btn-danger action_button delete" data-id={{$notice->id}}><i class="fas fa-trash"></i> Delete</a></li>
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
            <!-- /.card -->
        </div>
        <form action="{{route('notice-delete')}}" method="POST" id="notice_id_form">
            {{ csrf_field() }}
            <input type="hidden" name="notice_id" id="notice_id"/>
        </form>
    </div>
@stop
@section('script')
    $('.delete').on('click',function(){
    let id=$(this).attr('data-id')
    $('#notice_id').val(id)
    Swal.fire({
    title: 'Are you sure?',
    text: "You want to delete this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
    $('#notice_id_form').submit();
    }
    })
    })

@stop