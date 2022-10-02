@extends('main')
@section('pageHeading'){{$title}}@stop
@section('content')
<div class="row">
<div class="col-md-3">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                    src="../../dist/img/user4-128x128.jpg"
                    alt="User profile picture">
            </div>
            <h3 class="profile-username text-center">Nina Mcintire</h3>
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
                    <td>Name</td>
                    <td>John </td>
                </tr>
                <tr>
                    <td>Member Type </td>
                    <td>John </td>
                </tr>
                <tr>
                    <td>Blood Group </td>
                    <td>O+ </td>
                </tr>
                <tr>
                    <td>College Roll No. </td>
                    <td>53453 </td>
                </tr>
                <tr>
                    <td>Date of Birth </td>
                    <td>2/10/2014 </td>
                </tr>
                <tr>
                    <td>NID </td>
                    <td>5463456354 </td>
                </tr>
                <tr>
                    <td>Passport No. </td>
                    <td>5463456354 </td>
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
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <small class="float-right">Registration Date: 2/10/2014</small>
                    </h4>
                </div>
            <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <table class="table no-border">
                        <tr>
                            <td>Father's Name  </td>
                            <td>FDFSD </td>
                        </tr>
                        <tr>
                            <td>Mother's Name  </td>
                            <td>53453 </td>
                        </tr>
                        <tr>
                            <td>Mobile No.  </td>
                            <td>3452345234</td>
                        </tr>
                        <tr>
                            <td>Phone No. </td>
                            <td>5463456354 </td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td>fsdfds@mil.com </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-4 invoice-col">
                    <table class="table no-border">
                        <tr>
                            <td>Number of Dependants  </td>
                            <td>FDFSD </td>
                        </tr>
                        <tr>
                            <td>Permanent address  </td>
                            <td>53453 </td>
                        </tr>
                        <tr>
                            <td>Present address  </td>
                            <td>3452345234</td>
                        </tr>
                        <tr>
                            <td>Occupation type </td>
                            <td>5463456354 </td>
                        </tr>
                        <tr>
                            <td>Company name </td>
                            <td>RREDFF </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-4 invoice-col">
                    <table class="table no-border">
                        <tr>
                            <td>Designation </td>
                            <td>FDFSD </td>
                        </tr>
                        <tr>
                            <td>Office address  </td>
                            <td>53453 </td>
                        </tr>
                        <tr>
                            <td>Office phone </td>
                            <td>3452345234</td>
                        </tr>
                        <tr>
                            <td>Office mobile </td>
                            <td>5463456354 </td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td>ewrwe@mail.com </td>
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
                            <tr>
                                <td>Call of Duty</td>
                                <td>455-981-221</td>
                                <td>El snort testosterone trophy driving gloves handsome</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <!-- /.col -->
            </div>
            
            <hr>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <table class="table no-border">
                        <tr>
                            <td>Spouse Name  </td>
                            <td>FDFSD </td>
                        </tr>
                        <tr>
                            <td>Date of Birth  </td>
                            <td>53453 </td>
                        </tr>
                        <tr>
                            <td>Mobile No.  </td>
                            <td>3452345234</td>
                        </tr>
                        <tr>
                            <td>Phone No. </td>
                            <td>5463456354 </td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td>fsdfds@mil.com </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-4 invoice-col">
                    <table class="table no-border">
                        <tr>
                            <td>Car owned   </td>
                            <td>FDFSD </td>
                        </tr>
                        <tr>
                            <td>Car registration no.  </td>
                            <td>534534324 </td>
                        </tr>
                        <tr>
                            <td>Car ownership type  </td>
                            <td>Personal</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-12 table-responsive">
                    <h4>Dependants Details</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name of the Institution</th>
                                <th>Passing Year</th>
                                <th>Degree//Qualification Obtained</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Call of Duty</td>
                                <td>455-981-221</td>
                                <td>El snort testosterone trophy driving gloves handsome</td>
                            </tr>
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