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
                    <h3 class="card-title"><i class="nav-icon fas fa-users"></i> Configure Email</h3>
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
                    <div class="alert alert-success alert-dismissible">{{session('message')}}</div>
            @endif
            <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('email-config')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{isset($configs->id)?$configs->id:""}}">
                    <div class="card-body">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <label for="ever_declined">Send Payment Approval Email: </label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input ever_declined1" id="ever_declined1" {{isset($configs->send_payment_approval_email) && $configs->send_payment_approval_email == '1' ? 'checked' : ''}}  name="send_payment_approval_email" type="checkbox" value="1">
                                    <label for="ever_declined1">
                                        Yes
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input ever_declined2" id="ever_declined2" {{isset($configs->send_payment_approval_email) && $configs->send_payment_approval_email == '0' ? 'checked' : ''}}  name="send_payment_approval_email" type="checkbox" value="0">
                                    <label for="ever_declined2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <label for="ever_declined">Send Payment Decline Email: </label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input ever_declined1" id="ever_declined3" {{isset($configs->send_payment_decline_email) && $configs->send_payment_decline_email == '1' ? 'checked' : ''}}   name="send_payment_decline_email" type="checkbox" value="1">
                                    <label for="ever_declined3">
                                        Yes
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input ever_declined2" id="ever_declined4" {{isset($configs->send_payment_decline_email) && $configs->send_payment_decline_email == '0' ? 'checked' : ''}}   name="send_payment_decline_email" type="checkbox" value="0">
                                    <label for="ever_declined4">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <label for="ever_declined">Send Application Approval Email: </label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input ever_declined1" id="ever_declined5" {{isset($configs->send_application_approval_email) && $configs->send_application_approval_email == '1' ? 'checked' : ''}}  name="send_application_approval_email" type="checkbox" value="1">
                                    <label for="ever_declined5">
                                        Yes
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input ever_declined2" id="ever_declined6" {{isset($configs->send_application_approval_email) &&  $configs->send_application_approval_email == '0' ? 'checked' : ''}}   name="send_application_approval_email" type="checkbox" value="0">
                                    <label for="ever_declined6">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email_greeting">Email Greetings<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ isset($configs->email_greeting) ? $configs->email_greeting:"" }}" id="email_greeting" name="email_greeting" placeholder="Email Greetings">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email_addressing">Email Addressing<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ isset($configs->email_addressing) ? $configs->email_addressing:"" }}" id="email_addressing" name="email_addressing" placeholder="Email Addressing">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email_footer">Email Footer<span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" id="email_footer" name="email_footer">{{ isset($configs->email_footer) ? $configs->email_footer:""}}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer float-right">
                            <button type="submit" class="btn btn-danger btn-xs"><b>Save</b></button>
                            <a href="{{route('home')}}" class="btn btn-warning btn-xs"><b>Cancel</b></a>
                        </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop
@section('script')
    $('#ever_declined1').on('click',function(){
        $('#ever_declined2').prop('checked',false);
    })
    $('#ever_declined2').on('click',function(){
        $('#ever_declined1').prop('checked',false);
    })

    $('#ever_declined3').on('click',function(){
        $('#ever_declined4').prop('checked',false);
    })
    $('#ever_declined4').on('click',function(){
        $('#ever_declined3').prop('checked',false);
    })

    $('#ever_declined5').on('click',function(){
        $('#ever_declined6').prop('checked',false);
    })
    $('#ever_declined6').on('click',function(){
        $('#ever_declined5').prop('checked',false);
    })

@endsection