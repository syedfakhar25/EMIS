@extends('layouts.master')

@section('title')
    ACR FOR OFFICERS IN BPS 19 & 20
@endsection

@section('customScripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-info" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">

                        <h4 class="text-center">
                            AZAD GOVT. OF THE STATE OF JAMMU & KASHMIR
                            <br>
                            FOR OFFICERS IN BPS 19 & 20 - CONFIDENTIAL
                            <br>
                            PART 1
                        </h4>

                        <form method="POST" action="{{ route('acrPartOne.store') }}">
                            @csrf

                            <div class="form-group row">


                                <div class="col-md-2 font-weight-bold ">
                                    <label for="report_from ">{{ __('From') }}<span class="text-danger">*</span></label>
                                    <input id="report_from" type="date"
                                           class="form-control @error('report_from') is-invalid @enderror"
                                           name="from" required
                                           autocomplete="report_from" autofocus>
                                </div>

                                <div class="col-md-2 font-weight-bold ">
                                    <label for="report_to">{{ __('To') }}<span class="text-danger">*</span></label>
                                    <input id="report_to" type="date"
                                           class="form-control @error('report_to') is-invalid @enderror"
                                           name="to" required
                                           autocomplete="report_to" autofocus>
                                </div>
                                <div class="col-md-4 font-weight-bold ">
                                    <label for="name">{{ __('NAME') }}<span class="text-danger">*</span></label>
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name" required
                                           autocomplete="name" autofocus
                                           value="{{$user->first_name . ' ' . $user->middle_name .  ' ' . $user->last_name}}">
                                </div>


                                <div class="col-md-4 font-weight-bold ">
                                    <label for="personal_no">{{ __('PERSONAL NO') }}<span
                                            class="text-danger">*</span></label>
                                    <input id="personal_no" type="text"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           name="personal_no" value="{{ $user->personal_no }}" required
                                           autocomplete="personal_no" autofocus>
                                </div>


                                <div class="col-md-4 font-weight-bold ">
                                    <label for="dob">{{ __('DATE OF BIRTH') }}<span class="text-danger">*</span></label>
                                    <input id="dob" type="date"
                                           class="form-control @error('dob') is-invalid @enderror"
                                           name="dob" value="{{ $user->birth_date }}" required
                                           autocomplete="dob" autofocus>
                                </div>


                                <div class="col-md-4 font-weight-bold ">
                                    <label for="date_of_joining">{{ __('DATE OF ENTRY IN SERVICE') }}<span
                                            class="text-danger">*</span></label>
                                    <input id="date_of_joining" type="date"
                                           class="form-control @error('date_of_joining') is-invalid @enderror"
                                           name="date_of_joining"
                                           value="" required
                                           autocomplete="date_of_joining">
                                </div>

                                <div class="col-md-4 font-weight-bold ">
                                    <label for="post_held_during_period_with_bps">{{ __('POST HELD DURING THE PERIOD') }}</label>
                                    <input id="post_held_during_period_with_bps" type="text"
                                           class="form-control @error('post_held_during_period_with_bps') is-invalid @enderror"
                                           name="post_held_during_period_with_bps"
                                           autocomplete="post_held_during_period_with_bps">

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                                <div class="col-md-3 font-weight-bold ">
                                    <label for="post_served">{{ __('Period served') }}<span
                                            class="text-danger">*</span></label>
                                    <input id="post_served" type="text"
                                           class="form-control @error('post_served') is-invalid @enderror"
                                           name="post_served" value="{{ $user->personal_no }}" required
                                           autocomplete="personal_no" >
                                </div>

                                <div class="col-md-3 font-weight-bold ">
                                    <label for="in_present_post">{{ __('In present post') }}<span
                                            class="text-danger">*</span></label>
                                    <input id="in_present_post" type="text"
                                           class="form-control @error('in_present_post') is-invalid @enderror"
                                           name="in_present_post" value="{{ $user->personal_no }}" required
                                           autocomplete="personal_no" >
                                </div>


                                <div class="col-md-3 font-weight-bold ">
                                    <label for="under_the_reporting_officer_name">{{ __('Reporting Officer Name') }}<span
                                            class="text-danger">*</span></label>
                                    <input id="under_the_reporting_officer_name" type="text"
                                           class="form-control @error('under_the_reporting_officer_name') is-invalid @enderror"
                                           name="under_the_reporting_officer_name" value="{{ auth()->user()->first_name . " " . auth()->user()->middle_name . auth()->user()->last_name }}" required
                                           autocomplete="personal_no" >
                                </div>


                                <div class="col-md-3 font-weight-bold ">
                                    <label for="under_the_reporting_officer_cnic">{{ __('Reporting Officer CNIC') }}<span
                                            class="text-danger">*</span></label>
                                    <input id="under_the_reporting_officer_cnic" type="text"
                                           class="form-control @error('under_the_reporting_officer_cnic') is-invalid @enderror"
                                           name="under_the_reporting_officer_cnic" value="{{ auth()->user()->cnic }}" required
                                           autocomplete="personal_no" >
                                </div>



                                <div class="col-md-4 font-weight-bold ">
                                    <br>
                                    <label for="academic_qualification">{{ __('ACADEMIC QUALIFICATION') }}</label>
                                    <textarea
                                        class="form-control @error('academic_qualification') is-invalid @enderror" name="academic_qualification"></textarea>
                                    @error('academic_qualification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                    <input type="hidden" name="department_id" value="{{auth()->user()->dep_id}}">
                                </div>




                                <div class="col-md-8 font-weight-bold ">
                                    <br>
                                    <label
                                        for="knowledge_of_languages_speaking_reading_writing">{{ __('KNOWLEDGE OF LANGUAGES (please indicate proficiency in speaking(s), reading(R) and writing(W)') }}</label>
                                    <textarea class="form-control" name="knowledge_of_languages_speaking_reading_writing"></textarea>
                                    @error('knowledge_of_languages_speaking_reading_writing')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="col-md-12 pt-2 pb-2 font-weight-bold ">
                                    Training received during the evaluation period (Training courses
                                    attended earlier, If any May please be listed separately on the back page of the
                                    report)
                                </div>
                                <div class="col-md-3 ">
                                    <br>
                                    <label for="">{{ __('Name of Course attended') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="training[0][subject]" class="form-control">
                                </div>


                                <div class="col-md-3 ">
                                    <br>
                                    <label for="">{{ __('Name of institution') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="training[0][institute]" class="form-control">
                                </div>


                                <div class="col-md-2 ">
                                    <br>
                                    <label for="Country">{{ __('Country') }}<span class="text-danger">*</span></label>
                                    <select name="training[0][country]" id="Country" class="form-control">
                                        @foreach(\App\User::country() as $country)
                                            <option value="{{$country}}">{{$country}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-2 ">
                                    <br>
                                    <label for="">{{ __('From') }}<span class="text-danger">*</span></label>
                                    <input type="date" name="training[0][from]" class="form-control">
                                </div>

                                <div class="col-md-2 ">
                                    <br>
                                    <label for="">{{ __('To') }}<span class="text-danger">*</span></label>
                                    <input type="date" name="training[0][to]" class="form-control">
                                </div>


                            </div>


                            <div class="myrow">

                            </div>
                            <div class="row">
                                <div class="col-md-3" align="left">
                                    <a id="add_more_integrent" type="" class="btn btn-success"> Add More</a>
                                </div>

                                <div class="col-md-6" align="center">
                                </div>
                                <div class="">
                                </div>
                            </div>

                            <div class="form-group row">

                                <br>
                                <br>

                                <div class="col-md-12">
                                    <h3 class="text-center">Part II</h3>
                                    <p class="text-center font-weight-bold">(TO BE FILLED IN BY THE OFFICER REPORTED UPON)</p>
                                </div>

                                <div class="col-md-12 font-weight-bold text-center">
                                    <label for="job_description" class="text-center">{{ __('Job Description') }}<span class="text-danger">*</span></label>
                                    <textarea name="job_description" class="form-control @error('job_description') is-invalid @enderror" id="" cols="30" rows="10"></textarea>
                                </div>


                                <div class="col-md-12 font-weight-bold text-center">
                                    <br>
                                    <br>
                                    <p class="text-center font-weight-bold">Brief account of achievements during the period supported by
                                        statistical data where possible, targets given and actual performance against such targets should be highlighted.
                                        Reasons for shortfall, if any, may also be stated. </p>
                                    <textarea name="brief_account_achievements" class="form-control @error('brief_account_achievements') is-invalid @enderror" id="" cols="30" rows="10"></textarea>
                                </div>



                            </div>


                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save Part One') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="newqual" style="display: none">
                            <br>
                            <div class="row">
                                <div class="cross col-md-6">
                                    <a href="javascript:(0);" class="btn btn-danger">
                                        Close
                                    </a>
                                </div>

                                <hr width="100%" style="margin-top: 1rem">

                                <div class="col-md-3 ">
                                    <br>
                                    <label for="">{{ __('Name of Course attended') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="training[xcount_replaceable][subject]" class="form-control">
                                </div>


                                <div class="col-md-3 ">
                                    <br>
                                    <label for="">{{ __('Name of institution') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="training[xcount_replaceable][institute]" class="form-control">
                                </div>

                                <div class="col-md-2 ">
                                    <br>
                                    <label for="">{{ __('Country') }}<span class="text-danger">*</span></label>
                                    <select name="training[xcount_replaceable][country]" class="form-control">
                                        @foreach(\App\User::country() as $country)
                                            <option value="{{$country}}" >{{$country}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-md-2 ">
                                    <br>
                                    <label for="">{{ __('From') }}<span class="text-danger">*</span></label>
                                    <input type="date" name="training[xcount_replaceable][from]" class="form-control">
                                </div>

                                <div class="col-md-2 ">
                                    <br>
                                    <label for="">{{ __('To') }}<span class="text-danger">*</span></label>
                                    <input type="date" name="training[xcount_replaceable][to]" class="form-control">
                                </div>
                                <hr width="100%" style="margin-top: 2rem">

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


@section('scripts')


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#example').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],

                iDisplayLength: -1,
                dom: 'lBfrtip',
                buttons: [{
                    extend: 'copy',
                    text: window.copyButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                    {
                        extend: 'csv',
                        text: window.csvButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        text: window.excelButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: window.pdfButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: window.printButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },


                ]
            });

        });

    </script>

    {{-- <script src="{{asset('js/external/jquery/jquery.js')}}"></script>
    <script src="{{asset('js/external/jquery/jquery-ui.js')}}"></script>
    <script>
        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 18,
                max: 60,
                @if (Request::get('age'))
                    @php $arr = explode('-',Request::get('age')); @endphp
                values: [{{$arr[0]}}, {{$arr[1]}}],
                @else
                values: [18, 60],
                @endif

                slide: function (event, ui) {
                    $("#amount").val("" + ui.values[0] + "-" + ui.values[1]);
                }
            });
            $("#amount").val("" + $("#slider-range").slider("values", 0) +
                " - " + $("#slider-range").slider("values", 1));
        });
    </script>
    <script type="text/javascript">
        $('#advance').click(function () {
            $('#filters').slideToggle(1000);
        });
    </script> --}}
@endsection
