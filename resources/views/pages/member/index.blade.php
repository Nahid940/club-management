@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .table{
        width:100%
    }
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
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <form action="">
                    <div class="row search_frm">
                        <div class="col-lg-2 col-sm-12">
                            {{-- <label for="name">Member Name</label> --}}
                            <input type="text" value="{{ request()->input('name') }}" class="form-control" id="name" name="name" placeholder="Member Name"/>
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            {{-- <label for="email">Email</label> --}}
                            <input type="text" value="{{ request()->input('email') }}" class="form-control" id="email" name="email" placeholder="Email"/>
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            {{-- <label for="mobile_number">Mobile Number</label> --}}
                            <input type="text" class="form-control" value="{{ request()->input('mobile_number') }}" id="mobile_number" name="mobile_number" placeholder="Mobile Number" require/>
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            {{-- <label>Member Type <span class="txt-info"></span></label> --}}
                            <select class="form-control" id="member_type" name="member_type">
                                <option value="">--Type Select--</option>
                                <option value="1" {{ request()->input('member_type') == 1 ? 'selected' : ''}}>Donor Member</option>
                                <option value="2" {{ request()->input('member_type') == 2 ? 'selected' : ''}}>Life Member</option>
                                <option value="3" {{ request()->input('member_type') == 3 ? 'selected' : ''}}>NRB Member</option>
                                <option value="4" {{ request()->input('member_type') == 4 ? 'selected' : ''}}>Genera Member</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            {{-- <label for="blood_group">Blood Group</label> --}}
                            <select class="form-control" id="blood_group" name="blood_group">
                                <option value="">--Bloog Group Select--</option>
                                <option value="A+" {{ request()->input('blood_group') == 'A+' ? 'selected' : ''}}>A+</option>
                                <option value="A-" {{ request()->input('blood_group') == 'A-' ? 'selected' : ''}}>A-</option>
                                <option value="AB+" {{ request()->input('blood_group') == 'AB+' ? 'selected' : ''}}>AB+</option>
                                <option value="AB-" {{ request()->input('blood_group') == 'AB-' ? 'selected' : ''}}>AB-</option>
                                <option value="O+" {{ request()->input('blood_group') == 'O+' ? 'selected' : ''}}>O+</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary search_btn">Search</button>
                        </div>
                    </div>
                </form>
                <a href="{{route('home')}}" class="btn btn-danger btn-xs mb-1 float-right ml-1"><i class="fa fa-window-close"></i> Close</a>
                <a href="{{route('member-admission')}}" class="btn btn-success btn-xs mb-1 float-right"><i class="fa fa-plus"></i> Add New</a>
                <a href="{{route('member-index')}}" class="btn btn-warning btn-xs mb-1 float-right mr-1"><i class="fa fa-spinner"></i> Refresh</a>
                <a href="{{route('new-applications-index')}}" class="btn btn-primary btn-xs mb-1 float-right mr-1"><i class="fa fa-paperclip"></i> Pending Applications</a>
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
                <table id="example2" class="table table-bordered table-hover table-responsive-sm">
                    <thead>
                        {{-- <tr>
                            <th colspan="5"><a class="btn btn-success" href="{{route('member-admission')}}">+</a></th>
                        </tr> --}}
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Member Type</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Blood Group</th>
                            <th>Registration Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($members as $member)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$member->first_name}}</td>
                                <td>
                                    @if($member->member_type==1)
                                        Donor Member
                                    @elseif($member->member_type==2)
                                        Life Member
                                    @elseif($member->member_type==3)
                                        NRB Member
                                    @else
                                        Genera Member
                                    @endif
                                </td>
                                <td>{{$member->mobile_number}}</td>
                                <td>{{$member->email}}</td>
                                <td>{{$member->blood_group}}</td>
                                <td>{{date('d-m-Y',strtotime($member->registration_date))}}</td>
                                <td>
                                    <div class>
                                        <a href="{{route('member-read',$member->id)}}" title="View" type="button" class=" action_button">View </a>
                                        <button type="button" class="action_btn btn" data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li class="dropdown-item"><a type="button" href="{{route('member-edit',$member->id)}}" title="Edit" class="btn btn-info action_button"><i class="fas fa-edit"></i> Edit</a></li>
                                          <li class="dropdown-item"><a type="button" title="Delete" class="btn btn-danger action_button delete" data-id={{$member->id}}><i class="fas fa-trash"></i> Delete</a></li>
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
        {{ $members->links() }}
        <!-- /.card -->
    </div>
    <form action="{{route('member-delete')}}" method="POST" id="member_del">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="delete" />
        <input type="hidden" name="member_id" id="member_id"/>
    </form>
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