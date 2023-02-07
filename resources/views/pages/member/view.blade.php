@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .table td, .table th {
        padding: .2rem;
    }
    .section_title{
        color:#4fa2e8;
        font-size:14px;
        font-weight:bold;
        border-bottom: 1px dashed #6b6b6b61
    }
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
@stop
@php
    $class=array();
@endphp
@section('content')
<div class="row">
<div class="col-md-4">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            @role('member')
                <a href="{{route('member-profile-update')}}" title="Edit" class="no-print">-<i class="fas fa-pencil-alt mr-1" aria-hidden="true" style="color: #db0049"></i>Edit</a>
                <a title="Print" class="no-print" style="cursor: pointer" onclick="window.print()"><i class="fas fa-print mr-1" aria-hidden="true" style="color: #db0049"></i>Print</a>
            @else
                <a href="{{route('member-edit',$member->id)}}" title="Edit" class="no-print badge badge-warning"><i class="fas fa-pencil-alt mr-1" aria-hidden="true" style=""></i>Edit</a>
                <a title="Print" class="no-print badge badge-primary" style="cursor: pointer" onclick="window.print()"><i class="fas fa-print mr-1" aria-hidden="true" style=""></i>Print</a>
                <a data-toggle="modal" data-target="#modal-default" class="badge badge-danger no-print" style="cursor: pointer"><i class="fa fa-id-card-alt"></i> Add Classification</a>
            @endrole
            <div class="text-center">
                <img style="width: 140px" src="{{asset('public/storage/member_photo/'.$member->member_photo)}}" alt="">
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
                            <p>Registration Date: <b>{{date('d-m-Y',strtotime($member->registration_date))}}</b></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{$member->first_name}} </td>
                </tr>
                <tr>
                    <td>Member ID</td>
                    <td><b>{{$member->member_code}}</b> </td>
                </tr>
                {{--<tr>--}}
                    {{--<td>Last Name</td>--}}
                    {{--<td>{{$member->first_name}} </td>--}}
                {{--</tr>--}}
                <tr>
                    <td>Member Type </td>
                    <td><span class="badge" style="font-size: 10px;background-color: #256b35;color: #fff;">{{$member->member_type}}</span></td>
                </tr>
                @if(!empty($member->classifications))
                    <tr>
                        <td colspan="2"><span class="text-info text-bold">Membership Level</span></td>
                    </tr>
                    @foreach($member->classifications as $classification)
                        @php $class[$classification->id]=$classification->id @endphp
                        <tr><td colspan="2"><i class="fa fa-star text-success"></i> {{$classification->name}}</td></tr>
                    @endforeach
                @endif
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
                    <td>Marital Status  </td>
                    <td>{{$member->marital_status==1?"Married":"Single"}} </td>
                </tr>
                <tr>
                    <td>Date of Anniversary</td>
                    <td>{{date('d-m-Y',strtotime($member->date_of_annniversary))}} </td>
                </tr>
                <tr>
                    <td>NID </td>
                    <td>{{$member->nid}} </td>
                </tr>
                <tr>
                    <td>Passport No. </td>
                    <td>{{$member->passport}} </td>
                </tr>
                <tr>
                    <td>Occupation type </td>
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
                    <td>Proposed By</td>
                    <td>{{$member->proposed_member}}</td>
                </tr>
                <tr>
                    <td>Seconded By</td>
                    <td>{{$member->seconded_member}}</td>
                </tr>
                <tr class="no-print">
                    <td colspan="2"><span class="text-blue text-bold">Attachments</span></td>
                </tr>
                @if(isset($member->member_nid_file) && !empty($member->member_nid_file))
                    <tr class="no-print">
                        <td><i class="fa fa-paperclip text-danger"></i> NID Document</td>
                        <td><a href="{{route('member-doc-preview',[$member->member_nid_file,'nid'])}}" target="_blank">Preview</a></td>
                    </tr>
                @endif
                @if(isset($member->member_hsc_doc) && !empty($member->member_hsc_doc))
                    <tr class="no-print">
                        <td><i class="fa fa-paperclip text-danger"></i> HSC Certificate</td>
                        <td><a href="{{route('member-doc-preview',[$member->member_hsc_doc,'hsc'])}}" target="_blank">Preview</a></td>
                    </tr>
                @endif
                @if(isset($member->member_hsc_doc) && !empty($member->member_tin_doc))
                    <tr class="no-print">
                        <td><i class="fa fa-paperclip text-danger"></i> TIN Certificate</td>
                        <td><a href="{{route('member-doc-preview',[$member->member_tin_doc,'tin'])}}" target="_blank">Preview</a></td>
                    </tr>
                @endif
            </table>
            
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <div class="col-md-8">
        <!-- Main content -->
        @if($member->status==1)
            <div class="alert no-print" style="background-color: #c7f7c2;font-size: 14px">
                <i class="fa fa-check" aria-hidden="true"></i> Membership application approved!
            </div>
        @elseif($member->status==-1)
            <div class="alert no-print" style="background-color: #dc3545;font-size: 14px;color:#fff">
                <i class="fa fa-spinner fa-pulse"></i> Approval pending!
            </div>
        @endif
        @if(session('message'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        {{session('message')}}
                    </div>
                </div>
            </div>
        @endif
        <div class="invoice p-3 mb-3">
            <!-- info row -->
            <p class="section_title">Personal Information</p>
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
                            <td>Spouse Mobile No.  </td>
                            <td>:</td>
                            <td>{{$member->spouse_mobile_number}}</td>
                        </tr>
                        <tr>
                            <td>Spouse Phone No. </td>
                            <td>:</td>
                            <td>{{$member->spouse_mobile_number}} </td>
                        </tr>
                        <tr>
                            <td>Spouse Email </td>
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
            @if(!empty($member->education))
                <div class="row">
                    <div class="col-12 table-responsive">
                        <p class="section_title">Educational Background</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name of the Institution</th>
                                    <th>Passing Year</th>
                                    <th>Degree/Qualification Obtained</th>
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
            @endif

            @if(!empty($member->club_memberships))
                <div class="row">
                    <div class="col-12 table-responsive">
                        <p class="section_title">Other Club Memberships</h4>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Club Name</th>
                                <th>Membership Number</th>
                                <th>Type of Membership/Position</th>
                            </tr>
                            </thead>
                            <tbody id="dep_list">
                            @foreach($member->club_memberships as $club_memberships)
                                <tr>
                                    <td>{{$club_memberships->club_name}}</td>
                                    <td>{{$club_memberships->membership_no}}</td>
                                    <td>{{$club_memberships->membership_type}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if(!empty($member->dependants))
                <div class="row">
                    <div class="col-12 table-responsive">
                        <p class="section_title">Dependants Details</h4>
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
                            <tbody id="dep_list">
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
            @endif
            <!-- /.row -->
        </div>
        <!-- /.invoice -->
    </div><!-- /.col -->
</div>
@unlessrole('member')
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Classification</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="classification_form" method="POST" action="{{route('classification-add')}}">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="member_no" value="{{$member->id}}">
                        @foreach($classifications as $key=>$classification)
                            @if($key%2==0)
                                <div class="col-6">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox"  name="classifications[]" @php echo isset($class[$classification->id])?"checked":"" @endphp  id="{{$key}}" value="{{$classification->id}}">
                                            <label for="{{$key}}">
                                                {{$classification->name}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-6">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox"  name="classifications[]" @php echo isset($class[$classification->id])?"checked":"" @endphp   id="{{$key}}" value="{{$classification->id}}">
                                            <label for="{{$key}}">
                                                {{$classification->name}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-warning btn-xs" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-xs" id="save_classification">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endrole
@stop
@section('script_link')
    <script src="{{asset('js/classification.js')}}"></script>
@stop