@extends('layouts.master')

@section('title')
    Profile
@endsection


@section('content')
    <style>
        body {
            margin-top: 20px;
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }

        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm > .col,
        .gutters-sm > [class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }


        .notice {
            padding: 15px;
            background-color: #fafafa;
            border-left: 6px solid #7f7f84;
            margin-bottom: 10px;
            -webkit-box-shadow: 0 5px 8px -6px rgba(0, 0, 0, .2);
            -moz-box-shadow: 0 5px 8px -6px rgba(0, 0, 0, .2);
            box-shadow: 0 5px 8px -6px rgba(0, 0, 0, .2);
        }

        .notice-sm {
            padding: 10px;
            font-size: 80%;
        }

        .notice-lg {
            padding: 35px;
            font-size: large;
        }

        .notice-success {
            border-color: #80D651;
        }

        .notice-success > strong {
            color: #80D651;
        }

        .notice-info {
            border-color: #45ABCD;
        }

        .notice-info > strong {
            color: #45ABCD;
        }

        .notice-warning {
            border-color: #FEAF20;
        }

        .notice-warning > strong {
            color: #FEAF20;
        }

        .notice-danger {
            border-color: #d73814;
        }

        .notice-danger > strong {
            color: #d73814;
        }

    </style>
    <a class="btn btn-primary btn-round" href="javascript:;" onclick="printDiv()"
       style="position: fixed;bottom: 0;right: 32px;box-shadow: 4px 4px 6px 0px #c8c2c2;z-index: 1"><i
            class="fa fa-print" style="font-size: 20px;"></i></a>


    @if (\App\User::hasAccess($employees))
        <a class="btn btn-secondary btn-round" href="/employees/{{ $employees->id }}/edit"
           style="position: fixed;bottom: 0;right: 120px;box-shadow: 4px 4px 6px 0px #c8c2c2;z-index: 1"><i
                class="fa fa-edit" style="font-size: 20px;"></i></a>
    @endif


    {{--    <a class="btn btn-secondary btn-round" href="{{route('acrPartOne.create',$employees->id)}}"--}}
    {{--       style="position: fixed;bottom: 0;right: 200px;box-shadow: 4px 4px 6px 0px #c8c2c2;z-index: 1">--}}
    {{--        <i class="far fa-clipboard" style="font-size: 20px;"></i>--}}
    {{--    </a>--}}

    <div class="row" id="personal">
        <div class="col-md-12">
            <div class="image-flip">
                <div class="mainflip flip-0">
                    <div class="frontside">
                        adsfa
                        <div class="card border-primary p-2">
                            <h2 style="font-weight: bold; color: #00b0e8; text-align: center;"><em>Personal
                                    Information</em></h2>
                            <div class="row">
                                <div class="col-sm-8 pl-4">
                                    <p>
                                        <span style="font-size: 18px;"><strong>Name: </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $employees['first_name'] . ' ' . $employees['middle_name'] . ' ' . $employees['last_name'] }}<br></span>
                                        <span style="font-size: 18px;"><strong>Father/Husband Name: </strong>&nbsp;&nbsp;&nbsp;&nbsp; {{ $employees['father_first_name'] . ' ' . $employees['father_middle_name'] . ' ' . $employees['father_last_name'] }}<br></span>
                                        <span style="font-size: 18px;"><strong>Designation: </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                @if(!empty($employees['designation']) && is_numeric($employees['designation']))
                                                    @if(!empty(\App\Models\Designation::find($employees['designation'])))
                                                        {{\App\Models\Designation::find($employees['designation'])->designation_name}}
                                                    @endif
                                                @else
                                                    {{$employees['designation']}}
                                                @endif
                                            <br></span>
                                        <span style="font-size: 18px;"><strong>Department: </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            @if(!empty($employees->dep))
                                                {{ $employees->dep->dep_name }}
                                            @endif
                                            <br></span>

                                        <span style="font-size: 18px;"><strong>DDO Code: </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if (!empty($employees['ddo_code'])) {{ $employees['ddo_code'] }} @endif <br></span>
                                        <span style="font-size: 18px;"><strong>Employee Status: </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if (!empty($employees['emp_type'])) {{ $employees['emp_type'] }} @endif <br></span>
                                        <span style="font-size: 18px;"><strong>Cost Center: </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if (!empty($employees['cost_center'])) {{ $employees['cost_center'] }} @endif <br></span>
                                        <span style="font-size: 18px;"><strong>Scale: </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if(!empty($employees->EmployementDetails->first()->bps)){{$employees->EmployementDetails->first()->bps}} @endif<br></span>
                                        <span style="font-size: 18px;"><strong>Position: </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if (!empty($employees['position'])) {{ $employees['position'] }} @endif <br></span>
                                        <span style="font-size: 18px;"><strong>Fund: </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if (!empty($employees['fund'])) {{ $employees['fund'] }} @endif <br></span>
                                        <span style="font-size: 18px;"><strong>Payroll Area: </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if (!empty($employees['payroll_area'])) {{ $employees['payroll_area'] }} @endif <br></span>
                                        <span style="font-size: 18px;"><strong>Date of Birth: </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if (!empty($employees['birth_date'])) {{ date('d-m-Y', strtotime($employees['birth_date'])) }} ({{\Carbon\Carbon::parse($employees['birth_date'])->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days') }}) @endif <br></span>
                                        <span style="font-size: 18px;"><strong>Date of Appointment: </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if(!empty($employees->EmployementDetails->first()->appointment_date)) {{$employees->EmployementDetails->first()->appointment_date}} @endif <br></span>
                                        <span style="font-size: 18px;"><strong>E-Mail ID: </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if (!empty($employees['email'])) {{ $employees['email'] }} @endif <br></span>
                                        <span style="font-size: 18px;"><strong>Mobile Phone: </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if (!empty($employees['mobile_phone']))
                                                <a href="tel:{{$employees['mobile_phone']}}">{{ $employees['mobile_phone'] }}</a>
                                            @endif <br></span>
                                        <span style="font-size: 18px;"><strong>District Domicile: </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if (!empty($employees['district_domicile'])) {{ $employees['district_domicile'] }} @endif <br></span>
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <img class=" img-fluid float-right"
                                         src="@if (!empty($employees->image)) {{ asset('uploads/employee/' . $employees->image) }}
                                         @elseif(strtolower($employees->gender) == 'female') {{ asset('assets/img/female.png') }}
                                         @else {{ asset('assets/img/male.png') }} @endif"
                                         alt="card image" style="width: 150px; border: 4px solid lightgray;">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card mb-3"
                 style="opacity: 90%; color: black;  /* background: linear-gradient(45deg, #1c92d2, #f2fcfe);*/">
                <div class="card-body">
                    <div class="row">
                        <div class="notice notice-warning col-md-12">
                            <strong><em>CNIC:</em></strong>
                            @if ($employees['cnic'] != null)
                                {{ $employees['cnic'] }}
                            @else
                                #N/A
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="notice notice-danger col-md-6">
                            <strong><em>PERSONAL NO:</em></strong>

                            @if (is_null($employees->personal_no))
                                N/A
                            @else
                                {{ $employees->personal_no }}
                            @endif
                        </div>
                        <div class="notice notice-danger col-md-6">
                            <strong><em>EMIS CODE</em></strong>

                            @if (is_null($employees->emis_code))
                                N/A
                            @else
                                {{ $employees->emis_code }}
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="notice notice-info col-md-6">
                            <strong><em>DISTRICT:</em></strong>

                            @if (is_null($employees->district_domicile))
                                N/A
                            @else
                                {{ $employees->district_domicile }}
                            @endif

                        </div>
                        <div class="notice notice-info col-md-6">
                            <strong><em>QUOTA:</em></strong>
                            @if ($employees['quota'] != null)
                                {{ $employees['quota'] }}
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="notice notice-info col-md-6">
                            <strong><em>GENDER:</em></strong>

                            @if (is_null($employees->gender))
                                N/A
                            @else
                                {{ ucwords($employees->gender) }}
                            @endif
                        </div>
                        <div class="notice notice-info col-md-6">
                            <strong><em>MARITAL STATUS:</em></strong>
                            @if (is_null($employees->marital_status))
                                N/A
                            @else
                                {{ ucwords($employees->marital_status) }}
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="notice notice-info col-md-6">
                            <strong><em>MOBILE PHONE:</em></strong>
                            @if (is_null($employees->mobile_phone))
                                N/A
                            @else
                                {{ ucwords($employees->mobile_phone) }}
                            @endif
                        </div>
                        <div class="notice notice-info  col-md-6">
                            <strong><em>OFFICE PHONE:</em></strong>

                            @if (is_null($employees->office_phone))
                                N/A
                            @else
                                {{ ucwords($employees->office_phone) }}
                            @endif


                        </div>
                    </div>
                    <div class="row">
                        <div class="notice notice-info col-md-6">
                            <strong><em>BIRTH DATE:</em></strong>

                            @if (is_null($employees->birth_date))
                                N/A
                            @else
                                {{ Carbon\Carbon::parse($employees->birth_date)->format('d-m-Y') }}
                            @endif
                        </div>
                        <div class="notice notice-info  col-md-6">
                            <strong><em>BIRTH PLACE:</em></strong>
                            @if (is_null($employees->birth_place))
                                N/A
                            @else
                                {{ ucwords($employees->birth_place) }}
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="notice notice-info col-md-6">
                            <strong><em>CURRENT ADDRESS:</em></strong>
                            @if (is_null($employees->current_address))
                                N/A
                            @else
                                {{ ucwords($employees->current_address) }}
                            @endif
                        </div>
                        <div class="notice notice-info  col-md-6">
                            <strong><em>PERMANENT ADDRESS :</em></strong>
                            @if (is_null($employees->permanent_address))
                                N/A
                            @else
                                {{ ucwords($employees->permanent_address) }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if ($employees->EmployementDetails->count())
                @if (count($employees->EmployementDetails) > 0)
                    <div class="row gutters-sm">
                        <div class="col-sm-12">
                            <div class="card h-100">
                                <div class="card-header" align="center">
                                    <h2 style="font-weight: bold; color: #00b0e8"><em>Employment Details</em></h2>
                                </div>
                                <hr>
                                <div class="card-body">
                                    {{--                                    @foreach ($employees->EmployementDetails as $ed)--}}
                                    <div class="notice notice-info col-md-12 ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6><i class="material-icons text-danger">Designation: </i>

                                                    @if(!empty($employees->promotion->last()))
                                                        {{$employees->promotion->last()->designation}}
                                                    @else
                                                        @if (!empty($employees->designation)) {{ $employees->designation }} @endif
                                                    @endif

                                                    {{--                                                        @if (is_null($ed->designation))--}}
                                                    {{--                                                            N/A--}}
                                                    {{--                                                        @else--}}
                                                    {{--                                                            {{ ucwords($ed->designation) }}--}}
                                                    {{--                                                        @endif--}}
                                                </h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h6><i class="text-primary">Employment Type:</i>
                                                    @if (!empty($employees->emp_type))
                                                        {{ $employees->emp_type }}
                                                    @else
                                                        N/A
                                                    @endif


                                                </h6>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="d-flex align-items-center mb-3"><i
                                                        class="material-icons text-primary mr-2">Basic Pay Scale:</i>


                                                    @if(!empty($employees->promotion->last()))
                                                        {{$employees->promotion->last()->promotion}}
                                                    @else
                                                        @if (!empty($employees->bps))
                                                            {{ $employees->bps }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    @endif

                                                    {{--                                                        @if (is_null($ed->bps))--}}
                                                    {{--                                                            N/A--}}
                                                    {{--                                                        @else--}}
                                                    {{--                                                            {{ ucwords($ed->bps) }}--}}
                                                    {{--                                                        @endif--}}

                                                </h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="d-flex align-items-center mb-3"><i
                                                        class="material-icons text-primary mr-2">Time Scale / Date:</i>

                                                    @if (is_null($employees->EmployementDetails->first()->time_scale))
                                                        N/A
                                                    @else
                                                        {{ ucwords($employees->EmployementDetails->first()->time_scale) }}
                                                    @endif

                                                    /

                                                    @if (is_null($employees->EmployementDetails->first()->time_scale_date))
                                                        N/A
                                                    @else
                                                        {{ Carbon\Carbon::parse($employees->EmployementDetails->first()->time_scale_date)->format('d-m-Y') }}
                                                    @endif

                                                </h6>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="d-flex align-items-center mb-3"><i
                                                        class="material-icons text-primary mr-2">Appointment Date:</i>

                                                    @if (is_null($employees->EmployementDetails->first()->appointment_date))
                                                        N/A
                                                    @else
                                                        {{ Carbon\Carbon::parse($employees->EmployementDetails->first()->appointment_date)->format('d-m-Y') }}
                                                    @endif
                                                </h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="d-flex align-items-center mb-3"><i
                                                        class="material-icons text-primary mr-2">Join Date:</i>

                                                    @if (is_null($employees->EmployementDetails->first()->join_date))
                                                        N/A
                                                    @else
                                                        {{ Carbon\Carbon::parse($employees->EmployementDetails->first()->join_date)->format('d-m-Y') }}
                                                    @endif
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                        @if (count($employees->EmployementDetails) > 1)--}}
                                    {{--                                            <hr>--}}
                                    {{--                                        @endif--}}
                                    {{--                                    @endforeach--}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="row">
                <br>
            </div>
            @if ($employees->qualification != null)
                @if (count($employees->qualification) > 0)
                    <div class="row gutters-sm">
                        <div class="col-sm-12">
                            <div class="card h-100">
                                <div class="card-header" align="center">
                                    <h2 style="font-weight: bold; color: #00b0e8"><em>Academic Qualifications</em></h2>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="notice notice-info col-md-12 ">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="text-danger">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Title</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Institute</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Grade/Division</i>
                                                    </h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Passing Year</i>
                                                    </h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Province</i></h6>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($employees->qualification as $qual)
                                                <tr>
                                                    <td>{{ $qual->degree_name }}</td>
                                                    <td> {{ $qual->institute }}</td>
                                                    <td>{{ $qual->grade }}</td>
                                                    <td>{{ $qual->year }}</td>
                                                    <td>{{ $qual->province }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="row">
                <br>
            </div>
            @if ($employees->professional_qualification != null)
                @if (count($employees->professional_qualification) > 0)
                    <div class="row gutters-sm">
                        <div class="col-sm-12">
                            <div class="card h-100">
                                <div class="card-header" align="center">
                                    <h2 style="font-weight: bold; color: #00b0e8"><em>Professional Qualifications</em>
                                    </h2>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="notice notice-info col-md-12 ">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="text-danger">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Degree Name</i>
                                                    </h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Year</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Institute</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Subject</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">grade</i></h6>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($employees->professional_qualification as $qual)
                                                <tr>
                                                    <td> {{ $qual->degree_name }}</td>
                                                    <td>{{ $qual->year }}</td>
                                                    <td>{{ $qual->institute }}</td>
                                                    <td>{{ $qual->subject }}</td>
                                                    <td>{{ $qual->grade }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="row">
                <br>
            </div>
            @if ($employees->trainings != null)
                @if (count($employees->trainings) > 0)
                    <div class="row gutters-sm">
                        <div class="col-sm-12">
                            <div class="card h-100">
                                <div class="card-header" align="center">
                                    <h2 style="font-weight: bold; color: #00b0e8"><em>Trainings</em></h2>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="notice notice-info col-md-12 ">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="text-danger">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Title</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2"> Type</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Location</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Institute</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Country</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Funded By</i></h6>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($employees->trainings as $qual)
                                                <tr>
                                                    <td> {{ $qual->title }}</td>
                                                    <td>{{ $qual->type }}</td>
                                                    <td>{{ $qual->location }}</td>
                                                    <td>{{ $qual->institute }}</td>
                                                    <td>{{ $qual->country }}</td>
                                                    <td>{{ $qual->funded_by }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="row">
                <br>
            </div>
            @if ($employees->teaching_details != null)
                @if (count($employees->teaching_details) > 0)
                    <div class="row gutters-sm">
                        <div class="col-sm-12">
                            <div class="card h-100">
                                <div class="card-header" align="center">
                                    <h2 style="font-weight: bold; color: #00b0e8"><em>Teaching Details</em></h2>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="notice notice-info col-md-12 ">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="text-danger">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">S.No</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2"> Subject</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Class</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Period per Week</i>
                                                    </h6>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($employees->teaching_details as $qual)
                                                <tr>
                                                    <td> {{ $qual->number }}</td>
                                                    <td>{{ $qual->subject }}</td>
                                                    <td>{{ $qual->class }}</td>
                                                    <td>{{ $qual->periods }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="row">
                <br>
            </div>
            @if ($employees->result_history != null)
                @if (count($employees->result_history) > 0)
                    <div class="row gutters-sm">
                        <div class="col-sm-12">
                            <div class="card h-100">
                                <div class="card-header" align="center">
                                    <h2 style="font-weight: bold; color: #00b0e8"><em>Result History</em></h2>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="notice notice-info col-md-12 ">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="text-danger">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">S. No</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2"> Subject</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Class</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Session</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">% Board</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">% College</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">% Individual</i>
                                                    </h6>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($employees->result_history as $qual)
                                                <tr>
                                                    <td> {{ $qual->number }}</td>
                                                    <td>{{ $qual->subject }}</td>
                                                    <td>{{ $qual->class }}</td>
                                                    <td>{{ $qual->year }}</td>
                                                    <td>{{ $qual->percentage_board }}</td>
                                                    <td>{{ $qual->percentage_college }}</td>
                                                    <td>{{ $qual->percentage_individual }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="row">
                <br>
            </div>
            @if ($employees->transfer != null)
                @if (count($employees->transfer) > 0)
                    <div class="row gutters-sm">
                        <div class="col-sm-12">
                            <div class="card h-100">
                                <div class="card-header" align="center">
                                    <h2 style="font-weight: bold; color: #00b0e8"><em>Transfer History</em></h2>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="notice notice-info col-md-12 ">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="text-danger">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Transfer From</i>
                                                    </h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2"> Transfer To</i>
                                                    </h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Transfer Date</i>
                                                    </h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Stay </i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Order No</i></h6>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($employees->transfer as $qual)
                                                <tr>
                                                    <td> {{ $qual->from_department['dep_name'] }}</td>
                                                    <td>{{ $qual->to_department['dep_name'] }}</td>
                                                    <td>{{ $qual->date }}</td>
                                                    <td>{{ $qual->stay }} year</td>
                                                    <td>{{ $qual->order_no }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="row">
                <br>
            </div>
            @if ($employees->promotion != null)
                @if (count($employees->promotion) > 0)
                    <div class="row gutters-sm">
                        <div class="col-sm-12">
                            <div class="card h-100">
                                <div class="card-header" align="center">
                                    <h2 style="font-weight: bold; color: #00b0e8"><em>Promotion History</em></h2>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="notice notice-info col-md-12 ">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="text-danger">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Promotion/Induction</i>
                                                    </h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2"> Designation</i>
                                                    </h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Date of
                                                            Promotion</i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Date of
                                                            Selection </i></h6>
                                                </th>
                                                <th scope="col">
                                                    <h6 class="d-flex align-items-center mb-3"><i
                                                            class="material-icons text-primary mr-2">Order No</i></h6>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($employees->promotion as $qual)
                                                <tr>
                                                    <td> {{ $qual->promotion }}</td>
                                                    <td>{{ $qual->designation }}</td>
                                                    <td>{{ $qual->date }}</td>
                                                    <td>{{ $qual->selection_date }}</td>
                                                    <td>{{ $qual->order_no }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            @if(auth()->user()->usertype == "admin" || auth()->user()->dep_id == 5)
                @if($acr_bps_ninteen_above->isNotEmpty())
                    <div class="row gutters-sm">
                        <div class="col-sm-12">
                            <div class="card h-100">
                                <div class="card-header" align="center">
                                    <h2 style="font-weight: bold; color: red;"><em>ACR History</em></h2>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="notice notice-info col-md-12 ">
                                        <table class="table text-center">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="font-weight-bold">
                                                    Sr.#
                                                </th>
                                                <th scope="col" class="font-weight-bold">
                                                    Name
                                                </th>
                                                <th scope="col" class="font-weight-bold">
                                                    From
                                                </th>
                                                <th scope="col" class="font-weight-bold">
                                                    To
                                                </th>
                                                <th scope="col" class="font-weight-bold">
                                                    Department
                                                </th>
                                                <th scope="col" class="font-weight-bold">
                                                    View
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($acr_bps_ninteen_above as $acr)
                                                <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td>{{ $acr->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($acr->from)->format('d-m-Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($acr->to)->format('d-m-Y') }}</td>
                                                    <td>{{ \App\Models\Department::find($acr->department_id)->first()->dep_name }}</td>
                                                    <td>
                                                        <a href="{{route('acrPartOne.show',$acr->id)}}"
                                                           class="btn btn-outline-info btn-sm"
                                                           style="text-decoration: none" title="View ACR">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

        </div>
    </div>

@endsection


@section('scripts')
    <script type="text/javascript">
        function printDiv() {
            var info = document.getElementById('personal').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = info;
            window.print();
            document.body.innerHTML = originalContents;
        }

    </script>
@endsection
