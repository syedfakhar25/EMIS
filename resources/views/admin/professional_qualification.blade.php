@extends('layouts.master')

@section('title')
    Add Professional
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3> Professional Qualification
                            <span style="color: #777777"> - Step 4</span>
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
                                <li class="alert alert-danger">Add missing fields</li>
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
                                <form action="/professional_qualifications/{{$employee_id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if(count($employee->professional_qualification)>0)
                                        @foreach($employee->professional_qualification as $qual)
                                            <div class="myqual">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="{{url('professional_qualifications/' . $qual->employee_id . '/' . $qual->id )}}" class="btn btn-danger float-right">Edit</a>
                                                        @php $link = 'professional_qualifications/'; @endphp
                                                        @if((auth()->user()->usertype == 'department_admin' || auth()->user()->usertype == 'admin') && $qual->verified != 1)
                                                            <a href="{{url($link . $qual->id )}}" class="btn btn-outline-warning btn-sm" title="Not Verified: Click to verify."><i class="fa fa-user-check"></i> Verify</a>
                                                        @elseif((auth()->user()->usertype == 'department_admin' || auth()->user()->usertype == 'admin') && $qual->verified == 1)
                                                            <a href="javascript:;" class="btn btn-outline-success btn-sm" title="Verified"><i class="fa fa-user-check"></i> Verified</a>
                                                        @endif
                                                        @if(auth()->user()->usertype == 'user' && $qual->verified != 1)
                                                            <a href="javascript:;" class="btn btn-outline-warning btn-sm"> Not Verified</a>
                                                        @elseif(auth()->user()->usertype == 'user' && $qual->verified == 1)
                                                            <a href="javascript:;" class="btn btn-outline-success btn-sm"><i class="fa fa-user-check"></i> Verified</a>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Degree Name:</label> {{$qual->degree_name}}

                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Year of Passing:</label> {{$qual->year}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Institution:</label>{{$qual->institute}}
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Place of Degree:</label>{{$qual->place_of_degree}}
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Subject:</label> {{$qual->subject}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Division/Grade:</label>{{$qual->grade}}
                                                    </div>
                                                    @if($qual->degree_image)

                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Image:</label>
                                                            <a href="{{ asset('uploads/employee/'. $qual->degree_image) }}"
                                                               target="_blank">Show Certificate
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <hr width="100%" style="margin-top: 3rem">
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="myqual">
                                            <div class="row ">
                                                <div class="col-md-12" align="right">
                                                    <input type="file" name="filelogo[]" for="exampleInputEmail1" class="">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Degree Name*</label>
                                                    <input type="text" name="degree_name[]" value="{{old('degree_name')}}" class="form-control" required >
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Year of Passing*</label>
                                                    <select name="year[]" id="year" class="form-control select2" required>
                                                    @for($i = 1900; $i <= date('Y'); $i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                    </select>
                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Institution*</label>
                                                    <input type="text" name="institute[]" value="{{old('institute')}}" class="form-control" required>
                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Place of Degree*</label>
                                                    <input type="text" name="place_of_degree[]" value="{{old('place_of_degree')}}" class="form-control" required>
                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Subject*</label>
                                                    <input type="text" name="subject[]" value="{{old('subject')}}" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Division/Grade*</label>
                                                    <input type="text" name="grade[]" value="{{old('grade')}}" class="form-control" required>
                                                </div>

                                                <hr width="100%">
                                            </div>
                                        </div>
                                        <div class="col-md-12" align="center">
                                            <button type="submit" name="submit" value="Save" class="btn btn-info"> Save</button>
                                            <button type="submit" name="submit" value="Next" class="btn btn-primary"> Save & Next</button>
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
                                            <a href="/trainings/{{$employee->id}}/edit" type="" class="btn btn-danger"> Skip </a>
                                        </div>
                                    </div>

                                </form>
                                <div class="newqual" style="display: none">
                                    <div class="row">
                                        <div class="cross col-md-6">
                                            <a href="javascript:0;" class=""><i class="now-ui-icons ui-1_simple-remove"></i></a>
                                        </div>
                                        <div class="col-md-6" align="right">
                                            <input type="file" name="filelogo[]" for="exampleInputEmail1" class="">
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Degree Name*</label>
                                            <input type="text" name="degree_name[]" value="" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Year of Passing*</label>
                                            <input type="text" name="year[]" value="" class="form-control" required>
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Institution*</label>
                                            <input type="text" name="institute[]" value="" class="form-control" required>
                                        </div>


                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Place of Degree*</label>
                                            <input type="text" name="place_of_degree[]" value="" class="form-control" required>
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Subject*</label>
                                            <input type="text" name="subject[]" value="" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Division/Grade*</label>
                                            <input type="text" name="grade[]" value="" class="form-control" required>
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
