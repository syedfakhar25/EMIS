@extends('layouts.master')

@section('title')
    Add Trainings
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3> Trainings
                            <span style="color: #777777"> - Step 5</span>
                        </h3>
                        <h6 style="color: #6c757d"> (List of trainings you have received in last five years)</h6>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-info" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(count($errors)>0)
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="alert alert-danger"> {{$error}}</li>
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
                                <form action="/trainings/{{$employee_id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if(count($employee->trainings)>0)
                                        @foreach($employee->trainings as $train)
                                            <div class="myqual">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <a href="{{url('trainings/' . $train->employee_id . '/' . $train->id )}}"
                                                           class="btn btn-danger float-right">Edit</a>

                                                        @php $link = 'trainings/'; @endphp
                                                        @if((auth()->user()->usertype == 'department_admin' || auth()->user()->usertype == 'admin') && $train->verified != 1)
                                                            <a href="{{url($link . $train->id )}}" class="btn btn-outline-warning btn-sm" title="Not Verified: Click to verify."><i class="fa fa-user-check"></i> Verify</a>
                                                        @elseif((auth()->user()->usertype == 'department_admin' || auth()->user()->usertype == 'admin') && $train->verified == 1)
                                                            <a href="javascript:;" class="btn btn-outline-success btn-sm" title="Verified"><i class="fa fa-user-check"></i> Verified</a>
                                                        @endif
                                                        @if(auth()->user()->usertype == 'user' && $train->verified != 1)
                                                            <a href="javascript:;" class="btn btn-outline-warning btn-sm"> Not Verified</a>
                                                        @elseif(auth()->user()->usertype == 'user' && $train->verified == 1)
                                                            <a href="javascript:;" class="btn btn-outline-success btn-sm"><i class="fa fa-user-check"></i> Verified</a>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Title:</label> {{$train->title}}

                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Start Date:</label> {{$train->start_date}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> End Date:</label> {{$train->end_date}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            National/Foreign:</label>{{$train->national}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Type:</label> {{$train->type}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Location:</label> {{$train->place}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Institute/Org:</label>{{$train->institute}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Country:</label> {{$train->country}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Funded By:</label>{{$train->funded_by}}
                                                    </div>
                                                    @if($train->degree_image)
                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Show Image:</label>
                                                            <a href="{{ asset('uploads/training/'. $train->degree_image) }}">Show Image/Certificate</a>
                                                        </div>
                                                    @endif
                                                    <hr width="100%" style="margin-top: 3rem">
                                                </div>
                                            </div>
                                        @endforeach
                                    @else

                                        <div class="myqual">
                                            <div class="row">
                                                <div class="col-md-6" align="left">
                                                    <input type="file" name="filelogo[]" for="exampleInputEmail1" class="">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Title of Training*</label>
                                                    <input type="text" name="title[]" value="{{old('title')}}" class="form-control ">
                                                </div>
                                                <div class="col-md-6">
                                                    <label> National/Foreign </label>
                                                    <select name="national[]" class="form-control" required>
                                                        <option value="" class="form-control"> --Select--</option>
                                                        <option value="national"
                                                                class="form-control">
                                                            National/Local
                                                        </option>
                                                        <option value="foreign"
                                                                class="form-control">
                                                            Foreign
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Start Date</label>
                                                    <input type="date" name="start_date[]" class="form-control ">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> End Date</label>
                                                    <input type="date" name="end_date[]" class="form-control">
                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Training Type*</label>
                                                    <select name="type[]" class="form-control " required>
                                                        <option value="" class="form-control"> --Select--</option>
                                                        @foreach(\App\User::training_type() as $types)
                                                            <option value="{{$types}}" class="form-control">
                                                                {{$types}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Institute*</label>
                                                    <input type="text" name="institute[]" class="form-control" required>
                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Place/Location*</label>
                                                    <input type="text" name="place[]" class="form-control " required>
                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Country*</label>
                                                    <input type="text" name="country[]" class="form-control" required>
                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Funded By*</label>
                                                    <input type="text" name="funded_by[]" class="form-control " required>
                                                </div>
                                                <hr width="100%" style="margin-top: 3rem">

                                                <div class="col-md-12" align="center">
                                                    <button type="submit" name="submit" value="Save" class="btn btn-info"> Save</button>
                                                    <button type="submit" name="submit" value="Next" class="btn btn-primary"> Save & Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="myrow">

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3" align="left">
                                            <a id="add_more" type="" class="btn btn-success"> Add More</a>
                                        </div>

                                        <div class="col-md-6" align="center">
                                        </div>
                                        <div class="">

                                        </div>
                                        <div class="col-md-3" align="right">
                                            @if ($employee->dep_id == 4)
                                                <a href="/teaching_details/{{$employee->id}}" type="" class="btn btn-danger"> Skip </a>
                                            @else
                                                <a href="/promotion_history/{{$employee->id}}" type="" class="btn btn-danger"> Skip </a>
                                            @endif

                                        </div>
                                    </div>
                                </form>
                                <div class="newqual" style="display: none">
                                    <div class="row">

                                        <div class="cross col-md-12">
                                            <a href="javascript:0;" class=""><i class="now-ui-icons ui-1_simple-remove"></i></a>
                                        </div>
                                        <hr style="width: 100%">
                                        <div class="col-md-6" align="left">
                                            <input type="file" name="filelogo[]" for="exampleInputEmail1" class="">
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Title of Training*</label>
                                            <input type="text" name="title[]" value="{{old('title')}}" class="form-control " required>
                                        </div>
                                        <div class="col-md-6">
                                            <label> National/Foreign </label>
                                            <select name="national" class="form-control ">
                                                <option value="" class="form-control"> --Select--</option>
                                                <option value="national"
                                                        class="form-control"> National/Local
                                                </option>
                                                <option value="foreign"
                                                        class="form-control">
                                                    Foreign
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Start Date</label>
                                            <input type="date" name="start_date[]" value="{{old('start_date')}}" class="form-control ">
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> End Date</label>
                                            <input type="date" name="end_date[]" value="{{old('end_date')}}" class="form-control ">
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Training Type</label>
                                            <select name="type[]" class="form-control " required>
                                                <option value="" class="form-control"> --Select--</option>
                                                @foreach(\App\User::training_type() as $types)
                                                    <option value="{{$types}}" class="form-control">
                                                        {{$types}}
                                                    </option>
                                                @endforeach
                                                      
                                            </select>
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Institute*</label>
                                            <input type="text" name="institute[]" value="{{old('institute')}}" class="form-control " required>
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Place/Location*</label>
                                            <input type="text" name="place[]" value="{{old('place')}}" class="form-control" required>
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Country*</label>
                                            <input type="text" name="country[]" value="{{old('country')}}" class="form-control" required>
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Funded By*</label>
                                            <input type="text" name="funded_by[]" value="{{old('funded_by')}}" class="form-control" required>
                                        </div>
                                        <hr width="100%" style="margin-top: 3rem">


                                        <div class="col-md-12" align="center">
                                            <button type="submit" name="submit" value="Save" class="btn btn-info"> Save</button>
                                            <button type="submit" name="submit" value="Next" class="btn btn-primary"> Save & Next</button>
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
