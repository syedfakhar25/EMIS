@extends('layouts.master')
@section('customScripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        .highcharts-credits {visibility: hidden!important;}
    </style>
@endsection
@section('title')
    Dashboard
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if (\Illuminate\Support\Facades\Auth::user()->usertype == 'department_admin')
                    <div class="card-header">
                        <h2 class="card-title" style="text-align: center">

                            {{--                            --}}
                            {{--                            <img src="{{ url('uploads/department/' . auth()->user()->department->logo) }}"--}}
                            {{--                                 style="text-align:left; height: 60px; width:60px">--}}
                            {{--                            <span>{{ Auth::user()->department->dep_name }}</span>--}}
                        </h2>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-info" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body">
                    @if (Auth::user()->usertype != 'user')
                        <style>
                            #adminCard {
                                /*padding: 30px;*/
                            }

                            #adminCard .withBG p,
                            #adminCard .withBG i,
                            #adminCard .withBG h4 {
                                color: white;
                            }

                            #adminCard p {
                                color: #141e30;
                                margin-top: -25px;
                                padding-top: 0px;
                                font-size: 20px;
                                font-weight: bold;
                            }

                            #adminCard h4 {
                                font-size: 60px;
                                margin-top: 0;
                                padding-top: 0;
                                color: #1da2ff;
                            }

                            #adminCard i {
                                color: #141e30;
                                font-size: 40px
                            }

                            #adminCard .card {
                                border-radius: 10px !important;
                            }

                            #adminCard .card:hover {
                                background: url("https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQqYMbCmATDzVcB9hzuzwnM-tpyMEqSQKZoAQ&usqp=CAU");
                                color: white !important;
                                background-position: center;
                                background-size: cover;

                            }

                            #adminCard .card:hover h4,
                            #adminCard .card:hover i {
                                color: white;
                            }

                            #adminCard .card:hover p {
                                color: white;
                            }

                            #adminCard a {
                                text-decoration: none;
                            }

                        </style>



                    @if(auth()->user()->usertype == 'department_admin' || auth()->user()->usertype == 'admin')

                            <div class="row" id="adminCard">
                                <div class="col-12">
                                    <h2 class="text-center font-weight-bolder mt">EMIS Dashboard</h2>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-info bg-light border" align="center">
                                        <div class="card-body">
                                            <a href="/employees">
                                                <i class="now-ui-icons business_badge"></i>
                                                <h4>{{ $total_emp }}</h4>
                                                <p> Total Employees</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-info bg-light border" align="center">
                                        <div class="card-body">
                                            <a href="/employees?emp_type[]=permanent">
                                                <i class="fas fa-chalkboard-teacher"></i>
                                                <h4>{{ $data['permanent']}}</h4>
                                                <p>Permanent</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-info bg-light border" align="center">
                                        <div class="card-body">
                                            <a href="/employees?emp_type[]=contract">
                                                <i class="now-ui-icons location_map-big"></i>
                                                <h4>{{$data['contract']}}</h4>
                                                <p>Contract</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-info bg-light border" align="center">
                                        <div class="card-body">
                                            <a href="/employees?emp_type[]=adhoc">
                                                <i class="now-ui-icons location_map-big"></i>
                                                <h4>{{$data['adhoc']}}</h4>
                                                <p>Adhoc</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-info bg-light border" align="center">
                                        <div class="card-body">
                                            <a href="/employees?emp_type[]=deputation">
                                                <i class="now-ui-icons location_map-big"></i>
                                                <h4>{{$data['deputation']}}</h4>
                                                <p>Deputation</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-info bg-light border" align="center">
                                        <div class="card-body">
                                            <a href="/employees?emp_type[]=temporary">
                                                <i class="now-ui-icons education_agenda-bookmark"></i>
                                                <h4>{{$data['temporary']}}</h4>
                                                <p>Temporary</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-info bg-light border" align="center">
                                        <div class="card-body">
                                            <a href="/employees?emp_type[]=retired">
                                                <i class="now-ui-icons design-2_ruler-pencil"></i>
                                                <h4>{{ $data['retired'] }}</h4>
                                                <p>Retired</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-info bg-light border" align="center">
                                        <div class="card-body">
                                            <a href="/employees?emp_type[]=work_charge">
                                                <i class="now-ui-icons design-2_ruler-pencil"></i>
                                                <h4>{{ $data['work_charge'] }}</h4>
                                                <p>Work Charge</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-info bg-light border" align="center">
                                        <div class="card-body">
                                            <a href="/employees?emp_type[]=contingent_paid">
                                                <i class="now-ui-icons design-2_ruler-pencil"></i>
                                                <h4>{{ $data['contingent_paid'] }}</h4>
                                                <p>Contingent Paid</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-info bg-light border" align="center">
                                        <div class="card-body">
                                            <a href="/employees?emp_type[]=NotSet">
                                                <i class="now-ui-icons design-2_ruler-pencil"></i>
                                                <h4>{{ $data['notSet'] }}</h4>
                                                <p>Not Set</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                                @if (\Illuminate\Support\Facades\Auth::user()->usertype == 'admin')
                                    <div class="col-md-3">
                                        <div class="card border-info bg-light border" align="center">
                                            <div class="card-body">
                                                <a href="/departments">
                                                    <i class="now-ui-icons business_bank"></i>
                                                    <h4>{{ $total_dep }}</h4>
                                                    <p>Departments</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                @if (!empty($cadre))
                                    <div class="col-md-12">
                                        <h1 class="text-center">Departmental Cadres</h1>
                                    </div>
                                    @if (auth()->user()->usertype == 'department_admin')
                                        @foreach ($cadre as $key => $value)
                                            <div class="col-md-3">
                                                <div class="card border-info bg-light border" align="center">
                                                    <div class="card-body">
                                                        @php
                                                            $cad = App\Models\Cadres::where('name', $key)
                                                                ->where('dep_id', auth()->user()->dep_id)
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
                                                        <a href="/reports?{{ $string_designation }}">
                                                            <i class="now-ui-icons design-2_ruler-pencil"></i>
                                                            <h4>{{ $value }}</h4>
                                                            <p>{{ $key }}</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                @endif

                                <div class="col-md-4 withBG">
                                    <div class="card bg-info border" align="center">
                                        <div class="card-body">
                                            <a href="/employees?verified[]=1">
                                                <i class="fas fa-user-check"></i>
                                                <h4>{{ $verified_users }}</h4>
                                                <p>Verified Users</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 withBG">
                                    <div class="card bg-danger border" align="center">
                                        <div class="card-body">
                                            <a href="/employees?verified[]=0">
                                                <i class="fas fa-user-alt-slash "></i>
                                                <h4>{{ $not_verified_users }}</h4>
                                                <p>Pending Users</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 withBG">
                                    <div class="card bg-warning border" align="center">
                                        <div class="card-body">
                                            @if (auth()->user()->usertype == 'department_admin')
                                                <a href="/employees?last_24hrs[]=24hr">
                                                    @else
                                                        <a href="/employees?last_24hrs[]=24hrs">
                                                            @endif
                                                            <i class="fas fa-clock"></i>
                                                            @if (auth()->user()->usertype == 'department_admin')
                                                                <h4>{{ \App\User::where('dep_id', auth()->user()->id)->where('created_at', '>', \Carbon\Carbon::now()->subDay())->where('created_at', '<', \Carbon\Carbon::now())->count() }}</h4>
                                                            @else
                                                                <h4>{{ \App\User::where('created_at', '>', \Carbon\Carbon::now()->subDay())->where('created_at', '<', \Carbon\Carbon::now())->count() }}</h4>
                                                            @endif
                                                            <p>Last 24hrs</p>
                                                        </a>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-12">
                                <h2 class="text-center font-weight-bolder mt">EMIS Graphic Visualization</h2>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div id="chart" class="border border-secondary rounded">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border border-secondary rounded" id="service_length_chart"></div>
                            </div>
                        </div>

                        <hr>

                        <div class="row" align="center">
                          {{--  <div class="col-md-6">
                                <div class="border border-secondary rounded" id="scale_wise"></div>
                            </div>--}}
                            <div class="col-md-3"></div>
                            <div class="col-md-6" >
                                <div id="age_retirement" class="border border-secondary rounded">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3"></div>
                        <hr>

                        @if(auth()->user()->usertype == 'admin')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="border border-secondary rounded" id="department_wise_chart"></div>
                                    </div>
                                </div>
                        @endif

                    <hr>

                        {{--                            <div class="col-md-12">--}}
                        {{--                                <div class="border border-secondary rounded" id="designation_wise_chart"></div>--}}
                        {{--                            </div>--}}

                        <div class="row">
                            <div class="col-md-12">

                                <script src="https://code.highcharts.com/highcharts.js"></script>

                                <figure class="highcharts-figure">
                                    <div id="container"></div>
                                </figure>

                            </div>


                        </div>

                        <hr>

@endif




                    @else
                        <div class="row">
                            <div class="col-md-12" align="">
                                <h2 align="center">
                                    Welcome to Employee Management Information System
                                </h2>

                            </div>
                            @if (Auth::user()->verified == 0)
                                <div class="col-md-12" align="center">
                                    <h5 style="color: green;">You have successfully Registered with EMIS</h5>

                                    @if(auth()->user()->dep_id == 5)
                                        <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
                                        <h5 style="color: red;direction: rtl; font-family:'Noto Nastaliq Urdu Draft', serif;">
                                            مزید رہنمائی کے لئے مرکزی دفتر پولیس میں <strong><a href="tel:03469572406">03469572406</a></strong> پر رابطہ کریں۔
                                        </h5>
                                        <br>
                                    @endif

                                    @if (!Auth::user()->email_verified_at && empty(!Auth::user()->email))
                                        <h6 style="color: green;">We have send you an email to verify your email address
                                            pelase check your inbox/junk/spam.</h6>
                                    @endif
                                    <h6 style="color: red">You can not make changes until verified by concerned
                                        authorities</h6>
                                </div>
                            @else

                                <style>
                                    #userCard i.now-ui-icons {
                                        font-size: 30px;
                                    }

                                    #userCard h4 {
                                        color: black !important;
                                    }

                                    #userCard p {
                                        color: black !important;
                                    }

                                    #userCard .card:hover {
                                        background-color: #9fcdff !important;
                                    }

                                </style>
                                <div class="col-md-12">
                                    <div class="row" id="userCard">
                                        <div class="col-md-4">
                                            <div class="card bg-light border" align="center">
                                                <div class="card-body" style=" font-size: large">
                                                    <a href="/employement-details/{{ Auth::user()->id }}/edit">
                                                        <i class="now-ui-icons business_badge" style="color: red"></i>
                                                        <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{ $employment_count }}</h4>
                                                        <p style=" margin-top:-25px;">Employment Details </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card bg-light border" align="center">
                                                <div class="card-body" style=" font-size: large">
                                                    <a href="/qualifications/{{ Auth::user()->id }}/edit">
                                                        <i class="now-ui-icons education_hat" style="color: red"></i>
                                                        <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{ $academic_count }}</h4>
                                                        <p style=" margin-top:-25px;">Academic Qualifications </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card bg-light border" align="center">
                                                <div class="card-body" style=" font-size: large">
                                                    <a href="/edit-professional/{{ Auth::user()->id }}/edit">
                                                        <i class="now-ui-icons business_briefcase-24"
                                                           style="color: red"></i>
                                                        <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{ $professional_count }}</h4>
                                                        <p style=" margin-top:-25px;">Professional Qualifications</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card bg-light border" align="center">
                                                <div class="card-body" style=" font-size: large">
                                                    <a href="/edit-trainings/{{ Auth::user()->id }}/edit">
                                                        <i class="now-ui-icons ui-2_settings-90" style="color: red"></i>
                                                        <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{ $trainings_count }}</h4>
                                                        <p style=" margin-top:-25px;">Trainings</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @if (Auth::user()->dep_id == 4)
                                            <div class="col-md-4">
                                                <div class="card bg-light border" align="center">
                                                    <div class="card-body" style=" font-size: large">
                                                        <a href="/edit-teaching_details/{{ Auth::user()->id }}/edit">
                                                            <i class="now-ui-icons business_bulb-63"
                                                               style="color: red"></i>
                                                            <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{ $teaching_details_count }}</h4>
                                                            <p style=" margin-top:-25px;">Teaching Details</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card bg-light border" align="center">
                                                    <div class="card-body" style=" font-size: large">
                                                        <a href="/edit-result-history/{{ Auth::user()->id }}/edit">
                                                            <i class="now-ui-icons files_paper" style="color: red"></i>
                                                            <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{ $result_history_count }}</h4>
                                                            <p style=" margin-top:-25px;">Result History</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-4">
                                            <div class="card bg-light border p-1" align="center">
                                                <div class="card-body" style=" font-size: large">
                                                    <a href="/edit-promotion-history/{{ Auth::user()->id }}/edit">
                                                        <i class="now-ui-icons business_chart-bar-32"
                                                           style="color: red"></i>
                                                        <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{ $promotion_count }}</h4>
                                                        <p style=" margin-top:-25px;">Promotion History</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card bg-light border" align="center">
                                                <div class="card-body" style=" font-size: large">
                                                    <a href="/edit-transfer-history/{{ Auth::user()->id }}/edit">
                                                        <i class="now-ui-icons sport_user-run" style="color: red"></i>
                                                        <h4 style="font-size:40px; margin-top:0; padding-top:0; text-decoration: none">{{ $transfer_count }}</h4>
                                                        <p style=" margin-top:-25px;">Transfer History</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                             <div class="card bg-light border" align="center">
                                                 <div class="card-body" style=" font-size: large">
                                                     <a href="/employee-profile/{{ Auth::user()->employee_id}}">
                                                     <i class="now-ui-icons users_single-02" style="color: red"></i>
                                                     <p>Profile</p>
                                                     </a>
                                                 </div>
                                             </div>
                                         </div> --}}
                                    </div>
                                </div>

                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    @if(auth()->user()->usertype == 'department_admin' || auth()->user()->usertype == 'admin')
    <script type="application/javascript">

        var options = {
            series: [@foreach($gender_wise_graph as $key => $value) {{$value}}, @endforeach],
            chart: {
                width: '100%',
                height: 275,
                type: 'pie',
            },

            labels: [@foreach($gender_wise_graph as $key => $value) "{{ucfirst($key)}}", @endforeach],
            title: {
                text: 'Gender',
                align: 'center',
                marginTop: 20,
                offsetX: 0,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    fontFamily: undefined,
                    color: '#263238'
                },
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: '100%'
                    },

                    legend: {
                        position: 'bottom'
                    }
                },
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();


        var service_length_options = {
            series: [@foreach($age_gorup_in as $key => $value) {{$value}},@endforeach],
            chart: {
                width: '100%',
                height: 300,
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    startAngle: -90,
                    endAngle: 90,
                    offsetY: 10
                }
            },
            labels: [@foreach($age_gorup_in as $key => $value) "{{$key}}",@endforeach],
            legend: {
                position: 'bottom',
            },
            title: {
                text: 'Age Group',
                align: 'center',
                marginTop: 20,
                offsetX: 0,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    fontFamily: undefined,
                    color: '#263238'
                },
            },
            grid: {
                padding: {
                    bottom: -80
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };


        var service_length_chart = new ApexCharts(document.querySelector("#service_length_chart"), service_length_options);
        service_length_chart.render();


        var age_retirement_options = {
            series: [@foreach($age_retirement as $key => $value) {{$value}},@endforeach],
            chart: {
                width: "100%",
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    startAngle: -90,
                    endAngle: 270
                }
            },

            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'gradient',
            },
            labels: [@foreach($age_retirement as $key => $value) "{{$key}}",@endforeach],
            legend: {
                formatter: function (val, opts) {
                    return val + " = " + opts.w.globals.series[opts.seriesIndex]
                },
                position: 'right'
            },
            title: {
                text: 'Expected Retirements Yearly',
                align: 'center',
                marginTop: 20,
                offsetX: 0,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    fontFamily: undefined,
                    color: '#263238'
                },
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var age_retirement_chart = new ApexCharts(document.querySelector("#age_retirement"), age_retirement_options);
        age_retirement_chart.render();


        var options_1 = {
            series: [{
                name: 'BPS',
                data: [@foreach($scale_wise as $key) {{$key->total}}, @endforeach]
            },],
            chart: {
                type: 'bar',
                width: '100%',
                height: 350
            },

            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: [@foreach($scale_wise as $key ) "{{$key->scale}}", @endforeach],
            },
            yaxis: {
                title: {
                    text: '(thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            title: {
                text: 'Scale-wise Count',
                align: 'center',
                marginTop: 20,
                offsetX: 0,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    fontFamily: undefined,
                    color: '#263238'
                },
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val
                    }
                }
            }
        };

        var scale_wise = new ApexCharts(document.querySelector("#scale_wise"), options_1);
        scale_wise.render();


        var department_wise_options = {
            series: [@foreach($department_wise_chart as $item) {{$item->total}}, @endforeach],
            chart: {
                width: '100%',
                height: 400,
                type: 'pie',
            },

            labels: [@foreach($department_wise_chart as $item) '{{$item->name}}: {{$item->total}}', @endforeach],
            title: {
                text: 'Department Wise Count',
                align: 'center',
                marginTop: 20,
                offsetX: 0,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    fontFamily: undefined,
                    color: '#263238'
                },
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: '100%'
                    },

                    legend: {
                        position: 'bottom'
                    }
                },
            }]
        };

        var department_wise_chart = new ApexCharts(document.querySelector("#department_wise_chart"), department_wise_options);
        department_wise_chart.render();




        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: true,
                type: 'pie',
                height: 500,
            },
            title: {
                @if(auth()->user()->usertype == 'department_admin')

                text: 'Department Wise Designation'
                @else
                text: 'Department Wise Designation (Minimum 1000)'

                @endif
            },
            tooltip: {
                pointFormat: 'Total: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                @php $others = 0 @endphp
                data: [

                @foreach($designation_wise_chart as $item)
                        @if(auth()->user()->usertype == 'department_admin')
                            {
                                name: '{{$item->designation_name}}: {{$item->total}}',
                                y: {{$item->total}},
                            },
                        @else
                            @if($item->total > 1000)
                                {
                                    name: '{{$item->dep_name}} - {{$item->designation}}: {{$item->total}}',
                                    y: {{$item->total}},
                                },
                            @else
                                @php $others = $others + $item->total; @endphp
                            @endif
                        @endif
                @endforeach
                            {
                                name: 'Others - Total: {{$others}}',
                                y: {{$others}},
                            },

                ]
            }]
        });


    </script>
    @endif

@endsection
