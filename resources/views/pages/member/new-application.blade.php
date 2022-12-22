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
    .item_hide{
        display:none
    }
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <h5> <i class="fa fa-user-plus text-danger" aria-hidden="true"></i> New Membership Applications</h5>
                    <form action="">
                        <div class="row search_frm">
                            <div class="col-2">
                                {{-- <label for="name">Member Name</label> --}}
                                <input type="text" value="{{ request()->input('name') }}" class="form-control" id="name" name="name" placeholder="Member Name"/>
                            </div>
                            <div class="col-2">
                                {{-- <label for="email">Email</label> --}}
                                <input type="text" value="{{ request()->input('email') }}" class="form-control" id="email" name="email" placeholder="Email"/>
                            </div>
                            <div class="col-2">
                                {{-- <label for="mobile_number">Mobile Number</label> --}}
                                <input type="text" class="form-control" value="{{ request()->input('mobile_number') }}" id="mobile_number" name="mobile_number" placeholder="Mobile Number" require/>
                            </div>
                            <div class="col-2">
                                {{-- <label>Member Type <span class="txt-info"></span></label> --}}
                                <select class="form-control" id="member_type" name="member_type">
                                    <option value="">--Type Select--</option>
                                    <option value="1" {{ request()->input('member_type') == 1 ? 'selected' : ''}}>Donor Member</option>
                                    <option value="2" {{ request()->input('member_type') == 2 ? 'selected' : ''}}>Life Member</option>
                                    <option value="3" {{ request()->input('member_type') == 3 ? 'selected' : ''}}>NRB Member</option>
                                    <option value="4" {{ request()->input('member_type') == 4 ? 'selected' : ''}}>Genera Member</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary search_btn">Search</button>
                            </div>
                        </div>
                    </form>
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
                        <div class="alert alert-info alert-dismissible"><i class="fa fa-check-square" aria-hidden="true"></i> {{session('message')}}</div>
                    @endif
                    <button class="btn btn-success btn-xs m-1 item_hide" id="approve_all_btn"><i class="fa fa-check-square" aria-hidden="true"></i> Approve All</button>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><input type="checkbox" id="check_all"></th>
                                <th>Name</th>
                                <th>Member Type</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Registration Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp
                            <form action="{{route('approve-all-applications')}}" method="POST" id="approve_all">
                                {{csrf_field()}}
                                @foreach ($members as $member)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td><input type="checkbox" name="id[]" value="{{$member->id}}" id="id_sl{{$i}}"></td>
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
                                        <td>{{date('d-m-Y',strtotime($member->registration_date))}}</td>
                                        <td>
                                            <div class>
                                                <a href="{{route('new-member-read',$member->id)}}" title="View" type="button" class=" action_button">Process </a>
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
                            </form>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        {{ $members->links() }}
        <!-- /.card -->
        </div>
    </div>
@stop
@section('script')

        $('#approve_all_btn').on('click',function(){
            let id=$(this).attr('data-id')
            $('#member_id').val(id)
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to approve all the applications?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#approve_all').submit();
                }
            })
        });

        $('#check_all').on('click',function(){
            if($(this).is(':checked'))
            {
                $('#approve_all_btn').removeClass('item_hide');
                for(let i=1;i<=20;i++)
                {
                    $('#id_sl'+i).prop('checked',true)
                }
            }else
            {
                $('#approve_all_btn').addClass('item_hide');
                for(let i=1;i<=20;i++)
                {
                    $('#id_sl'+i).prop('checked',false)
                }
            }
        })

@stop