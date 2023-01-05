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
        <div class="col-sm-12 col-md-6 offset-md-3">
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
                            <form action="{{route('save-settings')}}" method="POST">
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>Theme color</h4>
                                            <div class="form-group clearfix">
                                                <div class="icheck-dark d-inline">
                                                    <input value="" type="checkbox" id="cb1" {{empty($settings->template_color)?"checked":""}} class="bc-color" name="template_color" data-id="1">
                                                    <label for="cb1">
                                                        Default <i class="fa fa-circle" style=""></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="icheck-dark d-inline">
                                                    <input value="#3c77bf" type="checkbox" {{isset($settings->template_color) && $settings->template_color=="#3c77bf"?"checked":""}} id="cb2" class="bc-color" name="template_color" data-id="2">
                                                    <label for="cb2">
                                                        Blue <i class="fa fa-circle" style="color: #3c77bf"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="icheck-dark d-inline">
                                                    <input value="#32b7f7" type="checkbox" id="cb3" {{isset($settings->template_color) && $settings->template_color=="#32b7f7"?"checked":""}}  class="bc-color" name="template_color" data-id="3">
                                                    <label for="cb3" style="">
                                                        St. blue  <i class="fa fa-circle" style="color: #32b7f7"></i>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <div class="icheck-dark d-inline">
                                                    <input value="#f7b132" type="checkbox" id="cb4" {{isset($settings->template_color) && $settings->template_color=="#f7b132"?"checked":""}} class="bc-color" name="template_color" data-id="4">
                                                    <label for="cb4" style="">
                                                        Orange <i class="fa fa-circle" style="color: #f7b132"></i>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <div class="icheck-dark d-inline">
                                                    <input value="#f7df32" type="checkbox" id="cb5" {{isset($settings->template_color) && $settings->template_color=="#f7df32"?"checked":""}} class="bc-color" name="template_color" data-id="5">
                                                    <label for="cb5">
                                                        Yellow <i class="fa fa-circle" style="color: #f7df32"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="icheck-dark d-inline">
                                                    <input value="#7ef732" type="checkbox" id="cb6" {{isset($settings->template_color) && $settings->template_color=="#7ef732"?"checked":""}} class="bc-color" name="template_color" data-id="6">
                                                    <label for="cb6">
                                                        Green <i class="fa fa-circle" style="color: #7ef732"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="icheck-dark d-inline">
                                                    <input value="#ceccc4" type="checkbox" id="cb7" {{isset($settings->template_color) && $settings->template_color=="#ceccc4"?"checked":""}} class="bc-color" name="template_color" data-id="7">
                                                    <label for="cb7">
                                                        Gray <i class="fa fa-circle" style="color: #ceccc4"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4>Font size</h4>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="font_sm" {{isset($settings->font_size) && $settings->font_size=="10px"?"checked":""}} name="font_size" value="10px">
                                                    <label for="font_sm">
                                                        Extra small
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="small" {{isset($settings->font_size) && $settings->font_size=="12px"?"checked":""}}  name="font_size" value="12px">
                                                    <label for="small">
                                                        Small
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="large" {{isset($settings->font_size) && $settings->font_size=="13px"?"checked":""}} name="font_size" value="14px">
                                                    <label for="large">
                                                        Large
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
                            </form>
                        </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop
@section('script')
    $('.bc-color').on('click',function () {
        let dataid=$(this).data('id')
        for(let i=1;i<=7;i++)
        {
            if(i==dataid)
            {
                continue;
            }else
            {
                $('#cb'+i).prop('checked',false);
            }
        }
    })

    $('#font_sm').on('click',function(){
        $('#small').prop('checked',false)
        $('#large').prop('checked',false)
    })

    $('#small').on('click',function(){
        $('#font_sm').prop('checked',false)
        $('#large').prop('checked',false)
    })

    $('#large').on('click',function(){
        $('#font_sm').prop('checked',false)
        $('#small').prop('checked',false)
    })

@stop
