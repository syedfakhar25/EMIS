@extends('layouts.master')

@section('title')
    Add Qualification
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3> Employment Details
                            <span style="color: #777777"> - Step 3</span>
                        </h3>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-info" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(count($errors)>0)
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="alert alert-danger">add missing fields</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="card-body">
                        <style>
                            label {
                                font-weight: bold !important;
                                color: #000000 !important;
                            }
                        </style>
                        <div class="row">
                            <div class="col-md-12">

                                <form  action="{{url('employement-details/'. $employementDetails->employee_id . '/' . $employementDetails->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="myqual">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a href="{{ asset('uploads/employee/'. $employementDetails->image) }}"
                                                   target="_blank">
                                                    <img
                                                        src="{{ asset('uploads/employee/'. $employementDetails->image) }}"
                                                        width="200" height="auto">
                                                </a>
                                            </div>
                                            <hr>
                                            <div class="col-md-12" align="right">
                                                <input type="file" name="filelogo" for="exampleInputEmail1"
                                                       class="form-control-file">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Emp
                                                    Status*</label>
                                                <select name="emp_status" class="form-control " required>
                                                    <option value="" class="form-control"> --Select--</option>
                                                    <option value="permanent"
                                                            class="form-control" {{($employementDetails->emp_status =="permanent"?'selected':'')}}>
                                                        Permanent
                                                    </option>
                                                    <option value="adhoc"
                                                            class="form-control" {{($employementDetails->emp_status =="adhoc"?'selected':'')}}>
                                                        Adhoc
                                                    </option>

                                                    <option value="deputation"
                                                            class="form-control" {{($employementDetails->emp_status =="deputation"?'selected':'')}}>
                                                        Deputation
                                                    </option>
                                                    <option value="contract"
                                                            class="form-control" {{($employementDetails->emp_status =="contract"?'selected':'')}}>
                                                        Contract
                                                    </option>
                                                    <option value="internee"
                                                            class="form-control" {{($employementDetails->emp_status =="internee"?'selected':'')}}>
                                                        Internee
                                                    </option>
                                                    <option value="temporary"
                                                            class="form-control" {{($employementDetails->emp_status =="temporary"?'selected':'')}}>
                                                        Temporary
                                                    </option>

                                                    <option value="temporary"
                                                            class="form-control" {{($employementDetails->emp_status =="Work Charge"?'selected':'')}}>
                                                        Work Charge
                                                    </option>

                                                    <option value="temporary"
                                                            class="form-control" {{($employementDetails->emp_status =="Contingent Paid"?'selected':'')}}>
                                                        Contingent Paid
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 ">



                                                <label for="exampleInputEmail1" class="col-md-6">
                                                    Designation*</label>

                                                @if(auth()->user()->usertype === "admin")
                                                    @php
                                                        $designationList = \App\Models\Designation::all();
                                                    @endphp
                                                    <select name="designation" class="form-control">
                                                        <option value="">--Select--</option>
                                                        {!! \App\User::getDesignationByDepartment($employementDetails->user->dep_id, $employementDetails->designation) !!}
                                                    </select>
                                                @else
                                                    @php
                                                        $designationList = \App\Models\Designation::where('dep_id',$employementDetails->user->dep_id)->get();
                                                    @endphp
                                                    <select name="designation" class="form-control">
                                                        <option value="">--Select--</option>
                                                        {!! \App\User::getDesignationByDepartment($employementDetails->user->dep_id, $employementDetails->designation) !!}
                                                    </select>
                                                @endif

{{--                                                @php--}}
{{--                                                    $designationList = \App\Models\Designation::where('dep_id',$employementDetails->user->dep_id)->get();--}}
{{--                                                @endphp--}}
{{--                                                <select name="designation" class="form-control">--}}
{{--                                                    <option value="">--Select--</option>--}}
{{--                                                    @if($designationList->isNotEmpty())--}}
{{--                                                        @foreach($designationList as $desList)--}}
{{--                                                            <option value="{{$desList->id}}"--}}
{{--                                                                    @if($employementDetails->designation == $desList->id) selected @endif>{{$desList->designation_name}}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    @endif--}}
{{--                                                </select>--}}
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> BPS</label>
                                                <input type="text" name="bps" value="{{$employementDetails->bps}}"
                                                       class="form-control">
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Time
                                                    Scale</label>
                                                <input type="text" name="time_scale"
                                                       value="{{$employementDetails->time_scale}}"
                                                       class="form-control" >
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Time Scale
                                                    Date</label>
                                                <input type="date" name="time_scale_date"
                                                       value="{{$employementDetails->time_scale_date}}"
                                                       class="form-control">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Appointment
                                                    Date</label>
                                                <input type="date" name="appointment_date"
                                                       value="{{$employementDetails->appointment_date}}"
                                                       class="form-control ">
                                            </div>


                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Selection / PSC Date</label>
                                                <input type="date" name="appointment_date" value="{{$employementDetails->selection_psc_date}}" class="form-control ">
                                            </div>


                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Join Date</label>
                                                <input type="date" name="join_date"
                                                       value="{{$employementDetails->join_date}}"
                                                       class="form-control">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Gross
                                                    Salary</label>
                                                <input type="number" name="gross_salary"
                                                       value="{{$employementDetails->gross_salary}}"
                                                       class="form-control">
                                            </div>


                                            <hr width="100%" style="margin-top: 3rem">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" align="center">
                                                <button type="submit" name="submit" value="Update" class="btn btn-info">
                                                    Update
                                                </button>
                                            </div>
                                            <div class="col-md-3" align="right">
                                                <a href="/employement-details/{{$employementDetails->employee_id}}/edit" type=""
                                                   class="btn btn-danger"> Skip </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
