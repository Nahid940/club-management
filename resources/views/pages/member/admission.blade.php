@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .table td, .table th {
        padding: .1rem!important
    }
    .hidden{
        display:none
    }
    .form-control{
        height: calc(1.40rem);
        padding: .1rem 0.75rem;
        border: 1px solid #b4bae2b5;
        font-size: 0.7rem;
    }
    .col-sm-3 {
        max-width: 20%;
    }
    label {
        margin-bottom: 0;
        color: #4f4d50;
    }
    .form-group {
        margin-bottom: 0.4rem;
    }
    .txt-info{
        color:red;
        font-weight:bold
    }
    .circle1{
        background:#41ff40;
    }
    #first_step{
        color:#41ff40
    }
    .bs-stepper .line, .bs-stepper-line {
        min-height: 6px;
    }
    .form_part_heading{
        font-size:15px;
        margin-bottom: 5px;
        color:#2b73cce8;
        border-bottom:1px dashed #ccc
    }
    .card-title{
        font-size:14px;
    }
    .bs-stepper-label{
        font-size:12px;
    }
    [class*=icheck-]>label{
        vertical-align:baseline
    }

    .swal2-popup {
        font-size: 8px !important;
        width:400;
        color:#dd234b !important;
    }

    .frame {
        width: 130px;
        height: 134px;
        border: 3px solid #ccc;
        background: #eee;
        margin-left 2px: ;
        {{--padding: 60px 25px;--}}
    }
    img {
        width: 100%;
    }
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 4px 11px;
        cursor: pointer;
        color: #0067d2
    }
    input[type="file"] {
        display: none;
    }
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="bs-stepper">
            <div class="bs-stepper-header" role="tablist">
                <!-- your steps here -->
                <div class="step" data-target="#logins-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="first_step">
                        <span class="bs-stepper-circle circle1">1</span>
                        <span class="bs-stepper-label">First Step</span>
                    </button>
                </div>
                <div class="line line1"></div>
                <div class="step" data-target="#logins-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="second_step">
                        <span class="bs-stepper-label">Second Step</span>
                        <span class="bs-stepper-circle circle2">2</span>
                    </button>
                </div>
                {{--<div class="line line2"></div>--}}
                {{--<div class="step" data-target="#information-part">--}}
                    {{--<button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="last_step">--}}
                        {{--<span class="bs-stepper-circle circle3">3</span>--}}
                        {{--<span class="bs-stepper-label">Final</span>--}}
                    {{--</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>
@if(session('message'))
    <div class="row">
        <div class="col-12">
               <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    {{session('message')}}
                    <i class="icon fas fa-exclamation-triangle"></i>Click here to view <a href="{{route('member-read',session('id'))}}">profile</a>
              </div>
        </div>
    </div>
@endif

@if(session('warning'))
    <div class="row">
        <div class="col-12">
               <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{session('warning')}}
              </div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Application for Club Membership</h3>
            </div>
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

                <form action="{{route('member-add')}}" method="POST" enctype="multipart/form-data" id="member_form">
                    {{ csrf_field() }}
                    <div id="step_1">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="frame">
                                    <img id="sample_img" src="http://127.0.0.1:8000/img/user.jpeg" alt="your image" />
                                </div>
                                <label class="custom-file-upload">
                                    <span>Click here to upload<br>your photo</span> <span class="txt-info">*</span>
                                    <input type="file" name="member_photo" class="" id="imgInp"/>
                                </label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <label for="" class="mem_type">Type of Membership: <span class="txt-info">*</span></label>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" {{old ('member_type') == 1 ? 'checked' : ''}}   name="member_type" class="member_type"  id="mem1" value="1">
                                        <label for="mem1">
                                            Donor Member
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" {{old ('member_type') == 2 ? 'checked' : ''}}   name="member_type" class="member_type"  id="mem2" value="2">
                                        <label for="mem2">
                                            Life Member
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" {{old ('member_type') == 3 ? 'checked' : ''}}   name="member_type" class="member_type"  id="mem3" value="4">
                                        <label for="mem3">
                                            NRB Member
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" {{old ('member_type') == 4 ? 'checked' : ''}}  name="member_type" class="member_type"  id="mem4" value="4">
                                        <label for="mem4">
                                            General Member
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="registration_date" class="lbl_reg_date">Registration Date <span class="txt-info">*</span></label>
                                        <input type="date" id="registration_date" value="{{date('Y-m-d',strtotime($today))}}" name="registration_date" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="name" class="lbl_mmbr_name">Member Name <span class="txt-info">*</span></label>
                                    <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name" placeholder="Member Name"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label for="blood_group">Blood Group</label>
                                    <select class="form-control" id="blood_group" name="blood_group" require>
                                        <option value="">--Select--</option>
                                        <option value="A+" {{old ('blood_group') == 'A+' ? 'selected' : ''}}>A+</option>
                                        <option value="A-" {{old ('blood_group') == 'A-' ? 'selected' : ''}}>A-</option>
                                        <option value="AB+" {{old ('blood_group') == 'AB+' ? 'selected' : ''}}>AB+</option>
                                        <option value="AB-" {{old ('blood_group') == 'AB-' ? 'selected' : ''}}>AB-</option>
                                        <option value="O+" {{old ('blood_group') == 'O+' ? 'selected' : ''}}>O+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="college_roll" class="lbl_college_roll">College Roll Number <span class="txt-info">*</span></label>
                                    <input type="text" id="college_roll" value="{{ old('college_roll') }}" name="college_roll" class="form-control" placeholder="College Roll Number"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="date_of_birth" class="lbl_dob">Date of Birth <span class="txt-info">*</span></label>
                                    <input type="date" id="date_of_birth" value="{{ old('date_of_birth') }}" name="date_of_birth" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nid" class="lbl_nid">NID Number <span class="txt-info">*</span></label>
                                    <input type="text" id="nid" name="nid" value="{{ old('nid') }}" class="form-control" placeholder="NID Number" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="passport">Passport Number</label>
                                    <input type="text" id="passport" name="passport" value="{{ old('passport') }}" class="form-control" placeholder="Passport Number" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="marital_status">Marital Status</label>
                                    <select class="form-control" id="marital_status" name="marital_status" require>
                                        <option value="">--Select--</option>
                                        <option value="1" {{old ('marital_status') == '1' ? 'selected' : ''}}>Married</option>
                                        <option value="2" {{old ('marital_status') == '2' ? 'selected' : ''}}>Single</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="date_of_annniversary">Date of Anniversary</label>
                                    <input type="date" id="date_of_annniversary" value="{{ old('date_of_annniversary') }}" name="date_of_annniversary" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="no_of_dependants">No. Of Dependants</label>
                                    <input type="number" id="no_of_dependants" value="{{ old('no_of_dependants') }}" name="no_of_dependants" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="fathers_name" class="lbl_fathers_name">Father's Name<span class="txt-info">*</span></label>
                                    <input type="text" class="form-control" id="fathers_name" value="{{ old('fathers_name') }}" name="fathers_name" placeholder="Father's Name"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="mothers_name" class="lbl_mothers_name">Mothers's Name<span class="txt-info">*</span></label>
                                    <input type="text" class="form-control" id="mothers_name" value="{{ old('mothers_name') }}"  name="mothers_name" placeholder="Mother's Name"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="mobile_number" class="lbl_mobile_no">Mobile Number <span class="txt-info">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('mobile_number') }}" id="mobile_number" name="mobile_number" placeholder="Mobile Number" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="email" class="lbl_email">Office Email <span class="txt-info">*</span></label>
                                    <input type="text" class="form-control" id="email" value="{{ old('email') }}"  name="email" placeholder="Email" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="occupation_type">Occupation Type</label>
                                    <select class="form-control" id="occupation_type" name="occupation_type" require>
                                        <option value="">--Select--</option>
                                        <option value="1" {{old ('occupation_type') == '1' ? 'selected' : ''}}>Service</option>
                                        <option value="2" {{old ('occupation_type') == '1' ? 'selected' : ''}}>Self Employed</option>
                                        <option value="3" {{old ('occupation_type') == '1' ? 'selected' : ''}}>Retired</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form_part_heading" for="">Educational Background <span><i class="fa fa-question-circle" aria-hidden="true"></i></span></div>
                                    <table id="" class="table  table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Name of the Institution</th>
                                                <th>Passing Year</th>
                                                <th>Degree/Qualification Obtained</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="institution_name[]" value="{{old('institution_name.0')}}" class="form-control" placeholder="Name of the Institution"/></td>
                                                <td><input type="text" name="passing_year[]" value="{{old('passing_year.0')}}"  class="form-control" placeholder="Passing Year"/></td>
                                                <td><input type="text" name="degree[]" value="{{old('degree.0')}}"  class="form-control" placeholder="Degree"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="institution_name[]" value="{{old('institution_name.1')}}"  class="form-control" placeholder="Name of the Institution"/></td>
                                                <td><input type="text" name="passing_year[]" value="{{old('passing_year.1')}}" class="form-control" placeholder="Passing Year"/></td>
                                                <td><input type="text" name="degree[]" value="{{old('degree.1')}}"  class="form-control" placeholder="Degree"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="institution_name[]" value="{{old('institution_name.2')}}"  class="form-control" placeholder="Name of the Institution"/></td>
                                                <td><input type="text" name="passing_year[]" value="{{old('passing_year.2')}}" class="form-control" placeholder="Passing Year"/></td>
                                                <td><input type="text" name="degree[]" value="{{old('degree.2')}}"  class="form-control" placeholder="Degree"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="institution_name[]" value="{{old('institution_name.3')}}" class="form-control" placeholder="Name of the Institution"/></td>
                                                <td><input type="text" name="passing_year[]" value="{{old('passing_year.3')}}"  class="form-control" placeholder="Passing Year"/></td>
                                                <td><input type="text" name="degree[]" value="{{old('degree.3')}}" class="form-control" placeholder="Degree"/></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="present_address" class="lbl_present_address">Present Address <span class="txt-info">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('present_address') }}" id="present_address" name="present_address" placeholder="Present Address" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="permanent_address">Permanent Address</label>
                                    <input type="text" class="form-control" value="{{ old('permanent_address') }}"  id="permanent_address" name="permanent_address" placeholder="Permanent Address" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="company_name">Company Name</label>
                                <input type="text" class="form-control" id="company_name" value="{{ old('company_name') }}" name="company_name" placeholder="Company Name"/>
                            </div>
                            <div class="col-sm-3">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" id="designation" value="{{ old('designation') }}"  name="designation" placeholder="Designation"/>
                            </div>
                            <div class="col-sm-3">
                                <label for="office_address">Office Address</label>
                                <input type="text" class="form-control" id="office_address" value="{{ old('office_address') }}" name="office_address" placeholder="Office Address"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="office_phone">Office Phone</label>
                                <input type="text" class="form-control" id="office_phone" value="{{ old('office_phone') }}" name="office_phone" placeholder="Office Phone"/>
                            </div>
                            <div class="col-sm-3">
                                <label for="office_mobile">Office Mobile</label>
                                <input type="text" class="form-control" id="office_mobile" value="{{ old('office_mobile') }}" name="office_mobile" placeholder="Office Mobile"/>
                            </div>
                            <div class="col-sm-3">
                                <label for="office_email">Email</label>
                                <input type="text" class="form-control" id="office_email" value="{{ old('office_email') }}" name="office_email" placeholder="Email"/>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <label for="all_correspondence">All Correspondence: </label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input" id="present_addr1" name="all_correspondence" {{old ('all_correspondence') == '1' ? 'checked' : ''}} type="checkbox" value="1">
                                    <label for="present_addr1">
                                        Present Address
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input" id="prmnt_addr2" name="all_correspondence" {{old ('all_correspondence') == '2' ? 'checked' : ''}} type="checkbox" value="2">
                                    <label for="prmnt_addr2">
                                        Permanent Address
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="should_be_sent_to" style="align-items: center">Should be sent to: </label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input" id="should_be_sent_to" {{old ('should_be_sent_to') == '1' ? 'checked' : ''}}  name="should_be_sent_to" type="checkbox" value="1">
                                    <label for="should_be_sent_to">
                                        Office Address
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="ever_declined">Have you ever been declined membership of this club?: </label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input ever_declined1" id="ever_declined1" {{old ('ever_declined') == '2' ? 'checked' : ''}}  name="ever_declined" type="checkbox" value="1">
                                    <label for="ever_declined1">
                                        Yes
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input ever_declined2" id="ever_declined2" {{old ('ever_declined') == '0' ? 'checked' : ''}}  name="ever_declined" type="checkbox" value="0">
                                    <label for="ever_declined2">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="details_of_decline">If yes, furnish details</label>
                                <input type="text" class="form-control" id="details_of_decline" value="{{old('details_of_decline')}}"  name="details_of_decline" placeholder="Details"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="application_rejected">Have your membership application ever been rejected by other club/inst.?: </label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input application_rejected1" {{old ('application_rejected') == '1' ? 'checked' : ''}} id="application_rejected1" name="application_rejected" type="checkbox" value="1">
                                    <label for="application_rejected1">
                                        Yes
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input application_rejected2" {{old ('application_rejected') == '0' ? 'checked' : ''}}  id="application_rejected2"  name="application_rejected" type="checkbox" value="0">
                                    <label for="application_rejected2">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="details_of_reject">If yes, furnish details</label>
                                <input type="text" class="form-control" id="details_of_reject" value="{{old('details_of_reject')}}"  name="details_of_reject" placeholder="Details"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="criminal_ofence">Ever punished for criminal ofence?</label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input criminal_ofence1" {{old ('criminal_ofence') == '1' ? 'checked' : ''}}  id="criminal_ofence1" name="criminal_ofence" type="checkbox" value="1">
                                    <label for="criminal_ofence1">
                                        Yes
                                    </label>
                                </div>

                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input criminal_ofence2" {{old ('criminal_ofence') == '0' ? 'checked' : ''}}  id="criminal_ofence2" name="criminal_ofence" type="checkbox" value="0">
                                    <label for="criminal_ofence2">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="details_of_criminal_ofence">If yes, furnish details</label>
                                <input type="text" class="form-control" id="details_of_criminal_ofence" value="{{old('details_of_criminal_ofence')}}" name="details_of_criminal_ofence" placeholder="Details"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="car_owned">Car owned?</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                      <input type="checkbox"  name="car_owned" class="car_owned1" {{old('car_owned') == '1' ? 'checked' : ''}}   id="checkboxPrimary1" value="1">
                                      <label for="checkboxPrimary1">
                                          Yes
                                      </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                      <input type="checkbox"  name="car_owned" class="car_owned2" {{old('car_owned') == '0' ? 'checked' : ''}}  id="checkboxPrimary2" value="0">
                                      <label for="checkboxPrimary2">
                                          No
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="car_reg_no">Car registration number</label>
                                <input type="text" class="form-control" id="car_reg_no" value="{{old('car_reg_no')}}" name="car_reg_no" placeholder="Reg. No"/>
                            </div>
                            <div class="col-sm-4">
                                <label for="car_owned">Car ownership type?</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input name="car_ownership_type" type="checkbox" {{old('car_ownership_type') == 1 ? 'checked' : ''}}  id="car_ownership_type1" value="1">
                                        <label for="car_ownership_type1">
                                            Personal
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input name="car_ownership_type" type="checkbox" {{old ('car_ownership_type') == 2 ? 'checked' : ''}} id="car_ownership_type2" value="2">
                                        <label for="car_ownership_type2">
                                        Office
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input name="car_ownership_type" type="checkbox" {{old ('car_ownership_type') == 3 ? 'checked' : ''}} id="car_ownership_type3" value="3">
                                        <label for="car_ownership_type3">
                                            Rented
                                        </label>
                                    </div>
                                </div>
                                

                            </div>
                        </div>
                    </div>
                    <!-- ============================================================================================================================ -->
                    <div id="step_2" class="hidden">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form_part_heading" for="">Membership Details of Other Club/Institution/Association</div>
                                <div class="form-group">
                                    <table id="" class="table  table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Club Name</th>
                                                <th>Membership Number</th>
                                                <th>Type of Membership/Position</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="club_name[]" value="{{old('club_name.0')}}" class="form-control" placeholder="Club Name"/></td>
                                                <td><input type="text" name="membership_no[]" value="{{old('membership_no.0')}}"  class="form-control" placeholder="Membership Number"/></td>
                                                <td><input type="text" name="membership_type[]" value="{{old('membership_type.0')}}"  class="form-control" placeholder="Type of Membership/Position"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="club_name[]" value="{{old('club_name.1')}}" class="form-control" placeholder="Club Name"/></td>
                                                <td><input type="text" name="membership_no[]" value="{{old('membership_no.1')}}" class="form-control" placeholder="Membership Number"/></td>
                                                <td><input type="text" name="membership_type[]" value="{{old('membership_type.1')}}" class="form-control" placeholder="Type of Membership/Position"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="club_name[]" value="{{old('club_name.2')}}" class="form-control" placeholder="Club Name"/></td>
                                                <td><input type="text" name="membership_no[]" value="{{old('membership_no.2')}}" class="form-control" placeholder="Membership Number"/></td>
                                                <td><input type="text" name="membership_type[]" value="{{old('membership_type.2')}}" class="form-control" placeholder="Type of Membership/Position"/></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class="col-md-12">
                                <div class="form_part_heading" for="">Spouse Details</div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="spouse_name" class="lbl_spouse_name"> Name<span class="txt-info">*</span></label>
                                            <input type="text" class="form-control" value="{{old('spouse_name')}}" id="spouse_name" name="spouse_name" placeholder="Name"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="spouse_date_of_birth">Date of Birth</label>
                                            <input type="date" class="form-control" id="spouse_date_of_birth" value="{{old('spouse_date_of_birth')}}" name="spouse_date_of_birth"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="spouse_mobile_number">Mobile Number</label>
                                            <input type="text" class="form-control" id="spouse_mobile_number"  value="{{old('spouse_mobile_number')}}" name="spouse_mobile_number" placeholder="Mobile Number" require/>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="spouse_email">Email</label>
                                            <input type="text" class="form-control" id="spouse_email" value="{{old('spouse_email')}}" name="spouse_email" placeholder="Email" require/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form_part_heading" for="">Dependant Details</div>
                                <div class="form-group">
                                    <table id="" class="table  table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date of Birth</th>
                                                <th>Blood Group</th>
                                                <th>Occupation</th>
                                                <th>NID(If any)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="dep_name[]" value="{{old('dep_name.0')}}"  class="form-control" placeholder="Name"/></td>
                                                <td><input type="date" name="dep_dob[]" value="{{old('dep_dob.0')}}"  class="form-control" placeholder=""/></td>
                                                <td><input type="text" name="dep_blood_group[]" value="{{old('dep_blood_group.0')}}" class="form-control" placeholder="Blood Group"/></td>
                                                <td><input type="text" name="dep_occupation[]" value="{{old('dep_occupation.0')}}" class="form-control" placeholder="Occupation"/></td>
                                                <td><input type="text" name="dep_nid[]" value="{{old('dep_nid.0')}}" class="form-control" placeholder="NID"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="dep_name[]" value="{{old('dep_name.1')}}"  class="form-control" placeholder="Name"/></td>
                                                <td><input type="date" name="dep_dob[]" value="{{old('dep_dob.1')}}"  class="form-control" placeholder=""/></td>
                                                <td><input type="text" name="dep_blood_group[]" value="{{old('dep_blood_group.1')}}" class="form-control" placeholder="Blood Group"/></td>
                                                <td><input type="text" name="dep_occupation[]" value="{{old('dep_occupation.1')}}" class="form-control" placeholder="Occupation"/></td>
                                                <td><input type="text" name="dep_nid[]" value="{{old('dep_nid.1')}}" class="form-control" placeholder="NID"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="dep_name[]" value="{{old('dep_name.2')}}"  class="form-control" placeholder="Name"/></td>
                                                <td><input type="date" name="dep_dob[]" value="{{old('dep_dob.2')}}"  class="form-control" placeholder=""/></td>
                                                <td><input type="text" name="dep_blood_group[]" value="{{old('dep_blood_group.2')}}" class="form-control" placeholder="Blood Group"/></td>
                                                <td><input type="text" name="dep_occupation[]" value="{{old('dep_occupation.2')}}" class="form-control" placeholder="Occupation"/></td>
                                                <td><input type="text" name="dep_nid[]" value="{{old('dep_nid.2')}}" class="form-control" placeholder="NID"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="dep_name[]" value="{{old('dep_name.3')}}"  class="form-control" placeholder="Name"/></td>
                                                <td><input type="date" name="dep_dob[]" value="{{old('dep_dob.3')}}"  class="form-control" placeholder=""/></td>
                                                <td><input type="text" name="dep_blood_group[]" value="{{old('dep_blood_group.3')}}" class="form-control" placeholder="Blood Group"/></td>
                                                <td><input type="text" name="dep_occupation[]" value="{{old('dep_occupation.3')}}" class="form-control" placeholder="Occupation"/></td>
                                                <td><input type="text" name="dep_nid[]" value="{{old('dep_nid.3')}}" class="form-control" placeholder="NID"/></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="icheck-primary d-inline">
                                    <input name="tc_acceptance" type="checkbox" {{old('tc_acceptance'=='2'?"checked":"")}} id="accept" value="2">
                                    <label for="accept" class="lbl_accept"> <span class="txt-info">*</span>
                                        I HERE BY DECLARE THAT THE MEMBERSHIP HAS BEEN TAKEN ON MY FREE WILL AND CERTIFY THAT I HAVE READ AND UNDERSTOOD
                                        THE <a href="">TERMS</a> AND CONDITIONS AND WILL ABIDE BY THE SAME. I ALSO SOLELY SWEAR THAT THE INFORMATION PROVIDED
                                        BY ME ARE TRUE AND CORRECT.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="form_step" name="form_step" value="0">
                    <!-- ============================================================================================================================ -->

                    {{--<div id="step_3" class='hidden'>--}}
                        {{--<div class="row">--}}
                            {{--<h3 for="">Payment Details</h3>--}}
                        {{--</div>--}}
                        {{--<div class='row'>--}}
                            {{--<div class="col-sm-3">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="bank_name">Bank Name</label>--}}
                                    {{--<input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name"/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-3">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="branch_name">Branch Name</label>--}}
                                    {{--<input type="text" class="form-control" id="branch_name" name="branch_name"  placeholder="Branch Name"/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class='row'>--}}
                            {{--<div class="col-sm-3">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="acc_no">Account Number</label>--}}
                                    {{--<input type="text" class="form-control" id="acc_no" name="acc_no" placeholder="Account Number"/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}


                    <div class="mt-2" style="position: relative;width:100%;height: 50px;">
                        <button type="button" class="btn btn-info hidden btn-xs" id="prev" style="position: absolute; left: 0;"> Previous</button>
                        <button type="button" class="btn btn-success btn-xs" id="next" style="position: absolute; right: 0;">Next </button>
                        <button type="button" class="btn btn-success hidden btn-xs" id="save" style="position: absolute; right: 50%;"><i class="nav-icon fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop
@section('script_link')
    <script src="{{asset('js/input-form.js')}}"></script>
@stop
@section('script')


@stop