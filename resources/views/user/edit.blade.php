@extends('layouts.master')

@section('title')
    Personal Information
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header col-md-12">
                        <div class="col-md-12">
                            <h3> Personal Info
                                <span style="color: #777777"> - Step 1</span>
                            </h3>
                        </div>
                        <div class="col-md-4">

                        </div>

                    </div>


                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="alert alert-danger"> {{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div class="card-body">
                        <style>
                            label {
                                font-weight: bold !important;
                                color: #000000 !important;
                                margin-top: 25px;
                            }

                        </style>
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>
                                <form action="/employees/{{ $employees->id }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <div>
                                                <a href="javascript:;"><img
                                                        src="@if (!empty($employees->image)) {{ asset('uploads/employee/' . $employees->image) }}
                                         @elseif(strtolower($employees->gender) == 'female') {{ asset('assets/img/female.png') }}
                                         @else {{ asset('assets/img/male.png') }} @endif"
                                                        width="100px" height="auto" alt="Employee Profile Picture"
                                                        align="left"></a>
                                            </div>

                                            <input type="file" name="emp_img" id="profile_picture"
                                                   class="form-control ">
                                            <label class="form-label mt-0" for="profile_picture">Profile Picture</label>
                                        </div>
                                        <div class="col-md-6 ">
                                        </div>

                                        <div class="col-md-4 mt-0">
                                            <label for="personal_no"> Personal Number/DDO Code</label>
                                            <input type="text" name="personal_no" value="{{ $employees->personal_no }}"
                                                   class="form-control"
                                                   placeholder="SAP Personal Number-contained on Play Slip">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="emis_code">Emis Number </label>
                                            <input type="text" name="emis_code" value="{{ $employees->emis_code }}"
                                                   class="form-control " readonly>
                                        </div>
                                        {{--                                        @if(auth()->user()->dep_id == 89 || auth()->user()->dep_id == 1)--}}
                                        {{--                                            <div class="col-md-4">--}}
                                        {{--                                                <label for="emis_code">Choose Your Sub-Department/Section</label>--}}

                                        {{--                                                --}}{{--                                            <select name="abc+" class="form-control select2  " {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }}>--}}
                                        {{--                                                --}}{{--                                                <option value="" class="form-control @error('department') is-invalid @enderror">--}}
                                        {{--                                                --}}{{--                                                    --Select----}}
                                        {{--                                                --}}{{--                                                </option>--}}

                                        {{--                                                --}}{{--                                                @php $dep = \App\Models\Department::find($employees->dep_id); @endphp--}}
                                        {{--                                                --}}{{--                                                @foreach($dep->subDepartment as $sub)--}}
                                        {{--                                                --}}{{--                                                    <option value="">{{$sub->name}}</option>--}}
                                        {{--                                                --}}{{--                                                @endforeach--}}
                                        {{--                                                --}}{{--                                            </select>--}}
                                        {{--                                                @php $dep = \App\Models\Department::find($employees->dep_id); @endphp--}}
                                        {{--                                                --}}{{--                                            @php $dep = \App\Models\Department::find(89); @endphp--}}

                                        {{--                                                <select name="sub_dep_id" id="sub_dep_id"--}}
                                        {{--                                                        class="form-control select2  @error('sub_dep_id') is-invalid @enderror">--}}
                                        {{--                                                    <option value="">Choose Your Sub-Department/Section</option>--}}
                                        {{--                                                    @foreach($dep->subDepartment as $sub)--}}
                                        {{--                                                        <option value="{{$sub->id}}"--}}
                                        {{--                                                                @if($employees->sub_dep_id == $sub->id) selected @endif>{{$sub->name}}</option>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                </select>--}}

                                        {{--                                            </div>--}}
                                        {{--                                        @endif--}}


                                        @if($check_sub_department)
                                            <div class="col-md-4">
                                                <label for="emis_code">Choose Your Sub-Department/Section</label>
                                                <select name="sub_dep_id" id="sub_dep_id"
                                                        class="form-control select2  @error('sub_dep_id') is-invalid @enderror">
                                                    <option value="">Choose Your Sub-Department/Section</option>
                                                    @foreach($descendents as $sub)
                                                        <option value="{{$sub->id}}"
                                                                @if($employees->sub_dep_id == $sub->id) selected @endif>{{$sub->dep_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        <div class="col-md-12">
                                            <h4 class="mb-0  font-weight-bold">Personal Information</h4>
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1"> First Name*</label>
                                            <input type="text" name="first_name" value="{{ $employees->first_name }}"
                                                   class="form-control"
                                                   {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }} minlength="3">
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1">Middle Name</label>
                                            <input type="text" name="middle_name" value="{{ $employees->middle_name }}"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1">Last Name*</label>
                                            <input type="text" name="last_name" value="{{ $employees->last_name }}"
                                                   class="form-control"
                                                   {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }} minlength="3">
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1"> Father's/Husband First Name *</label>
                                            <input type="text" name="father_first_name"
                                                   value="{{ $employees->father_first_name }}" class="form-control "
                                                   {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }} minlength="3">
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1"> Father's/Husband Middle Name</label>
                                            <input type="text" name="father_middle_name"
                                                   value="{{ $employees->father_middle_name }}" class="form-control ">
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1"> Father's/Husband Last Name*</label>
                                            <input type="text" name="father_last_name"
                                                   value="{{ $employees->father_last_name }}" class="form-control"
                                                   {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }} minlength="3">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Gender* </label>
                                            <select name="gender"
                                                    class="form-control " {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }}>
                                                <option value=""
                                                        class="form-control @error('gender') is-invalid @enderror">
                                                    --Select--
                                                </option>
                                                <option value="male"
                                                        class="form-control" {{ $employees->gender == 'male' ? 'selected' : '' }}>
                                                    Male
                                                </option>
                                                <option value="female"
                                                        class="form-control" {{ $employees->gender == 'female' ? 'selected' : '' }}>
                                                    Female
                                                </option>
                                                <option value="other"
                                                        class="form-control" {{ $employees->gender == 'other' ? 'selected' : '' }}>
                                                    Other
                                                </option>
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1">CNIC*</label>
                                            <input class="form-control cnic_mask @error('cnic') is-invalid @enderror"
                                                   placeholder="00000-000000000-0" name="cnic" minlength="15"
                                                   maxlength="15" autocomplete="off"
                                                   {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }}
                                                   value="{{ $employees->cnic }}">
                                        </div>

                                        <div class="col-md-4 ">
                                            <label for="passport_no">Passport #</label>
                                            <input class="form-control @error('passport_no') is-invalid @enderror"
                                                   name="passport_no" minlength="6" maxlength="15"
                                                   value="{{ $employees->passport_no }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label> District Domicile</label>
                                            <select name="district_domicile" id="district_domicile"
                                                    class="form-control select2  @error('district_domicile') is-invalid @enderror" {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }}>
                                                <option value=""> Choose District</option>
                                                @foreach (\App\User::districts() as $region => $districts)
                                                    <optgroup label="{{ $region }}">
                                                        @foreach ($districts as $district)
                                                            <option
                                                                value="{{ $region }}:{{ $district }}" {{ $employees->district_domicile == $district && $employees->province_domicile == $region ? 'selected' : '' }}>{{ $district }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1"> Date of Birth*</label>
                                            <input type="date" name="birth_date" value="{{ $employees->birth_date }}"
                                                   max="{{ date('Y-m-d') }}"
                                                   class="form-control " {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }}>
                                        </div>

                                        <div class="col-md-4 ">
                                            <label> Marital Status* </label>
                                            <select name="marital_status"
                                                    class="form-control " {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }}>
                                                <option value="" class="form-control"> --Select--</option>
                                                <option value="married"
                                                        class="form-control" {{ $employees->marital_status == 'married' ? 'selected' : '' }}>
                                                    Married
                                                </option>
                                                <option value="un_married"
                                                        class="form-control" {{ $employees->marital_status == 'un_married' ? 'selected' : '' }}>
                                                    Un-Married
                                                </option>
                                                <option value="divorced"
                                                        class="form-control" {{ $employees->marital_status == 'divorced' ? 'selected' : '' }}>
                                                    Divorced
                                                </option>
                                                <option value="widow"
                                                        class="form-control" {{ $employees->marital_status == 'widow' ? 'selected' : '' }}>
                                                    Widow
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1"> Enter Email</label>
                                            <input type="text" name="email" value="{{ $employees->email }}" autocomplete="off"
                                                   class="form-control" {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }}>
                                        </div>


                                        <div class="col-md-4">
                                            <label for="ntn_no"> NTN No</label>
                                            <input type="text" name="ntn_no" value="{{ $employees->ntn_no }}"
                                                   class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="gpf_no"> GPF No</label>
                                            <input type="text" name="gpf_no" value="{{ $employees->gpf_no }}"
                                                   class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="residential_phone"> Residential Phone</label>
                                            <input type="number" name="residential_phone"
                                                   value="{{ $employees->residential_phone }}" class="form-control"
                                                   >
                                        </div>
                                        <div class="col-md-4">
                                            <label for="mobile_phone"> Mobile Phone</label>
                                            <input type="text" name="mobile_phone"
                                                   value="{{ $employees->mobile_phone }}" class="form-control"
                                                   >
                                        </div>

                                        <div class="col-md-4">
                                            <label for="whatsapp_number"> WhatsApp No</label>
                                            <input type="text" name="whatsapp_number"
                                                   value="{{ $employees->whatsapp_number }}" class="form-control"
                                                   >
                                        </div>

                                        <div class="col-md-4">
                                            <label for="fax_number"> Fax Phone (03001234567)</label>
                                            <input type="text" name="fax_number" value="{{ $employees->fax_number }}"
                                                   class="form-control " pattern="[0-9]{4}[0-9]{7}"
                                                   >
                                        </div>


                                        <div class="col-md-4">
                                            <label for="next_of_kin"> Next of Kin</label>
                                            <input type="text" name="next_of_kin" value="{{ $employees->next_of_kin }}"
                                                   class="form-control ">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="relationship">Relationship</label>
                                            <input type="text" name="relationship"
                                                   value="{{ $employees->relationship }}" class="form-control ">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="office_phone"> Office Phone</label>
                                            <input type="number" name="office_phone"
                                                   value="{{ $employees->office_phone }}" class="form-control "
                                                   pattern="[0-9]{4}[0-9]{7}" >
                                        </div>
                                        <div class="col-md-4">
                                            <label for="birth_place">Place of Birth</label>
                                            <input type="text" name="birth_place" value="{{ $employees->birth_place }}"
                                                   class="form-control">
                                        </div>

                                        <div class="col-md-4 ">
                                            <label> State Refugee Status</label>
                                            <select name="refugee_status" class="form-control ">
                                                <option value="" class="form-control"> --Select--</option>
                                                <option value="1947"
                                                        class="form-control" {{ $employees->refugee_status == '1947' ? 'selected' : '' }}>
                                                    1947
                                                </option>
                                                <option value="1965"
                                                        class="form-control" {{ $employees->refugee_status == '1965' ? 'selected' : '' }}>
                                                    1965
                                                </option>
                                                <option value="1989"
                                                        class="form-control" {{ $employees->refugee_status == '1989' ? 'selected' : '' }}>
                                                    1989
                                                </option>
                                            </select>
                                        </div>


                                        <div class="col-md-4 ">
                                            <label>Blood Group</label>
                                            <select name="blood_group" class="form-control ">
                                                <option value="" class="form-control"> --Select--</option>
                                                @foreach(\App\User::bloodGroup() as $bgroup)
                                                    <option value="{{$bgroup}}"
                                                            class="form-control" {{ $employees->blood_group == $bgroup ? 'selected' : '' }}>{{$bgroup}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-md-4 ">
                                            <label> Employee Type* </label>
                                            <select name="emp_type" required
                                                    class="form-control " {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }}>
                                                <option value="" class="form-control"> --Select--</option>
                                                <option value="permanent"
                                                        class="form-control" {{ $employees->emp_type == 'permanent' ? 'selected' : '' }}>
                                                    Permanent
                                                </option>
                                                <option value="adhoc"
                                                        class="form-control" {{ $employees->emp_type == 'adhoc' ? 'selected' : '' }}>
                                                    Adhoc
                                                </option>
                                                <option value="deputation"
                                                        class="form-control" {{ $employees->emp_type == 'deputation' ? 'selected' : '' }}>
                                                    Deputation
                                                </option>
                                                <option value="contract"
                                                        class="form-control" {{ $employees->emp_type == 'contract' ? 'selected' : '' }}>
                                                    Contract
                                                </option>
                                                <option value="internee"
                                                        class="form-control" {{ $employees->emp_type == 'internee' ? 'selected' : '' }}>
                                                    Internee
                                                </option>
                                                <option value="temporary"
                                                        class="form-control" {{ $employees->emp_type == 'temporary' ? 'selected' : '' }}>
                                                    Temporary
                                                </option>
                                                <option value="temporary"
                                                        class="form-control" {{ $employees->emp_type == 'Work Charge' ? 'selected' : '' }}>
                                                    Work Charge
                                                </option>
                                                <option value="temporary"
                                                        class="form-control" {{ $employees->emp_type == 'Contingent Paid' ? 'selected' : '' }}>
                                                    Contingent Paid
                                                </option>
                                            </select>
                                        </div>

                                        @if(auth()->user()->dep_id == 52 || auth()->user()->dep_id == 40)
                                            <div class="col-md-4 ">
                                                <label>Type of Service*</label>
                                                <select name="type_of_service"
                                                        class="form-control " {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }}>
                                                    <option value="" class="form-control"> --Select--</option>
                                                    @foreach(\App\User::typeOfService() as $typeOfService)
                                                        <option value="{{$typeOfService}}"
                                                                class="form-control" {{ $employees->type_of_service == $typeOfService ? 'selected' : '' }}>{{$typeOfService}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        @if (Auth::user()->usertype == 'admin')
                                            <div class="col-md-4 ">
                                                <label> Select Type* </label>
                                                <select name="usertype" class="form-control ">
                                                    <option value="" class="form-control"> --Select--</option>
                                                    <option value="user" selected class="form-control">
                                                        User
                                                    </option>
                                                    <option value="admin"
                                                            class="form-control" {{ $employees->usertype == 'admin' ? 'selected' : '' }}>
                                                        Admin
                                                    </option>
                                                    <option value="department_admin"
                                                            class="form-control" {{ $employees->usertype == 'department_admin' ? 'selected' : '' }}>
                                                        Department Admin
                                                    </option>

                                                </select>
                                            </div>
                                            <div class="col-md-4 ">
                                                <label>Change Department</label>
                                                <select name="department_id_change" class="form-control ">
                                                    @foreach (\App\Models\Department::all() as $de)
                                                        <option
                                                            value="{{ $de->id }}" {{ $employees->dep_id == $de->id ? 'selected' : '' }}>{{ strtoupper($de->dep_name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                        @endif

                                        {{--                                        @if (Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin')--}}
                                        <div class="col-md-4">
                                            <label for="office_phone">Change Password</label>
                                            <input type="password" name="pwd" class="form-control"  autocomplete="off"
                                                   placeholder="Type your new password here...">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="designation">Designation</label>

                                                @if(auth()->user()->usertype === "admin")
                                                    @php
                                                        $designationList = \App\Models\Designation::all();
                                                    @endphp
                                                    <select name="designation" class="form-control">
                                                        <option value="">--Select--</option>
                                                        {!! \App\User::getDesignationByDepartment($employees->dep_id, $employees->designation) !!}
                                                    </select>
                                                @else
                                                    @php
                                                        $designationList = \App\Models\Designation::where('dep_id',$employees->dep_id)->get();
                                                    @endphp
                                                    <select name="designation" class="form-control">
                                                        <option value="">--Select--</option>
                                                        {!! \App\User::getDesignationByDepartment($employees->dep_id, $employees->designation) !!}
                                                    </select>
                                                @endif
                                        </div>


                                        @if($employees->dep_id == 5)
                                            <div class="col-md-4">
                                                <label for="designation">Belt No</label>
                                                <input type="text" name="belt_no" class="form-control"

                                                       value="{{ $employees->belt_no }}">
                                            </div>
                                        @endif

                                        <div class="col-md-8">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1"> Current Address*</label>
                                            <textarea rows="3" class="col-md-12 form-control"
                                                      name="current_address" {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }}>{{ $employees->current_address }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1"> Permanent Address*</label>
                                            <textarea rows="3" class="col-md-12 form-control"
                                                      name="permanent_address" {{ Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' ? '' : 'required' }}>{{ $employees->permanent_address }}</textarea>
                                        </div>
                                    </div>


                                    <div class="row">


                                        <div class="col-md-6" align="center">
                                            <button type="submit" name="submit" value="Save" class="btn btn-info">
                                                Save
                                            </button>
                                            <button type="submit" name="submit" value="Next" class="btn btn-primary">
                                                Save & Next
                                            </button>
                                        </div>
                                        <div class="">

                                        </div>
                                        <div class="col-md-3" align="right">
                                            <a href="{{ url('employement-details/' . $employees->id . '/edit') }}"
                                               type="" class="btn btn-danger">
                                                Skip </a>
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


@section('scripts')
    <script type="text/javascript">
        function showDiv() {
            document.getElementById('transfers').show();
        }

    </script>
@endsection
