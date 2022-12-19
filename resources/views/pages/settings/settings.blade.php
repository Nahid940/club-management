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
        <div class="col-6">
            <div class="card">
                <!-- /.card-header -->
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Set your system preference</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4>Theme color</h4>
                                        <div class="form-group clearfix">
                                            <div class="icheck-dark d-inline">
                                                <input value="#3c77bf" type="checkbox" id="checkboxPrimary1">
                                                <label for="checkboxPrimary1">
                                                    Blue <i class="fa fa-circle" style="color: #3c77bf"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="icheck-dark d-inline">
                                                <input value="#32b7f7" type="checkbox" id="checkboxPrimary3">
                                                <label for="checkboxPrimary3" style="">
                                                    St. blue  <i class="fa fa-circle" style="color: #32b7f7"></i>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <div class="icheck-dark d-inline">
                                                <input value="#f7b132" type="checkbox" id="checkboxPrimary2">
                                                <label for="checkboxPrimary2" style="">
                                                    Orange <i class="fa fa-circle" style="color: #f7b132"></i>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <div class="icheck-dark d-inline">
                                                <input value="#f7df32" type="checkbox" id="yellow">
                                                <label for="yellow">
                                                    Yellow <i class="fa fa-circle" style="color: #f7df32"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="icheck-dark d-inline">
                                                <input value="#7ef732" type="checkbox" id="green">
                                                <label for="green">
                                                    Green <i class="fa fa-circle" style="color: #7ef732"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="icheck-dark d-inline">
                                                <input value="#ceccc4" type="checkbox" id="gray">
                                                <label for="gray">
                                                    Gray <i class="fa fa-circle" style="color: #ceccc4"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4>Font size</h4>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="font_sm">
                                                <label for="font_sm">
                                                    XS
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="small">
                                                <label for="small">
                                                    S
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="large">
                                                <label for="large">
                                                    L
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="position: relative;">
                                <a href="{{route('home')}}" class="btn btn-danger btn-xs" style="position: absolute;right: 52px;top:1px">Cancel</a>
                                <button class="btn btn-success btn-xs" style="position: absolute;right: 2px;top:1px">Save</button>
                            </div>
                        </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop
