@extends('layouts.master')

@section('title')
    Personal Information
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="alert alert-danger"> {{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-12">
                                <h4 class="text-center font-weight-bold">AZAD GOVT. OF THE STATE OF JAMMU & KASHMIR</h4>
                                <h5 class="text-center font-weight-bold">PERFORMANCE EVALUATION REPORT FROM
                                    <span
                                        style="color:red;">{{ \Carbon\Carbon::parse($acrPartOne->from)->format('d-m-Y') }}</span>
                                    TO <span
                                        style="color:red;">{{ \Carbon\Carbon::parse($acrPartOne->to)->format('d-m-Y') }}</span>
                                    <br>
                                    FOR OFFICERS IN BPS 19 & 20
                                </h5>
                            </div>


                            <div class="col-md-12">
                                <h5 class="text-center font-weight-bold">PART I</h5>
                                <p style="font-size: 20px;">
                                    <span style="font-weight: bold;">1. Name:</span> {{ strtoupper($acrPartOne->name) }}
                                    <br>
                                    <span
                                        style="font-weight: bold;">2. Personal Number:</span> {{ strtoupper($acrPartOne->personal_no) }}

                                    <br>
                                    <span
                                        style="font-weight: bold;">3. Date of Birth:</span> {{ strtoupper($acrPartOne->dob) }}


                                    <br>
                                    <span
                                        style="font-weight: bold;">4. Date of entry in service:</span> {{ strtoupper($acrPartOne->date_of_joining) }}

                                    <br>
                                    <span
                                        style="font-weight: bold;">5. Post held during the period (with BPS):</span> {{ strtoupper($acrPartOne->post_held_during_period_with_bps) }}
                                    <br>
                                    <span
                                        style="font-weight: bold;">6. Academic qualifications:</span> {{ strtoupper($acrPartOne->academic_qualification) }}
                                    <br>
                                    <span style="font-weight: bold;">7. Knowledge of language (Speaking, Reading, Writting):</span> {{ strtoupper($acrPartOne->knowledge_of_languages_speaking_reading_writing) }}

                                </p>
                            </div>


                            @if(!empty($acrPartOne->acr_trainings))
                                <div class="col-md-12">
                                        <span style="font-weight: bold; font-size: 18px;" class="text-center;">8. Training received during the evaluation period
                                            (Training courses attended earlier, if any, May please be listed seprately on the back page of the report)
                                        <br>
                                            <br>
                                        </span>
                                    <table class="table  table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="font-weight-bold">#</th>
                                            <th scope="col" class="font-weight-bold">Name of Courses attended</th>
                                            <th scope="col" class="font-weight-bold">Duration with dates</th>
                                            <th scope="col" class="font-weight-bold">Name of institution</th>
                                            <th scope="col" class="font-weight-bold">Country</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($acrPartOne->acr_trainings as $t)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$t->subject}}</td>
                                            <td>{{ \Carbon\Carbon::parse($t->from)->format('d-m-Y') }}  to {{\Carbon\Carbon::parse($t->to)->format('d-m-Y')}}</td>
                                            <td>{{$t->institute}}</td>
                                            <td>{{$t->country}}</td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif


                            <br>

                            <div class="col-md-12">

                            <span style="font-weight: bold; font-size: 20px;" class="text-center;">9. Period served:</span>
                                {{ strtoupper($acrPartOne->post_served) }}
                                <br>
                                (i) in present post {{ strtoupper($acrPartOne->in_present_post) }}
                                (ii) Under the reporting officer {{ strtoupper($acrPartOne->under_the_reporting_officer_name) }}
                                Under the reporting officer CNIC: {{ strtoupper($acrPartOne->under_the_reporting_officer_cnic) }}
                            </div>


                            <div class="col-md-12">
                                <br>
                                <h5 class="text-center font-weight-bold mt-2 mb-0">PART II</h5>
                                <span style="font-weight: bold; font-size: 18px;" class="text-center;">
                                    1. Job description.
                                </span>
<br>
                                @if(!empty($acrPartOne->acr_trainings))
                                    {{$acrPartOne->acr_trainings_part_two->job_description}}
                                @endif

                                <br>
                                <br>
                                <span style="font-weight: bold; font-size: 18px;" class="text-center;">
                                    2. &nbsp; Brief account of achievements during the period supported by statistical data where possible, targets given and actual performance
                                    against such targets should be highlighted. Reasons for shortfall, if any, amy also be stated.<br>
                                </span>
                                @if(!empty($acrPartOne->acr_trainings))
                                    {{$acrPartOne->acr_trainings_part_two->job_description}}
                                @endif




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
