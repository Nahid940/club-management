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
    .colon{
        margin-left:20px;

    }
    .bordernone{
        border:none !important;
        background-color:#efeedf
    }
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    @hasrole('super-admin|admin')
                    <a href="{{route('home')}}" class="btn btn-danger btn-xs mb-1 float-right ml-1"><i class="fa fa-window-close"></i> Close</a>
                    <a href="{{route('member-admission')}}" class="btn btn-success btn-xs mb-1 float-right"><i class="fa fa-plus"></i> Add New</a>
                    <a href="{{route('member-book')}}" class="btn btn-warning btn-xs mb-1 float-right mr-1"><i class="fa fa-spinner"></i> Refresh</a>
                    <a href="{{route('new-applications-index')}}" class="btn btn-primary btn-xs mb-1 float-right mr-1"><i class="fa fa-paperclip"></i> Pending Applications</a>
                    @endrole
                    <table id="example2" class="table">
                        <tbody>
                        @php $i=1; @endphp
                            @foreach ($members as $member)
                                <tr>
                                    <td rowspan="7" class="bordernone"><img style="width: 140px" src="{{asset('storage/member_photo/'.$member->member_photo)}}" alt=""></td>
                                    <td class="bordernone"><div align="left" class="text-bold">Membership ID</div></td>
                                    <td class="bordernone">:</td>
                                    <td class="bordernone"><div align="left" class="text-bold">P645645</div></td>
                                </tr>
                                <tr>
                                    <td class="bordernone"><div align="left" class="text-bold">Name</div></td>
                                    <td class="bordernone">:</td>
                                    <td class="bordernone"><div align="left" class="text-bold">{{$member->first_name}}</div></td>
                                </tr>
                                <tr>
                                    <td class="bordernone"><div align="left" class="text-bold">Type Of Membership</div></td>
                                    <td class="bordernone">:</td>
                                    <td class="bordernone"><div align="left" class="text-bold">{{$member->membeship_type}}</div></td>
                                </tr>
                                <tr>
                                    <td class="bordernone"><div align="left" class="text-bold">Blood Group</div></td>
                                    <td class="bordernone">:</td>
                                    <td class="bordernone"><div align="left" class="text-bold">{{$member->blood_group}}</div></td>
                                </tr>
                                <tr>
                                    <td class="bordernone"><div align="left" class="text-bold">Mobile</div></td>
                                    <td class="bordernone">:</td>
                                    <td class="bordernone"><div align="left" class="text-bold">{{$member->mobile_number}}</div></td>
                                </tr>
                                <tr>
                                    <td class="bordernone"><div align="left" class="text-bold">E-mail</div></td>
                                    <td class="bordernone">:</td>
                                    <td class="bordernone"><div align="left" class="text-bold">{{$member->email}}</div></td>
                                </tr>
                                <tr>
                                    <td class="bordernone"><div align="left" class="text-bold">Address</div></td>
                                    <td class="bordernone">:</td>
                                    <td class="bordernone"><div align="left" class="text-bold">{{$member->present_address}}</div></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="">&nbsp;</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{--Name--}}
                {{--Type Of Membership--}}
                {{--Blood Group--}}
                {{--Mobile--}}
                {{--Email--}}
                {{--Address--}}

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