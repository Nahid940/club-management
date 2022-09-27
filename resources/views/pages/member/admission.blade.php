@extends('main')
@section('pageHeading'){{$title}}@stop
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">General Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Member Type</label>
                                <select class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="1">Donor Member</option>
                                    <option value="2">Life Member</option>
                                    <option value="3">NRB Member</option>
                                    <option value="4">Genera Member</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="name">Member Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Member Name"/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- textarea -->
                            <div class="form-group">
                                <label for="blood_group">Blood Group</label>
                                <select class="form-control" id="blood_group" name="blood_group" require>
                                    <option value="">--Select--</option>
                                    <option value="1">A+</option>
                                    <option value="2">A-</option>
                                    <option value="3">AB+</option>
                                    <option value="4">AB-</option>
                                    <option value="4">O+</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="college_roll">College Roll Number</label>
                                <input type="text" id="college_roll" name="college_roll" class="form-control" placeholder="College Roll Number"/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                    </div>

                    <!-- input states -->
                    <div class="form-group">
                        <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with
                            success</label>
                        <input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ...">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Input with
                            warning</label>
                        <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Input with
                            error</label>
                        <input type="text" class="form-control is-invalid" id="inputError" placeholder="Enter ...">
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- checkbox -->
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Checkbox</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Checkbox checked</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled>
                                    <label class="form-check-label">Checkbox disabled</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- radio -->
                            <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio1">
                                <label class="form-check-label">Radio</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio1" checked>
                                <label class="form-check-label">Radio checked</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" disabled>
                                <label class="form-check-label">Radio disabled</label>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                            <label>Select</label>
                            <select class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label>Select Disabled</label>
                            <select class="form-control" disabled>
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- Select multiple-->
                            <div class="form-group">
                            <label>Select Multiple</label>
                            <select multiple class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label>Select Multiple Disabled</label>
                            <select multiple class="form-control" disabled>
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>



@stop