@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .table td, .table th {
        padding: .2rem;
    }
@stop
@section('content')
<div class="row">
<div class="col-md-3">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        
        <div class="card-body box-profile">
            <a href="" title="Edit"><i class="fas fa-pencil-alt mr-1" aria-hidden="true" style="color: #db0049"></i></a>
            <div class="text-center">
                <img src="{{asset('storage/member_photo/'.$member->member_photo)}}" alt="">
            </div>
            <h3 class="profile-username text-center">{{$member->first_name}}</h3>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- About Me Box -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Info</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table no-border">
                <tr>
                    <td colspan="2">
                        <div class="callout callout-danger">
                            <p>Registration Date: {{date('d-m-Y',strtotime($member->registration_date))}}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td>{{$member->first_name}} </td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>{{$member->first_name}} </td>
                </tr>
                <tr>
                    <td>Member Type </td>
                    <td>{{$member->member_type}} </td>
                </tr>
                <tr>
                    <td>Blood Group </td>
                    <td>{{$member->blood_group}}</td>
                </tr>
                <tr>
                    <td>College Roll No. </td>
                    <td>{{$member->college_roll}} </td>
                </tr>
                <tr>
                    <td>Date of Birth </td>
                    <td>{{date('d-m-Y',strtotime($member->date_of_birth))}} </td>
                </tr>
                <tr>
                    <td>NID </td>
                    <td>{{$member->nid}} </td>
                </tr>
                <tr>
                    <td>Passport No. </td>
                    <td>{{$member->passport}} </td>
                </tr>
            </table>
            
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <div class="col-9">
        <!-- Main content -->
        
        <div class="invoice p-3 mb-3">
            <!-- info row -->
                <h4>Personal Information</h4>
            <div class="row invoice-info">

                <div class="col-sm-6 invoice-col">
                    <table class="table no-border">
                        <tr>
                            <td>Father's Name  </td>
                            <td>:</td>
                            <td>{{$member->fathers_name}} </td>
                        </tr>
                        <tr>
                            <td>Mother's Name  </td>
                            <td>:</td>
                            <td>{{$member->mothers_name}} </td>
                        </tr>
                        <tr>
                            <td>Mobile No.  </td>
                            <td>:</td>
                            <td>{{$member->mobile_number}}</td>
                        </tr>
                        <tr>
                            <td>Phone No. </td>
                            <td>:</td>
                            <td>{{$member->phone_number}} </td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td>:</td>
                            <td>{{$member->email}}</td>
                        </tr>
                        <tr>
                            <td>Number of Dependants  </td>
                            <td>:</td>
                            <td>{{$member->no_of_dependants}} </td>
                        </tr>
                        <tr>
                            <td>Permanent address  </td>
                            <td>:</td>
                            <td>{{$member->permanent_address}} </td>
                        </tr>
                        <tr>
                            <td>Present address  </td>
                            <td>:</td>
                            <td>{{$member->present_address}}</td>
                        </tr>
                        <tr>
                            <td>Occupation type </td>
                            <td>:</td>
                            <td>
                                @if($member->occupation_type==1)
                                    Service
                                @elseif($member->occupation_type==2)
                                    Self Employed
                                @else
                                    Retired
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Company name </td>
                            <td>:</td>
                            <td>{{$member->company_name}} </td>
                        </tr>
                        <tr>
                            <td>Designation </td>
                            <td>:</td>
                            <td>{{$member->designation}} </td>
                        </tr>
                        <tr>
                            <td>Office address  </td>
                            <td>:</td>
                            <td>{{$member->office_address}} </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-4 invoice-col">
                    <table class="table no-border">
                        <tr>
                            <td>Office phone </td>
                            <td>:</td>
                            <td>{{$member->office_phone}}</td>
                        </tr>
                        <tr>
                            <td>Office mobile </td>
                            <td>:</td>
                            <td>{{$member->office_mobile}} </td>
                        </tr>
                        <tr>
                            <td>Office Email </td>
                            <td>:</td>
                            <td>{{$member->office_email}}</td>
                        </tr>
                        <tr>
                            <td>Spouse Name  </td>
                            <td>:</td>
                            <td>{{$member->spouse_name}} </td>
                        </tr>
                        <tr>
                            <td>Date of Birth  </td>
                            <td>:</td>
                            <td>{{$member->spouse_date_of_birth}} </td>
                        </tr>
                        <tr>
                            <td>Mobile No.  </td>
                            <td>:</td>
                            <td>{{$member->spouse_mobile_number}}</td>
                        </tr>
                        <tr>
                            <td>Phone No. </td>
                            <td>:</td>
                            <td>{{$member->spouse_mobile_number}} </td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td>:</td>
                            <td>{{$member->spouse_email}}</td>
                        </tr>
                        <tr>
                            <td>Car owned   </td>
                            <td>:</td>
                            <td>{{$member->car_owned==0?'No':'Yes'}} </td>
                        </tr>
                        <tr>
                            <td>Car registration no.  </td>
                            <td>:</td>
                            <td>{{$member->car_reg_no}} </td>
                        </tr>
                        <tr>
                            <td>Car ownership type  </td>
                            <td>:</td>
                            <td>
                                @if($member->car_ownership_type==1)
                                    Personal
                                @elseif($member->car_ownership_type==2)
                                    Office
                                @else
                                    Rented
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <h4>Educational Background</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name of the Institution</th>
                                <th>Passing Year</th>
                                <th>Degree//Qualification Obtained</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($member->education as $education)
                                <tr>
                                    <td>{{$education->institution_name}}</td>
                                    <td>{{$education->passing_year}}</td>
                                    <td>{{$education->degree}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            <!-- /.col -->
            </div>
            
            <hr>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <table class="table no-border">

                    </table>
                </div>
                <div class="col-sm-4 invoice-col">
                    <table class="table no-border">

                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-12 table-responsive">
                    <h4>Dependants Details</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date of Birth</th>
                                <th>Blood Group</th>
                                <th>Occupation</th>
                                <th>NID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($member->dependants as $dependant)
                                <tr>
                                    <td>{{$dependant->dep_name}}</td>
                                    <td>{{$dependant->dep_dob}}</td>
                                    <td>{{$dependant->dep_blood_group}}</td>
                                    <td>{{$dependant->dep_occupation}}</td>
                                    <td>{{$dependant->dep_nid}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.invoice -->
    </div><!-- /.col -->
</div>
@stop