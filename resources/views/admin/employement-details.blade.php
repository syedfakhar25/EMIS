@extends('layouts.master')

@section('title')
    Employment Details
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3> Initial Appointment Details
                            <span style="color: #777777"> - Step 2</span>
                        </h3>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-info" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
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
                                <form action="/employement-details/{{ $employee_id }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @if (count($employee->EmployementDetails) > 0)
                                        @foreach ($employee->EmployementDetails as $ed)
                                            <div class="myqual">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="{{ url('employement-details/' . $ed->employee_id . '/' . $ed->id) }}"
                                                           class="btn btn-danger float-right">Edit</a>
                                                        @php $link = 'employee_verify/'; @endphp
                                                        @include('admin.verification')
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Emp
                                                            Status:</label> {{ Str::ucfirst($ed->emp_status) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Designation:</label>

                                                        @if(is_numeric($ed->designation))

                                                            @if(!empty(\App\Models\Designation::find($ed->designation)->first()))
                                                                {{\App\Models\Designation::find($ed->designation)->designation_name}}
                                                            @endif

                                                        @else
                                                            {{$ed->designation}}
                                                        @endif

                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Bps:</label>{{ $ed->bps }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Time
                                                            Scale:</label> {{ $ed->time_scale }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Time Scale
                                                            Date:</label>

                                                        @if(empty($ed->time_scale_date))
                                                            N/A
                                                        @else
                                                            {{ \Carbon\Carbon::parse($ed->time_scale_date)->format('d-m-Y') }}
                                                        @endif


                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Initial Appointment:</label>
                                                        @if(empty($ed->appointment_date))
                                                            N/A
                                                        @else
                                                            {{ \Carbon\Carbon::parse($ed->appointment_date)->format('d-m-Y') }}
                                                        @endif
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Selection PSC Date:</label>

                                                        @if(empty($ed->selection_psc_date))
                                                            N/A
                                                        @else
                                                            {{ \Carbon\Carbon::parse($ed->selection_psc_date)->format('d-m-Y') }}
                                                        @endif

                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Join
                                                            Date:</label>

                                                        @if(empty($ed->join_date))
                                                            N/A
                                                        @else
                                                            {{ \Carbon\Carbon::parse($ed->join_date)->format('d-m-Y') }}
                                                        @endif


                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Gross
                                                            Salary:</label>{{ $ed->gross_salary }}
                                                    </div>
                                                    @if ($ed->image)
                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Image:</label>
                                                            <a href="{{ asset('uploads/employee/' . $ed->image) }}"
                                                               target="_blank">Show Appointment
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <hr width="100%" style="margin-top: 3rem">
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="myqual">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="file" name="filelogo[]" for="exampleInputEmail1"
                                                           class="form-control-file">
                                                    <label class="form-label  mt-0" for="file">Any file or
                                                        Notification</label>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Emp
                                                        Status*</label>

                                                    <select name="emp_status[]" class="form-control " required>
                                                        <option value="" class="form-control"> --Select--</option>
                                                        <option value="permanent" class="form-control"> Permanent
                                                        </option>
                                                        <option value="adhoc" class="form-control"> Adhoc</option>
                                                        <option value="deputation" class="form-control">Deputation
                                                        </option>
                                                        <option value="contract" class="form-control"> Contract
                                                        </option>
                                                        <option value="internee" class="form-control">Internee</option>
                                                        <option value="temporary" class="form-control">Temporary
                                                        </option>
                                                        <option value="Work Charge" class="form-control">Work Charge
                                                        </option>
                                                        <option value="Contingent Paid" class="form-control">Contingent
                                                            Paid
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1"
                                                           class="col-md-6">Designation*</label>

                                                    @if(auth()->user()->usertype === "admin")
                                                        @php
                                                            $designationList = \App\Models\Designation::all();
                                                        @endphp
                                                        <select name="designation[]" class="form-control">
                                                            <option value="">--Select--</option>
                                                            {!! \App\User::getDesignationByDepartment($employee->dep_id, $employee->designation) !!}
                                                        </select>
                                                    @else
                                                        @php
                                                            $designationList = \App\Models\Designation::where('dep_id',$employee->dep_id)->get();
                                                        @endphp
                                                        <select name="designation[]" class="form-control">
                                                            <option value="">--Select--</option>
                                                            {!! \App\User::getDesignationByDepartment($employee->dep_id, $employee->designation) !!}
                                                        </select>
                                                    @endif

                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> BPS</label>
                                                    <input type="text" name="bps[]" value="{{ old('bps') }}"
                                                           class="form-control ">
                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Time
                                                        Scale</label>
                                                    <input type="text" name="time_scale[]"
                                                           value="{{ old('time_scale') }}" class="form-control ">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Time Scale
                                                        Date*</label>
                                                    <input type="date" name="time_scale_date[]"
                                                           value="{{ old('time_scale_date') }}" class="form-control ">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Initial
                                                        Appointment
                                                        Date </label>
                                                    <input type="date" name="appointment_date[]"
                                                           value="{{ old('appointment_date') }}" class="form-control">
                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Date of Selection
                                                        / PSC</label>
                                                    <input type="date" name="selection_psc_date[]"
                                                           value="{{ old('selection_psd_date') }}" class="form-control">
                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Join Date</label>
                                                    <input type="date" name="join_date[]" value="{{ old('join_date') }}"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Gross
                                                        Salary</label>
                                                    <input type="number" name="gross_salary[]"
                                                           value="{{ old('gross_salary') }}" class="form-control ">
                                                </div>
                                                <hr width="100%" style="margin-top: 3rem">
                                            </div>

                                            <div class="col-md-12" align="center">
                                                <button type="submit" name="submit" value="Save" class="btn btn-info">
                                                    Save
                                                </button>
                                                <button type="submit" name="submit" value="Next"
                                                        class="btn btn-primary">
                                                    Save & Next
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    {{--an empty div to append ADD MORE fields--}}
                                    <div class="myrow">

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3" align="left">
                                            {{-- <a id="add_more" type="" class="btn btn-success"> Add More</a> --}}
                                        </div>

                                        <div class="col-md-6" align="center">
                                        </div>
                                        <div class="">

                                        </div>
                                        <div class="col-md-3" align="right">
                                            <a href="/qualifications/{{ $employee_id }}/edit" type=""
                                               class="btn btn-danger"> Skip </a>
                                        </div>
                                    </div>

                                </form>
                                <div class="newqual" style="display: none">
                                    <div class="row">
                                        <div class="cross col-md-6">
                                            <a href="javascript:0;" class=""><i
                                                    class="now-ui-icons ui-1_simple-remove"></i></a>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="file" name="filelogo[]" for="exampleInputEmail1"
                                                   class="form-control-file">
                                            <label class="form-label  mt-0" for="file">Any file or notification</label>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Employment Status*</label>
                                            <select name="emp_status[]" class="form-control " required>
                                                <option value="" class="form-control"> --Select--</option>
                                                <option value="permanent" class="form-control"> Permanent
                                                </option>
                                                <option value="adhoc" class="form-control">
                                                    Adhoc
                                                </option>


                                                <option value="deputation" class="form-control">
                                                    Deputation
                                                </option>
                                                <option value="contract" class="form-control">
                                                    Contract
                                                </option>
                                                <option value="internee" class="form-control">Internee</option>
                                                <option value="temporary" class="form-control">Temporary</option>
                                                <option value="Work Charge" class="form-control">Work Charge</option>
                                                <option value="Contingent Paid" class="form-control">Contingent Paid
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Designation*</label>
                                            <input type="text" name="designation[]" value="" class="form-control "
                                                   minlength="3" required>
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> BPS</label>
                                            <input type="text" name="bps[]" value="" class="form-control">
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Time Scale</label>
                                            <input type="text" name="time_scale[]" value="" class="form-control">
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Time Scale Date</label>
                                            <input type="date" name="time_scale_date[]" value="" class="form-control">
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6">Initial Appointment
                                                Date</label>
                                            <input type="date" name="appointment_date[]" value="" class="form-control">
                                        </div>


                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Join Date</label>
                                            <input type="date" name="join_date[]" value="" class="form-control">
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Gross Salary</label>
                                            <input type="number" name="gross_salary[]" value="" class="form-control">
                                        </div>
                                        <hr width="100%" style="margin-top: 3rem">


                                        <div class="col-md-12" align="center">
                                            <button type="submit" name="submit" value="Save" class="btn btn-info">
                                                Save
                                            </button>
                                            <button type="submit" name="submit" value="Next" class="btn btn-primary">
                                                Save & Next
                                            </button>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
