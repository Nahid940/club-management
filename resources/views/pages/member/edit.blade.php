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
        height: 150px;
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
                <h3 class="card-title">Update info</h3>
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
                <form action="{{route('member-update',$member->id)}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div id="step_1">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="frame">
                                    <img style="width: 100%" src="{{asset('storage/member_photo/'.$member->member_photo)}}" alt="">
                                </div>
                                <label class="custom-file-upload">
                                    <span>Click here to upload<br>your photo</span> <span class="txt-info">*</span>
                                    <input type="file" name="member_photo" class="" id="imgInp"/>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <label for="" class="mem_type">Type of Membership: <span class="txt-info">*</span></label>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" {{ $member->member_type=='Donor Member'?"checked":"" }}    name="member_type" class="member_type"  id="mem1" value="1">
                                        <label for="mem1">
                                            Donor Member
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" {{ $member->member_type=='Life Member'?"checked":"" }}    name="member_type" class="member_type"  id="mem2" value="2">
                                        <label for="mem2">
                                            Life Member
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" {{ $member->member_type=='NRB Member'?"checked":"" }}    name="member_type" class="member_type"  id="mem3" value="3">
                                        <label for="mem3">
                                            NRB Member
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" {{ $member->member_type=='General Member'?"checked":"" }}   name="member_type" class="member_type"  id="mem4" value="4">
                                        <label for="mem4">
                                            General Member
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="registration_date">Registration Date <span class="txt-info">*</span></label>
                                        <input type="date" id="registration_date" value="{{date('Y-m-d',strtotime($member->registration_date))}}" name="registration_date" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="name">Member Name <span class="txt-info">*</span></label>
                                    <input type="text" value="{{ $member->first_name }}" class="form-control" id="name" name="name" placeholder="Member Name"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label for="blood_group">Blood Group</label>
                                    <select class="form-control" id="blood_group" name="blood_group" require>
                                        <option value="">--Select--</option>
                                        <option value="A+" {{ $member->blood_group === 'A+' ? 'selected' : ''}}>A+</option>
                                        <option value="A-" {{$member->blood_group === 'A-' ? 'selected' : ''}}>A-</option>
                                        <option value="AB+" {{$member->blood_group === 'AB+' ? 'selected' : ''}}>AB+</option>
                                        <option value="AB-" {{$member->blood_group === 'AB-' ? 'selected' : ''}}>AB-</option>
                                        <option value="O+" {{$member->blood_group === 'O+' ? 'selected' : ''}}>O+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="college_roll">College Roll Number <span class="txt-info">*</span></label>
                                    <input type="text" id="college_roll" value="{{ $member->college_roll}}" name="college_roll" class="form-control" placeholder="College Roll Number"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth <span class="txt-info">*</span></label>
                                    <input type="date" id="date_of_birth" value="{{ date('Y-m-d',strtotime($member->date_of_birth)) }}" name="date_of_birth" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nid">NID Number <span class="txt-info">*</span></label>
                                    <input type="text" id="nid" name="nid" value="{{ $member->nid}}" class="form-control" placeholder="NID Number" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="passport">Passport Number</label>
                                    <input type="text" id="passport" name="passport" value="{{ $member->passport}}" class="form-control" placeholder="Passport Number" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="marital_status">Marital Status</label>
                                    <select class="form-control" id="marital_status" name="marital_status" require>
                                        <option value="">--Select--</option>
                                        <option value="1" {{$member->marital_status==1?"selected":''}}>Married</option>
                                        <option value="2" {{$member->marital_status==2?"selected":''}}>Single</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="date_of_annniversary">Date of Anniversary</label>
                                    <input type="date" id="date_of_annniversary" value="{{date('Y-m-d',strtotime($member->date_of_annniversary))}}" name="date_of_annniversary" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="no_of_dependants">No. Of Dependants</label>
                                    <input type="number" id="no_of_dependants" value="{{$member->no_of_dependants}}" name="no_of_dependants" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="fathers_name">Fathers Name</label>
                                    <input type="text" class="form-control" value="{{$member->fathers_name}}" id="fathers_name" name="fathers_name" placeholder="Father's Name"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="mothers_name">Motherss Name</label>
                                    <input type="text" class="form-control" value="{{$member->mothers_name}}" id="mothers_name" name="mothers_name" placeholder="Mother's Name"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="mobile_number">Mobile Number <span class="txt-info">*</span></label>
                                    <input type="text" class="form-control" value="{{ $member->mobile_number }}" id="mobile_number" name="mobile_number" placeholder="Mobile Number" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" value="{{ $member->email }}" name="email" placeholder="Email" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="occupation_type">Occupation Type</label>
                                    <select class="form-control" id="occupation_type" name="occupation_type" require>
                                        <option value="">--Select--</option>
                                        <option value="1"{{$member->occupation_type==1?"selected":""}}> Service</option>
                                        <option value="2"{{$member->occupation_type==2?"selected":""}}> Self Employed</option>
                                        <option value="3"{{$member->occupation_type==3?"selected":""}}> Retired</option>
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
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($member->education as $education)
                                                <tr>
                                                    <input type="hidden" name="education_row_id[]" value="{{$education->id}}">
                                                    <td><input type="text" name="institution_name[]" class="form-control" value="{{$education->institution_name}}" placeholder="Name of the Institution"/></td>
                                                    <td><input type="text" name="passing_year[]" class="form-control" value="{{$education->passing_year}}" placeholder="Passing Year"/></td>
                                                    <td><input type="text" name="degree[]" class="form-control" value="{{$education->degree}}" placeholder="Degree"/></td>
                                                    <td><button type="button" class="btn btn-xs btn-danger">x</button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="present_address">Present Address <span class="txt-info">*</span></label>
                                    <input type="text" class="form-control" value="{{ $member->present_address }}" id="present_address" name="present_address" placeholder="Present Address" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="permanent_address">Permanent Address</label>
                                    <input type="text" class="form-control" value="{{ $member->permanent_address }}"  id="permanent_address" name="permanent_address" placeholder="Permanent Address" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="company_name">Company Name</label>
                                <input type="text" class="form-control" id="company_name" value="{{ $member->company_name }}" name="company_name" placeholder="Company Name"/>
                            </div>
                            <div class="col-sm-3">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" id="designation" value="{{ $member->designation }}"  name="designation" placeholder="Designation"/>
                            </div>
                            <div class="col-sm-3">
                                <label for="office_address">Office Address</label>
                                <input type="text" class="form-control" id="office_address" value="{{ $member->office_address }}" name="office_address" placeholder="Office Address"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="office_phone">Office Phone</label>
                                <input type="text" class="form-control" id="office_phone" value="{{ $member->office_phone }}" name="office_phone" placeholder="Office Phone"/>
                            </div>
                            <div class="col-sm-3">
                                <label for="office_mobile">Office Mobile</label>
                                <input type="text" class="form-control" id="office_mobile" value="{{ $member->office_mobile }}" name="office_mobile" placeholder="Office Mobile"/>
                            </div>
                            <div class="col-sm-3">
                                <label for="office_email">Office Email</label>
                                <input type="text" class="form-control" id="office_email" value="{{ $member->office_email }}" name="office_email" placeholder="Email"/>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <label for="all_correspondence">All Correspondence: </label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input" id="present_addr" name="all_correspondence" {{ $member->all_correspondence==1?"checked":"" }} type="checkbox" value="1">
                                    <label for="present_addr">
                                        Present Address
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input" id="prmnt_addr" name="all_correspondence" {{ $member->all_correspondence==2?"checked":"" }} type="checkbox" value="2">
                                    <label for="prmnt_addr">
                                        Permanent Address
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="should_be_sent_to" style="align-items: center">Should be sent to: </label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input" id="should_be_sent_to" {{ $member->should_be_sent_to==1?"checked":"" }} name="should_be_sent_to" type="checkbox" value="1">
                                    <label for="should_be_sent_to">
                                        Office Address
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Have you ever been declined membership of this club?</label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input ever_declined1" id="ever_declined" {{ $member->ever_declined==1?"checked":"" }} name="ever_declined" type="checkbox" value="1">
                                    <label for="ever_declined">
                                        Yes
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input ever_declined2" id="ever_declined" {{ $member->ever_declined==0?"checked":"" }} name="ever_declined" type="checkbox" value="0">
                                    <label for="ever_declined">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="details_of_decline">If yes, furnish details</label>
                                <input type="text" class="form-control" id="details_of_decline" value="{{$member->details_of_decline}}" name="details_of_decline" placeholder="Details"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Have your membership application ever been rejected by other club/inst.?</label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input application_rejected1" id="application_rejected1" {{ $member->application_rejected==1?"checked":"" }} name="application_rejected" type="checkbox" value="1">
                                    <label for="application_rejected1">
                                        Yes
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input application_rejected2" id="application_rejected2" {{ $member->application_rejected==0?"checked":"" }} name="application_rejected" type="checkbox" value="0">
                                    <label for="application_rejected2">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="details_of_reject">If yes, furnish details</label>
                                <input type="text" class="form-control" id="details_of_reject" name="details_of_reject" value="{{$member->details_of_reject}}"  placeholder="Details"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Ever punished for criminal ofence?</label>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input criminal_ofence1" id="criminal_ofence1" {{ $member->criminal_ofence==1?"checked":"" }} name="criminal_ofence" type="checkbox" value="1">
                                    <label for="criminal_ofence1">
                                        Yes
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input criminal_ofence1" id="criminal_ofence2" {{ $member->criminal_ofence==0?"checked":"" }} name="criminal_ofence" type="checkbox" value="0">
                                    <label for="criminal_ofence2">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="details_of_criminal_ofence">If yes, furnish details</label>
                                <input type="text" class="form-control" id="details_of_criminal_ofence" value="{{$member->details_of_criminal_ofence}}" name="details_of_criminal_ofence" placeholder="Details"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="car_owned">Car owned?</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                      <input type="checkbox" class="car_owned1"  name="car_owned"  id="checkboxPrimary1" value="1"  {{ $member->car_owned==1?"checked":"" }}>
                                      <label for="checkboxPrimary1">
                                          Yes
                                      </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                      <input type="checkbox" class="car_owned2" name="car_owned"  id="checkboxPrimary2" value="0"  {{ $member->car_owned==0?"checked":"" }}>
                                      <label for="checkboxPrimary2">
                                          No
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="car_reg_no">Car registration number</label>
                                <input type="text" class="form-control" id="car_reg_no" name="car_reg_no" value="{{$member->car_reg_no}}" placeholder="Reg. No"/>
                            </div>
                            <div class="col-sm-4">
                                <label for="car_owned">Car ownership type?</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input name="car_ownership_type" type="checkbox" value="1"  id="car_ownership_type1" value="1"  {{ $member->car_ownership_type==1?"checked":"" }}>
                                        <label for="car_ownership_type1">
                                            Personal
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input name="car_ownership_type" type="checkbox" value="2" id="car_ownership_type2" value="2"  {{ $member->car_ownership_type==2?"checked":"" }}>
                                        <label for="car_ownership_type2">
                                        Office
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input name="car_ownership_type" type="checkbox" value="3" id="car_ownership_type3" value="3"  {{ $member->car_ownership_type==3?"checked":"" }}>
                                        <label for="car_ownership_type3">
                                            Rented
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================================================================================ -->
                    <div id="step_2" class='hidden'>
                        <div class="row">
                            <div class="form_part_heading" for="">Membership Details of Other Club/Institution/Association <span><i class="fa fa-question-circle" aria-hidden="true"></i></span></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
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
                                            @foreach($member->club_memberships as $club_membership)
                                                <tr>
                                                    <td><input type="text" name="club_name[]" class="form-control" value="{{$club_membership->club_name}}" placeholder="Club Name"/></td>
                                                    <td><input type="text" name="membership_no[]" class="form-control" value="{{$club_membership->membership_no}}"  placeholder="Membership Number"/></td>
                                                    <td><input type="text" name="membership_type[]" class="form-control" value="{{$club_membership->membership_type}}"  placeholder="Type of Membership/Position"/></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form_part_heading" for="">Spouse Details</div>
                        </div>
                        <div class='row'>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="spouse_name"> Name</label>
                                    <input type="text" class="form-control" id="spouse_name" name="spouse_name" value="{{$member->spouse_name}}" placeholder="Name"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="spouse_date_of_birth">Date of Birth</label>
                                    <input type="date" class="form-control" id="spouse_date_of_birth" value="{{date('Y-m-d',strtotime($member->spouse_date_of_birth))}}" name="spouse_date_of_birth"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="spouse_mobile_number">Mobile Number</label>
                                    <input type="text" class="form-control" id="spouse_mobile_number" name="spouse_mobile_number"  value="{{$member->spouse_mobile_number}}"  placeholder="Mobile Number" require/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="spouse_email">Spouse Email</label>
                                    <input type="text" class="form-control" id="spouse_email" name="spouse_email" value="{{$member->spouse_email}}"  placeholder="Email" require/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form_part_heading" for="">Dependant Details</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
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
                                            @foreach($member->dependants as $dependant)
                                                <tr>
                                                    <td><input type="text" name="dep_name[]" value="{{$dependant->dep_name}}" class="form-control" placeholder="Name"/></td>
                                                    <td><input type="date" name="dep_dob[]" value="{{$dependant->dep_dob}}" class="form-control" placeholder=""/></td>
                                                    <td><input type="text" name="dep_blood_group[]" value="{{$dependant->dep_blood_group}}"  class="form-control" placeholder="Blood Group"/></td>
                                                    <td><input type="text" name="dep_occupation[]" value="{{$dependant->dep_occupation}}"  class="form-control" placeholder="Occupation"/></td>
                                                    <td><input type="text" name="dep_nid[]" value="{{$dependant->dep_nid}}"  class="form-control" placeholder="NID"/></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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

                    <div class="" style="position: relative;width:100%;height: 50px;">
                        <button type="button" class="btn btn-info hidden btn-xs" id="prev" style="position: absolute; left: 0;"> Previous</button>
                        <button type="button" class="btn btn-success btn-xs" id=next style="position: absolute; right: 0;">Next </button>
                        <button type="submit" class="btn btn-success hidden btn-xs" id=save style="position: absolute; right: 50%;"><i class="nav-icon fas fa-save"></i> Update</button>
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
