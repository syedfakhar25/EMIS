@extends('layouts.master')

@section('title')
    Add Teaching Details
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3> Teaching Details
                            <span style="color: #777777"> - Step 6 </span>
                        </h3>
                        <h6 style="color: #6c757d"> (For Teachers Only..)</h6>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-info" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
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
                            }

                        </style>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/teaching_details/{{ $employee_id }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if (count($employee->teaching_details) > 0)
                                        @foreach ($employee->teaching_details as $teach)
                                            <div class="myqual">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="{{ url('teaching_details/' . $teach->id . '/edit') }}" class="btn btn-danger float-right">Edit</a>

                                                        {{-- @php $link = 'teaching_details/'; @endphp--}}
                                                        {{-- @if ((auth()->user()->usertype == 'department_admin' || auth()->user()->usertype == 'admin') && $teach->verified != 1)--}}
                                                            {{-- <a href="{{ url($link . $teach->id) }}" class="btn btn-outline-warning btn-sm" title="Not Verified: Click to verify."><i class="fa fa-user-check"></i> Verify</a>--}}
                                                            {{-- @elseif((auth()->user()->usertype == 'department_admin' || auth()->user()->usertype == 'admin') && $teach->verified == 1)--}}
                                                            {{-- <a href="javascript:;" class="btn btn-outline-success btn-sm" title="Verified"><i class="fa fa-user-check"></i> Verified</a>--}}
                                                            {{-- @endif--}}
                                                        {{-- @if (auth()->user()->usertype == 'user' && $teach->verified != 1)--}}
                                                            {{-- <a href="javascript:;" class="btn btn-outline-warning btn-sm"> Not Verified</a>--}}
                                                            {{-- @elseif(auth()->user()->usertype == 'user' && $teach->verified == 1)--}}
                                                            {{-- <a href="javascript:;" class="btn btn-outline-success btn-sm"><i class="fa fa-user-check"></i> Verified</a>--}}
                                                            {{-- @endif--}}
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1" class="col-md-6"> No:</label> {{ $teach->number }}
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Subject:</label> {{ $teach->subject }}
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Class:</label>{{ $teach->class }}
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Period:</label> {{ $teach->periods }}
                                                    </div>
                                                    <hr width="100%" style="margin-top: 3rem">
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="myqual">
                                            <div class="row">

                                                <div class="col-md-4 ">
                                                    <label for="exampleInputEmail1" class="col-md-4">S. No*</label>
                                                    <input type="number" name="number[]" value="{{ old('number') }}" class="form-control " required minlength="1">
                                                </div>

                                                <div class="col-md-4 ">
                                                    <label for="exampleInputEmail1" class="col-md-4">Subject*</label>
                                                    <input type="text" name="subject[]" value="{{ old('subject') }}" class="form-control " required minlength="1">
                                                </div>

                                                <div class="col-md-4 ">
                                                    <label for="exampleInputEmail1" class="col-md-4">Class *</label>
                                                    <input type="text" name="class[]" value="{{ old('class') }}" class="form-control " required minlength="1">
                                                </div>

                                                <div class="col-md-4 ">
                                                    <label for="exampleInputEmail1" class="col-md-4">Periods*</label>
                                                    <input type="text" name="periods[]" value="{{ old('periods') }}" class="form-control " required minlength="1">
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
                                                <a href="/result_history/{{ $employee->id }}" class="btn btn-danger"> Skip </a>
                                            @else
                                                <a href="/promotion_history/{{ $employee->id }}" class="btn btn-danger"> Skip </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                                <div class="newqual" style="display: none">
                                    <div class="row">
                                        <div class="cross col-md-12">
                                            <a href="javascript:0;" class=""><i class="now-ui-icons ui-1_simple-remove"></i></a>
                                        </div>

                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1" class="col-md-4">S. No*</label>
                                            <input type="number" name="number[]" class="form-control " required minlength="1">
                                        </div>

                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1" class="col-md-4">Subject*</label>
                                            <input type="text" name="subject[]" class="form-control " required minlength="1">
                                        </div>

                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1" class="col-md-4">Class *</label>
                                            <input type="text" name="class[]" class="form-control " required minlength="1">
                                        </div>

                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1" class="col-md-4">Periods*</label>
                                            <input type="text" name="periods[]" class="form-control " required minlength="1">
                                        </div>

                                        <hr width="100%">

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
