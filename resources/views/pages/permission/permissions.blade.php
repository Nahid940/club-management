@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .table td, .table th {
        padding: .1rem;
        text-align:center;
        font-size:12px;
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
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cogs"></i>
                        Assign Permission for {{ucfirst($role_name)}}
                    </h3>
                </div>
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
                        <div class="alert alert-success alert-dismissible">{{session('message')}}</div>
                    @endif
                    @role('admin|super-admin')
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Permission</th>
                                    <th>View</th>
                                    <th>Add</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>Execute</th>
                                </tr>
                            </thead>
                            @php $i=0; @endphp
                            <tbody>
                                <form action="{{route('permission-assign')}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="role_id" value="{{$role_id}}"/>
                                    <input type="hidden" name="role_name" value="{{$role_name}}"/>
                                    <tr>
                                        @foreach($permissions as $module_name=>$permission)
                                            <td colspan="7" style="background-color: #a2ddff"><div align="left"><b>{{ucfirst($module_name)}}</b></div></td>
                                            @foreach($permission as $prmsn)
                                            <tr>
                                                <td><div align="left">{{++$i}}</div></td>
                                                <td><div align="left">{{ucfirst($prmsn['name'])}}</div></td>
                                                <td width="40px">@if($prmsn['action']=='view')<input  name="permissions[]"  type="checkbox" value="{{$prmsn['id']}}" @if(isset($role_permissions[$prmsn['id']])) checked @endif >@else - @endif</td>
                                                <td width="40px">@if($prmsn['action']=='add' || $prmsn['action']=='approve')<input name="permissions[]" @if(isset($role_permissions[$prmsn['id']])) checked @endif  type="checkbox" value="{{$prmsn['id']}}">@else - @endif</td>
                                                <td width="40px">@if($prmsn['action']=='edit')<input  name="permissions[]" type="checkbox" value="{{$prmsn['id']}}" @if(isset($role_permissions[$prmsn['id']])) checked @endif>@else - @endif</td>
                                                <td width="40px">@if($prmsn['action']=='delete' || $prmsn['action']=='decline')<input  name="permissions[]" type="checkbox" value="{{$prmsn['id']}}" @if(isset($role_permissions[$prmsn['id']])) checked @endif>@else - @endif</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            @endforeach
                                        @endforeach
                                     </tr>
                                    <tr>
                                        <td colspan="5" style="border: none">&nbsp;</td>
                                        <td style="border: none"><a href="{{route('home')}}" class="btn btn-danger btn-xs">Cancel</a></td>
                                        <td style="border: none"><button type="submit" href="" class="btn btn-success btn-xs">Save</button></td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>
                    @endrole
                </div>
                <!-- /.card-body -->
            </div>
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