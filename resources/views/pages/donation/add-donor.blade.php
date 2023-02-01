@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .form-control{
    height: calc(1.40rem);
    padding: .1rem 0.75rem;
    border: 1px solid #b4bae2b5;
    font-size: 0.7rem;
    }
    .suggestion-area, .suggestion-area1 {
    position: absolute;
    width: 98%;
    background-color: #fff;
    z-index: 11;
    display: block;
    height: auto;
    margin-top:0px
    }
    .search-item{
    border-bottom:1px solid #fff;
    }
    .suggestion-area .search-item, .suggestion-area1 .search-item, .suggestion-area2 .search-item {
    background-color: #0b64d4;
    color:#fff;
    padding: 5px;
    list-style: none;
    overflow: hidden;
    }
    .search-content{
    color:#fff
    }
    .search-item:hover{
    background-color: #1975e6;
    cursor:pointer
    }
    .hidden_area{
    display:none
    }
@stop
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3 col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Add New Donor</h3>
                    <a href="{{route('home')}}" class="btn btn-danger btn-xs float-right"> <i class="fa fa-times"></i></a>
                    <a href="{{route('donor-index')}}" class="btn btn-success btn-xs float-right mr-1"> <i class="fa fa-list"></i> Donors List</a>
                </div>
                <form action="{{route('add-donor')}}" method="POST" id="form_submit">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row">
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
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                                    {{session('message')}}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name"> Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  placeholder="Donor Name" name="name" id="name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="origin"> Origin</label>
                                    <input type="text" class="form-control" placeholder="Origin" name="origin" id="origin">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone">Mobile/Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Mobile/Phone" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="donor_type">Donor Type</label>
                                    <input type="text" class="form-control" placeholder="Donor Type" name="donor_type" id="donor_type">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="reference_person_name">Reference Person Name</label>
                                    <input type="text" class="form-control" placeholder="Reference Person Name" id="reference_person_name" name="reference_person_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="reference_person_phone">Reference Person Phone</label>
                                    <input type="text" class="form-control" placeholder="Reference Person Contact" id="reference_person_phone" name="reference_person_phone">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="reference_person_phone">Donor Address</label>
                                    <input type="text" class="form-control" placeholder="Donor Address" id="address" name="address">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-xs align-content-center save_btn" style="float: right">Save</button>
                        <a href="{{route('add-donor')}}" class="btn btn-warning btn-xs align-content-center mr-1" style="float: right"><i class="fa fa-spinner" aria-hidden="true"></i> Refresh</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Donor Information</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="donor_data_form" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name"> Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  placeholder="Donor Name" name="name" id="name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="origin"> Origin</label>
                                    <input type="text" class="form-control" placeholder="Origin" name="origin" id="origin">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone">Mobile/Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Mobile/Phone" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="donor_type">Donor Type</label>
                                    <input type="text" class="form-control" placeholder="Donor Type" name="donor_type" id="donor_type">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="reference_person_name">Reference Person Name</label>
                                    <input type="text" class="form-control" placeholder="Reference Person Name" id="reference_person_name" name="reference_person_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="reference_person_phone">Reference Person Phone</label>
                                    <input type="text" class="form-control" placeholder="Reference Person Contact" id="reference_person_phone" name="reference_person_phone">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="reference_person_phone">Donor Address</label>
                                    <input type="text" class="form-control" placeholder="Donor Address" id="address" name="address">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-warning btn-xs" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-xs" id="save_donor">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop