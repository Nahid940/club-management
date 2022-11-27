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
    .btns_group{
        margin-bottom:.6rem;
        right:0
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
                            <button type="submit" class="btn btn-primary search_btn">Search</button>
                        </div>
                        
                    </div>
                </form>
                <div class="margin btns_group">
                    <div class="btn-group">
                      <a data-toggle="modal" data-target="#modal-lg" class="btn btn-info">Add New Employee</a>
                      <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                      </div>
                    </div>
                  </div>
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
                    <thead>
                        <tr>
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
                        
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        {{-- {{ $members->links() }} --}}
        <!-- /.card -->
    </div>

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Employee Information</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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