@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    @media print
    {
    .no-print, .no-print *
    {
    display: none !important;
    }
    }
@stop
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2 col-sm-12">
            <div class="card card-primary">
                @if(session('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-check"></i> {{session('message')}}
                    </div>
                @endif
                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-check"></i> {{session('warning')}}
                    </div>
                @endif
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-clipboard-list" aria-hidden="true"></i> Notice</h3>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        Title: {{$notice->title}}
                                        @if($notice->status==1)
                                            <i class="fas fa-check text-success"> Published</i>
                                        @elseif($notice->status==0)
                                            <i class="fas fa-times text-danger"> Postponed</i>
                                        @endif
                                        <small class="float-right">Date: {{date('d-m-Y',strtotime($notice->notice_date))}}</small>
                                    </h4>
                                </div>
                            </div>

                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <address>
                                        <strong>Posted by: {{!empty($notice->createdBy->name)?$notice->createdBy->name:""}}</strong><br>
                                        <br>
                                        Date: {{date('d-m-Y',strtotime($notice->notice_date))}}<br>
                                    </address>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 table-responsive">
                                    {!! $notice->notice !!}
                                </div>
                            </div>
                            <div class="row no-print">
                                <div class="col-12">
                                    <a id="print" rel="noopener" onclick="window.print()" class="btn btn-default btn-xs"><i class="fas fa-print"></i> Print</a>
                                    @role('admin|super-admin')
                                        @if($notice->status==1)
                                            <a class="btn btn-danger btn-xs " id="postpone" data-id="{{$notice->id}}"><i class="fas fa-times"></i> Postpone Notice</a>
                                        @elseif($notice->status==0)
                                            <a class="btn btn-info btn-xs " id="postpone" data-id="{{$notice->id}}"><i class="fas fa-recycle"></i> Publish Notice</a>
                                        @endif
                                    <a href="{{route('notice-index')}}" class="btn btn-primary btn-xs"><i class="fas fa-list"></i> View List</a>
                                    @endrole
                                </div>
                            </div>
                            @role('admin|super-admin')
                                <form action="{{route('notice-postpone')}}" id="postpone_notice" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="status" value="{{$notice->status}}">
                                    <input type="hidden" name="n_id" value="{{$notice->id}}">
                                </form>
                            @endrole
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script_link')
    <script src="{{asset('js/member-search.js')}}"></script>
@stop

@section('script')
    {{--<script>--}}
    $('#postpone').on('click',function () {
    $('#action_type').val(1)

    Swal.fire({
    title: 'Are you sure?',
    text: "You want to postpone this notice!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, approve it!'
    }).then((result) => {
    if (result.isConfirmed) {
    $('#postpone_notice').submit();
    }
    })

    });

    $('#decline').on('click',function () {
    $('#action_type').val(2)
    Swal.fire({
    title: 'Are you sure?',
    text: "You want to decline this payment!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, decline it!'
    }).then((result) => {
    if (result.isConfirmed) {
    $('#process_payment_form').submit();
    }
    })
    });


    $('#revert').on('click',function () {
    $('#action_type').val(3)

    Swal.fire({
    title: 'Are you sure?',
    text: "You want to revert this payment!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, revert it!'
    }).then((result) => {
    if (result.isConfirmed) {
    $('#process_payment_form').submit();
    }
    })
    })


    {{--</script>--}}
@stop