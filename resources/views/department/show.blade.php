@extends('layouts.master')

@section('title')
        Department
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    @if(empty($department->logo))
                        <img src="{{url('assets/img/logo.png')}}" width="150" height="auto" class="float-left mr-4">
                    @else
                        <img src="{{url('uploads/department/'. $department->logo)}}" class="float-left mr-4" width="150" height="auto">
                    @endif
                    <br>
                    <h1 class="mb-0">{{$department->dep_name}}</h1>
                    <h3 class="mb-0">Azad Government of The State of Jammu & Kashmir</h3>
                    <div class="clearfix"></div>
                    <hr>
                </div>
                <div class="card-body">
                    {!! html_entity_decode($department->description, ENT_QUOTES, 'UTF-8') !!}
                    <h3>Employees</h3>
                    <div class="row" id="adminCard">


                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]=' . $department->id)}}" style="text-decoration: none">
                                        <i class="now-ui-icons business_badge" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{$total_emp}}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;"> Total Employees</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=permanent')}}" style="text-decoration: none">
                                        <i class="fas fa-chalkboard-teacher" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{ $data['permanent'] }}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">Permanent</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=adhoc')}}" style="text-decoration: none">
                                        <i class="fas fa-chalkboard-teacher" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{ $data['adhoc'] }}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">Adhoc</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=temporary')}}" style="text-decoration: none">
                                        <i class="now-ui-icons education_agenda-bookmark" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{ $data['temporary'] }}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">Temporary</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=contract')}}" style="text-decoration: none">
                                        <i class="now-ui-icons location_map-big" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{ $data['contract'] }}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">Contract</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=deputation')}}" style="text-decoration: none">
                                        <i class="now-ui-icons files_box" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{ $data['deputation'] }}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">Deputation</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=internee')}}" style="text-decoration: none">
                                        <i class="now-ui-icons arrows-1_minimal-right" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{ $data['internee'] }}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;"> Internee</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=retired')}}" style="text-decoration: none">
                                        <i class="now-ui-icons design-2_ruler-pencil" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{ $data['retired'] }}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">Retired</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=work_charge')}}" style="text-decoration: none">
                                        <i class="now-ui-icons design-2_ruler-pencil" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{ $data['work_charge'] }}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">Work Charge</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=contingent_paid')}}" style="text-decoration: none">
                                        <i class="now-ui-icons design-2_ruler-pencil" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{ $data['contingent_paid'] }}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">Contingent Paid</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    <a href="{{url('employees?dep_id[]='.$department->id . '&emp_type[]=NotSet')}}" style="text-decoration: none">
                                        <i class="now-ui-icons design-2_ruler-pencil" style="color: #141e30; font-size: 40px"></i>
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{$data['notSet']}}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">Not Set</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if (!empty($cadre))
                            <div class="col-md-12">
                                <h1 class="text-center">Cadres Wise</h1>
                                <hr>
                            </div>
                        @foreach($cadre as $key => $value)
                        <div class="col-md-3">
                            <div class="card border-info bg-light border" align="center">
                                <div class="card-body" style="">
                                    @php
                                    $cad = App\Models\Cadres::where('name', $key)
                                        ->where('dep_id', $department->id)
                                        ->first();
                                    $designations = explode(', ', $cad->included_designation);
                                    $string_designation = '';
                                    $count_des = 0;
                                    foreach ($designations as $des) {
                                        if ($count_des < 1) {
                                            $string_designation = $string_designation . 'designation' . '[' . $count_des . ']=' . $des;
                                        } else {
                                            $string_designation = $string_designation . '&designation' . '[' . $count_des . ']=' . $des;
                                        }
                                        $count_des++;
                                    }
                                @endphp
                                    <a href="/reports?{{ $string_designation }}&dep_id[]={{ $department->id }}" style="text-decoration: none">
                                        {{-- <i class="now-ui-icons design-2_ruler-pencil" style="color: #141e30; font-size: 40px"></i> --}}
                                        <h4 style="font-size:60px; margin-top:0; padding-top:0;">{{ $value }}</h4>
                                        <p style="margin-top:-25px; padding-top:0px;">{{ $key }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif






                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
@endsection
