@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .table td, .table th {
        padding: .1rem!important
    }
    .hidden{
        display:none
    }
@stop
@section('content')

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
                <form action="{{route('member-add')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div id="step_1">
                        <div class="row">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Member Type</label>
                                    <select class="form-control" id="member_type" name="member_type" value="{{ old('member_type') }}">
                                        <option value="">--Select--</option>
                                        <option value="1" {{old ('member_type') == 1 ? 'selected' : ''}}>Donor Member</option>
                                        <option value="2" {{old ('member_type') == 2 ? 'selected' : ''}}>Life Member</option>
                                        <option value="3" {{old ('member_type') == 3 ? 'selected' : ''}}>NRB Member</option>
                                        <option value="4" {{old ('member_type') == 4 ? 'selected' : ''}}>Genera Member</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="name">Member Name</label>
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
                                    <label for="college_roll">College Roll Number</label>
                                    <input type="text" id="college_roll" value="{{ old('college_roll') }}" name="college_roll" class="form-control" placeholder="College Roll Number"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" id="date_of_birth" value="{{ old('date_of_birth') }}" name="date_of_birth" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nid">NID Number</label>
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
                                        <option value="1">Married</option>
                                        <option value="2">Single</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="date_of_annniversary">Date of Anniversary</label>
                                    <input type="date" id="date_of_annniversary" name="date_of_annniversary" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="no_of_dependants">No. Of Dependants</label>
                                    <input type="number" id="no_of_dependants" name="no_of_dependants" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="fathers_name">Father's Name</label>
                                    <input type="text" class="form-control" id="fathers_name" name="fathers_name" placeholder="Father's Name"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="mothers_name">Mothers's Name</label>
                                    <input type="text" class="form-control" id="mothers_name" name="mothers_name" placeholder="Mother's Name"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="mobile_number">Mobile Number</label>
                                    <input type="text" class="form-control" value="{{ old('mobile_number') }}" id="mobile_number" name="mobile_number" placeholder="Mobile Number" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="occupation_type">Occupation Type</label>
                                    <select class="form-control" id="occupation_type" name="occupation_type" require>
                                        <option value="">--Select--</option>
                                        <option value="1">Service</option>
                                        <option value="2">Self Employed</option>
                                        <option value="3">Retired</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Educational Background</label>
                                    <table id="" class="table  table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Name of the Institution</th>
                                                <th>Passing Year</th>
                                                <th>Degree//Qualification Obtained</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="institution_name[]" class="form-control" placeholder="Name of the Institution"/></td>
                                                <td><input type="text" name="passing_year[]" class="form-control" placeholder="Passing Year"/></td>
                                                <td><input type="text" name="degree[]" class="form-control" placeholder="Degree"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="institution_name[]" class="form-control" placeholder="Name of the Institution"/></td>
                                                <td><input type="text" name="passing_year[]" class="form-control" placeholder="Passing Year"/></td>
                                                <td><input type="text" name="degree[]" class="form-control" placeholder="Degree"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="institution_name[]" class="form-control" placeholder="Name of the Institution"/></td>
                                                <td><input type="text" name="passing_year[]" class="form-control" placeholder="Passing Year"/></td>
                                                <td><input type="text" name="degree[]" class="form-control" placeholder="Degree"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="institution_name[]" class="form-control" placeholder="Name of the Institution"/></td>
                                                <td><input type="text" name="passing_year[]" class="form-control" placeholder="Passing Year"/></td>
                                                <td><input type="text" name="degree[]" class="form-control" placeholder="Degree"/></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="present_address">Present Address</label>
                                    <input type="text" class="form-control" value="{{ old('present_address') }}" id="present_address" name="present_address" placeholder="Present Address" require/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="permanent_address">Permanent Address</label>
                                    <input type="text" class="form-control" value="{{ old('permanent_address') }}"  id="permanent_address" name="permanent_address" placeholder="Permanent Address" require/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="company_name">Company Name</label>
                                <input type="text" class="form-control" id="company_name" value="{{ old('company_name') }}" name="company_name" placeholder="Company Name"/>
                            </div>
                            <div class="col-sm-4">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" id="designation" value="{{ old('designation') }}"  name="designation" placeholder="Designation"/>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="office_address">Office Address</label>
                                <input type="text" class="form-control" id="office_address" value="{{ old('office_address') }}" name="office_address" placeholder="Office Address"/>
                            </div>
                            <div class="col-sm-4">
                                <label for="office_phone">Office Phone</label>
                                <input type="text" class="form-control" id="office_phone" value="{{ old('office_phone') }}" name="office_phone" placeholder="Office Phone"/>
                            </div>
                            
                        </div>
                        <div class="row">
                        <div class="col-sm-4">
                                <label for="office_mobile">Office Mobile</label>
                                <input type="text" class="form-control" id="office_mobile" value="{{ old('office_mobile') }}" name="office_mobile" placeholder="Office Mobile"/>
                            </div>
                            <div class="col-sm-4">
                                <label for="office_email">Email</label>
                                <input type="text" class="form-control" id="office_email" value="{{ old('office_email') }}" name="office_email" placeholder="Email"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="all_correspondence">All Correspondence</label>
                                <div class="form-check">
                                        <input class="form-check-input" name="all_correspondence" type="checkbox" value="1">
                                        <label class="form-check-label">Present Address</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="all_correspondence" type="checkbox" value="2">
                                    <label class="form-check-label">Permanent Address</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="should_be_sent_to">Should be sent to</label>
                                <div class="form-check">
                                        <input class="form-check-input" name="should_be_sent_to" type="checkbox" value="1">
                                        <label class="form-check-label">Office Address</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="ever_declined">Have you ever been declined membership of this club?</label>
                                <div class="form-check">
                                        <input class="form-check-input" name="ever_declined" type="checkbox">
                                        <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" name="ever_declined" type="checkbox">
                                        <label class="form-check-label">No</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="details_of_decline">If yes, furnish details</label>
                                <input type="text" class="form-control" id="details_of_decline" name="details_of_decline" placeholder="Details"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="application_rejected">Have your membership application ever been rejected by other club/inst.?</label>
                                <div class="form-check">
                                        <input class="form-check-input" name="application_rejected" type="checkbox">
                                        <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" name="application_rejected" type="checkbox">
                                        <label class="form-check-label">No</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="details_of_reject">If yes, furnish details</label>
                                <input type="text" class="form-control" id="details_of_reject" name="details_of_reject" placeholder="Details"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="criminal_ofence">Ever punished for criminal ofence?</label>
                                <div class="form-check">
                                        <input class="form-check-input" name="criminal_ofence" type="checkbox">
                                        <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" name="criminal_ofence" type="checkbox">
                                        <label class="form-check-label">No</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="details_of_criminal_ofence">If yes, furnish details</label>
                                <input type="text" class="form-control" id="details_of_criminal_ofence" name="details_of_criminal_ofence" placeholder="Details"/>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-4">
                                <label for="car_owned">Car owned?</label>
                                <div class="form-check">
                                        <input class="form-check-input" name="car_owned" type="checkbox">
                                        <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" name="car_owned" type="checkbox">
                                        <label class="form-check-label">No</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label for="car_reg_no">Car registration number</label>
                                <input type="text" class="form-control" id="car_reg_no" name="car_reg_no" placeholder="Reg. No"/>
                            </div>
                            <div class="col-sm-2">
                                <label for="car_owned">Car ownership type?</label>
                                <div class="form-check">
                                        <input class="form-check-input" name="car_ownership_type" type="checkbox">
                                        <label class="form-check-label">Personal</label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" name="car_ownership_type" type="checkbox">
                                        <label class="form-check-label">Office</label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" name="car_ownership_type" type="checkbox">
                                        <label class="form-check-label">Rented</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================================================================================ -->
                    <div id="step_2" class='hidden'>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Membership Details of Other Club/Institution/Association</label>
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
                                                <td><input type="text" name="club_name[]" class="form-control" placeholder="Club Name"/></td>
                                                <td><input type="text" name="membership_no[]" class="form-control" placeholder="Membership Number"/></td>
                                                <td><input type="text" name="membership_type[]" class="form-control" placeholder="Type of Membership/Position"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="club_name[]" class="form-control" placeholder="Club Name"/></td>
                                                <td><input type="text" name="membership_no[]" class="form-control" placeholder="Membership Number"/></td>
                                                <td><input type="text" name="membership_type[]" class="form-control" placeholder="Type of Membership/Position"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="club_name[]" class="form-control" placeholder="Club Name"/></td>
                                                <td><input type="text" name="membership_no[]" class="form-control" placeholder="Membership Number"/></td>
                                                <td><input type="text" name="membership_type[]" class="form-control" placeholder="Type of Membership/Position"/></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class='card card-info'>
                                    <div class="card-header">
                                        <h3 class="card-title">Spouse Details</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="spouse_name"> Name</label>
                                    <input type="text" class="form-control" id="spouse_name" name="spouse_name" placeholder="Name"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="spouse_date_of_birth">Date of Birth</label>
                                    <input type="date" class="form-control" id="spouse_date_of_birth" name="spouse_date_of_birth"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="spouse_mobile_number">Mobile Number</label>
                                    <input type="text" class="form-control" id="spouse_mobile_number" name="spouse_mobile_number" placeholder="Mobile Number" require/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="spouse_email">Email</label>
                                    <input type="text" class="form-control" id="spouse_email" name="spouse_email" placeholder="Email" require/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Dependent Details</label>
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
                                                <td><input type="text" name="dep_name[]" class="form-control" placeholder="Name"/></td>
                                                <td><input type="date" name="dep_dob[]" class="form-control" placeholder=""/></td>
                                                <td><input type="text" name="dep_blood_group[]" class="form-control" placeholder="Blood Group"/></td>
                                                <td><input type="text" name="dep_occupation[]" class="form-control" placeholder="Occupation"/></td>
                                                <td><input type="text" name="dep_nid[]" class="form-control" placeholder="NID"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="dep_name[]" class="form-control" placeholder="Name"/></td>
                                                <td><input type="date" name="dep_dob[]" class="form-control" placeholder=""/></td>
                                                <td><input type="text" name="dep_blood_group[]" class="form-control" placeholder="Blood Group"/></td>
                                                <td><input type="text" name="dep_occupation[]" class="form-control" placeholder="Occupation"/></td>
                                                <td><input type="text" name="dep_nid[]" class="form-control" placeholder="NID"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="dep_name[]" class="form-control" placeholder="Name"/></td>
                                                <td><input type="date" name="dep_dob[]" class="form-control" placeholder=""/></td>
                                                <td><input type="text" name="dep_blood_group[]" class="form-control" placeholder="Blood Group"/></td>
                                                <td><input type="text" name="dep_occupation[]" class="form-control" placeholder="Occupation"/></td>
                                                <td><input type="text" name="dep_nid[]" class="form-control" placeholder="NID"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="dep_name[]" class="form-control" placeholder="Name"/></td>
                                                <td><input type="date" name="dep_dob[]" class="form-control" placeholder=""/></td>
                                                <td><input type="text" name="dep_blood_group[]" class="form-control" placeholder="Blood Group"/></td>
                                                <td><input type="text" name="dep_occupation[]" class="form-control" placeholder="Occupation"/></td>
                                                <td><input type="text" name="dep_nid[]" class="form-control" placeholder="NID"/></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================================================================================ -->

                    <div id="step_3" class='hidden'>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class='card card-info'>
                                    <div class="card-header">
                                        <h3 class="card-title">Payment Details</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name</label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="branch_name">Branch Name</label>
                                    <input type="text" class="form-control" id="branch_name" name="branch_name"  placeholder="Branch Name"/>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="acc_no">Account Number</label>
                                    <input type="text" class="form-control" id="acc_no" name="acc_no" placeholder="Account Number"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="" style="position: relative;width:100%;height: 50px;">
                        <button type="button" class="btn btn-info hidden" id="prev" style="position: absolute; left: 0;"> << Previous</button>
                        <button type="button" class="btn btn-success" id=next style="position: absolute; right: 0;">Next >> </button>
                        <button type="submit" class="btn btn-success hidden" id=save style="position: absolute; right: 50%;"><i class="nav-icon fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop

@section('script')
    let step=0;
    $("#next").click(function(){
        step++;
        if(step==1)
        {
            $('#step_1').addClass('hidden')
            $('#step_2').removeClass('hidden')
        }
       
        $('#prev').removeClass('hidden')
        
        if(step==2)
        {
            $('#step_2').addClass('hidden')
            $('#step_3').removeClass('hidden')
            $('#next').addClass('hidden')
            $('#save').removeClass('hidden')
        }
    });

    $("#prev").click(function(){
        $('#step_1').removeClass('hidden')
        if(step==1)
        {
            $('#prev').addClass('hidden')
            $('#step_2').addClass('hidden')
            $('#step_3').addClass('hidden')
        }
        if(step==2)
        {
            $('#step_1').addClass('hidden')
            $('#step_2').removeClass('hidden')
            $('#step_3').addClass('hidden')
            $('#next').removeClass('hidden')
            $('#save').addClass('hidden')
        }
        step--;
        
        
    });
@stop