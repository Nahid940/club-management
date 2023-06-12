@extends('main')
@section('style')
    .table td, .table th {
    padding: .2rem;
    }
@stop
@section('content')
    <div class="row">
        <div class="col-md-6  col-sm-12  col-xs-12  offset-lg-3 offset-xl-3">
            <!-- general form elements -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="nav-icon fas fa-cogs"></i> Membership Type Change</h3>
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
                    <div class="alert alert-success alert-dismissible mt-1">{{session('message')}}</div>
            @endif
            <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('update-member-type')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Search Member <span class="text-danger">*</span></label>
                                    <input autocomplete="off" type="text" id="member_search" class="form-control" id="purpose" name="purpose" placeholder="Search by Member name/ID" required>
                                    <input type="hidden" id="member_id" name="member_id">
                                </div>
                                <div class="suggestion-area hidden_area">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Present Member Type<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="" id="present_type" name="present_type" readonly>
                                    <input type="hidden" name="present_type_id" id="present_type_id">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Select New Membership Type<span class="text-danger">*</span></label>
                                    <select name="new_type_id" id="" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer float-right">
                            <button type="submit" class="btn btn-success btn-xs"><b>Update Data</b></button>
                            <a href="{{route('home')}}" class="btn btn-warning btn-xs"><b>Cancel</b></a>
                            <a href="{{route('member-index')}}" class="btn btn-info btn-xs"><b>Go to List</b></a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('script_link')
    <script>
        $('#member_search').on('keyup',function (e) {
            let html_inner="";
            let value;
            value=$(this).val();
            if(value!="")
            {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"post",
                    data:{"value":value,"get_due":1},
                    url:"/member-type-update/search",
                    success:function (res) {
                        res=JSON.parse(res);
                        $.each(res.members,function (index,member) {
                            html_inner+="<li class='search-item listitem' data-type_id='"+member.member_type+"' data-type='"+member.type_name+"' data-id='"+member.id+"' data-name='"+member.first_name+" "+member.member_code+"'><a><div class='title-name'><div class='search-content'><span class='content-title'>Name: "+member.first_name+"</span><br><span>ID: "+member.member_code+"</span><br></div></div></a></li>";
                        });
                        $('.suggestion-area').removeClass('hidden_area');
                        $('.suggestion-area').html(html_inner);
                    }
                })
                
            }
            if(value=="")
            {
                $('.suggestion-area').addClass('hidden_area');
                $('.suggestion-area').html();
            }
        });

        $("body").on("click", ".listitem", function () {
        let name=$(this).data('name');
        let id=$(this).data('id');
        let type=$(this).data('type');
        let type_id=$(this).data('type_id');
        $('#member_search').val(name);
        $('#member_id').val(id);
        $('#present_type').val(type);
        $('#present_type_id').val(type_id);
        $('.suggestion-area').addClass('hidden_area');
        $('.suggestion-area').html();
    });
    </script>
@endsection