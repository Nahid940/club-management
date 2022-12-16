@extends('main')
@section('pageHeading'){{$title}}@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card" style="background-color: #e4ff078f">
                <div class="card-header">
                    <h3 class="card-title">Warning!</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: block;font-size: 12px;color:red;font-weight: bold">
                    <i class="fa fa-ban" aria-hidden="true"></i> You have already applied for membership. Please check your application status <a href="{{route('member-profile')}}">Here</a> !
                </div>
            </div>
        </div>
    </div>
@stop