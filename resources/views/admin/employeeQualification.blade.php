@extends('layouts.master')

@section('title')
    Add Qualification
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3> Academic Qualification
                            <span style="color: #777777"> - Step 3</span>
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
                                    <form action="/qualifications/{{$employee_id}}" method="POST"
                                          enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @if(count($employee->qualification)>0)
                                            @foreach($employee->qualification as $qual)
                                                <div class="myqual">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <a href="{{url('qualifications/' . $qual->employee_id . '/' . $qual->id )}}"
                                                               class="btn btn-info float-right">Edit</a>
                                                                <form action="{{ route('qualifications.destroy', $qual->id) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                                </form>

                                                            @php $link = 'qualifications/'; @endphp
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
                                                            <label for="exampleInputEmail1" class="col-md-6"> Degree
                                                                Name:</label> {{$qual->degree_name}}
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6"> Year of
                                                                Passing:</label> {{$qual->year}}
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Field/Subject:</label>{{$qual->field}}
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Start Date:</label>{{ Carbon\Carbon::parse($qual->start_date)->format('d-m-Y')}}
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                End Date:</label>{{Carbon\Carbon::parse($qual->end_date)->format('d-m-Y')}}
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                National/Foreign:</label>{{$qual->national_foreign}}
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Institution :</label>{{$qual->institute}}
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                City :</label>{{$qual->city}}
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Country :</label>{{$qual->country}}
                                                        </div>


                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Degree Status :</label>{{$qual->degree_status}}
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Subject:</label> {{$qual->subject}}
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Marks(%age):</label> {{$qual->marks_percentage}}
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Division/Grade:</label>{{$qual->grade}}
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Major Specialization:</label>{{$qual->major_specialization}}
                                                        </div>


                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Minor Specialization :</label>{{$qual->minor_specialization}}
                                                        </div>


                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Source of Funding:</label>{{$qual->source_of_funding}}
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Bond Details:</label>{{$qual->bond_details}}
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Country:</label>{{$qual->country}}
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                Province:</label>{{$qual->province}}
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="exampleInputEmail1" class="col-md-6">
                                                                District:</label>{{$qual->district}}
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
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="file" name="filelogo[]" for="exampleInputEmail1"
                                                               class="form-control-file">
                                                        <label class="form-label  mt-0" for="file">Any file Notification/Certificate</label>
                                                    </div>
                                                    <hr width="100%" style="margin-top: 1rem">

                                                    <div class="col-md-6 ">
                                                        <label for="browser" class="col-md-6"> Degree Name</label>
                                                        <select name="degree_name[]" class="form-control select2">
                                                            @foreach(\App\User::degree_list() as $key => $value)
                                                                <option value="{{$key}}">{{$key}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Year of Passing</label>
                                                        <select name="year[]" class="form-control select2">
                                                            @for($i = 1900; $i <= date('Y'); $i++)
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label mt-0" for="file">Qualification Level</label>
                                                        <select name="qualification_level[]" class="form-control select2" required>
                                                            <option value="">None</option>
                                                            <option value="Non-Educated">Non-Educated</option>
                                                            <option value="Primary">Primary</option>
                                                            <option value="Middle">Middle</option>
                                                            <option value="Secondary School Certificate / Matriculation / O - level">Secondary School Certificate / Matriculation / O - level</option>
                                                            <option value="Higher Secondary School Certificate / Intermediate/ A - level">Higher Secondary School Certificate / Intermediate/ A - level</option>
                                                            <option value="Bachelor (14 Years) Degree">Bachelor (14 Years) Degree</option>
                                                            <option value="Bachelor (15 Years) Degree">Bachelor (15 Years) Degree</option>
                                                            <option value="Bachelor (16 Years) Degree">Bachelor (16 Years) Degree</option>
                                                            <option value="Master (16 Years) Degree">Master (16 Years) Degree</option>
                                                            <option value="Master (17 years) Degree">Master (17 years) Degree</option>
                                                            <option value="Master/ MS (18 Years) Degree">Master/ MS (18 Years) Degree</option>
                                                            <option value="M-Phil (18 Years) Degree">M-Phil (18 Years) Degree</option>
                                                            <option value="Doctorate Degree">Doctorate Degree</option>
                                                            <option value="MS leading to PhD">MS leading to PhD</option>
                                                            <option value="Post Doctorate">Post Doctorate</option>
                                                            <option value="PGD">PGD</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6 ">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Field/Subject</label>
                                                        <input type="text" name="subject[]" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="exampleInputEmail1" class="col-md-6">Start Date</label>
                                                        <input type="date" name="start_date[]" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="exampleInputEmail1" class="col-md-6">End Date</label>
                                                        <input type="date" name="end_date[]" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="national_foreign"
                                                               class="col-md-6">National/Foreign</label>
                                                        <select name="national_foreign[]"
                                                                class="form-control select2" required>
                                                            <option value="National">National</option>
                                                            <option value="Foreign">Foreign</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="exampleInputEmail1"
                                                               class="col-md-6">Institution/School/College/University</label>
                                                        <input type="text" name="institute[]" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Country</label>
                                                        <input type="text" name="country[]" value="" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Province</label>
                                                        <input type="text" name="province[]" value="" class="form-control ">
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="city" class="col-md-6">District/City/Location</label>
                                                        <input type="text" name="city[]" value="" class="form-control ">
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="marks" class="col-md-6">
                                                            Division/Grade/GPA/CGPA/Marks(%)</label>
                                                        <input type="text" name="marks_percentage[]" id="marks"
                                                               class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="major_specialization" class="col-md-6"> Major
                                                            Specialization(e.g.Accounting)</label>
                                                        <input type="text" name="major_specialization[]"
                                                               id="major_specialization" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="minor_spacialization" class="col-md-6"> Minor
                                                            Specialization (e.g. Finance)</label>
                                                        <input type="text" name="minor_spacialization[]"
                                                               class="form-control">
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="bond_details" class="col-md-6">Bond details</label>
                                                        <input type="text" name="bond_details[]" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="source_of_funding" class="col-md-6">Source of
                                                            funding</label>
                                                        <input type="text" name="source_of_funding[]" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="exampleInputEmail1" class="col-md-6">
                                                            Division/Grade</label>
                                                        <input type="text" name="grade[]" class="form-control ">
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="degree_status" class="col-md-6">Degree Status</label>
                                                        <select name="degree_status[]"
                                                                class="form-control select2" required>
                                                            <option value="Completed">Completed</option>
                                                            <option value="In Process">In Process</option>
                                                            <option value="Failed">Failed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" align="center">
                                                    <button type="submit" name="submit" value="Save" class="btn btn-info">
                                                        Save
                                                    </button>
                                                    <button type="submit" name="submit" value="Next" class="btn btn-primary">
                                                        Save & Next
                                                    </button>
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
                                                <a href="/professional_qualifications/{{$employee_id}}/edit" type=""
                                                   class="btn btn-danger"> Skip </a>
                                            </div>

                                        </div>

                                    </form>
                                    </div>
                                </div>
                            <div class="newqual" style="display: none">
                                <form action="/qualifications/{{$employee_id}}" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            {{ csrf_field() }}
                                            <div class="cross col-md-6">
                                                <a href="javascript:(0);" class=""><i
                                                        class="now-ui-icons ui-1_simple-remove"></i></a>
                                            </div>
                                            <div class="col-md-12" align="right">
                                                <input type="file" name="filelogo[]" for="exampleInputEmail1"
                                                       class="form-control-file">
                                                <label class="form-label  mt-0" for="file">Any file Notification/Certificate</label>
                                            </div>
                                            <hr width="100%" style="margin-top: 1rem">
                                            <div class="col-md-6 ">
                                                <label for="" class="col-md-6"> Degree Name</label>
                                                <select name="degree_name[]" class="form-control select2" style="width: 100%">
                                                    @foreach(\App\User::degree_list() as $key => $value)
                                                        <option value="{{$key}}">{{$key}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Year of
                                                    Passing*</label>
                                                <select name="year[]"  class="form-control" tabindex="0" aria-hidden="false" required>
                                                    lect name="year[]" class="form-control select2">
                                                    @for($i = 1900; $i <= date('Y'); $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="col-md-6 ">
                                                <label class="form-label  mt-0" for="file">Qualification Level</label>
                                                <select name="qualification_level[]"
                                                        class="form-control" required>
                                                    <option value="">None</option>
                                                    <option value="Non-Educated">Non-Educated</option>
                                                    <option value="Primary">Primary</option>
                                                    <option value="Middle">Middle</option>
                                                    <option value="Secondary School Certificate / Matriculation / O - level">Secondary School Certificate / Matriculation / O - level</option>
                                                    <option value="Higher Secondary School Certificate / Intermediate/ A - level">Higher Secondary School Certificate / Intermediate/ A - level</option>
                                                    <option value="Bachelor (14 Years) Degree">Bachelor (14 Years) Degree</option>
                                                    <option value="Bachelor (15 Years) Degree">Bachelor (15 Years) Degree</option>
                                                    <option value="Bachelor (16 Years) Degree">Bachelor (16 Years) Degree</option>
                                                    <option value="Master (16 Years) Degree">Master (16 Years) Degree</option>
                                                    <option value="Master (17 years) Degree">Master (17 years) Degree</option>
                                                    <option value="Master/ MS (18 Years) Degree">Master/ MS (18 Years) Degree</option>
                                                    <option value="M-Phil (18 Years) Degree">M-Phil (18 Years) Degree</option>
                                                    <option value="Doctorate Degree">Doctorate Degree</option>
                                                    <option value="MS leading to PhD">MS leading to PhD</option>
                                                    <option value="Post Doctorate">Post Doctorate</option>
                                                    <option value="PGD">PGD</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6">
                                                    Field/Subject*</label>
                                                <input type="text" name="subject[]" class="form-control">
                                            </div>


                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6">Start Date</label>
                                                <input type="date" name="start_date[]" class="form-control">
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6">End Date</label>
                                                <input type="date" name="end_date[]" class="form-control">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="national_foreign"
                                                       class="col-md-6">National/Foreign</label>
                                                <select name="national_foreign[]"
                                                        class="form-control " required>
                                                    <option value="National">National</option>
                                                    <option value="Foreign">Foreign</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1"
                                                       class="col-md-6">Institution/School/College/University</label>
                                                <input type="text" name="institute[]" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Country</label>
                                                <input type="text" name="country[]" value="" class="form-control" required>
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Province</label>
                                                <input type="text" name="province[]" value="" class="form-control ">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="city" class="col-md-6">District/City/Location</label>
                                                <input type="text" name="city[]" value="" class="form-control ">
                                            </div>



                                            <div class="col-md-6 ">
                                                <label for="marks" class="col-md-6">
                                                    Division/Grade/GPA/CGPA/Marks(%)</label>
                                                <input type="text" name="marks_percentage[]" id="marks"
                                                       class="form-control" required>
                                            </div>


                                            <div class="col-md-6 ">
                                                <label for="major_specialization" class="col-md-6"> Major
                                                    Specialization(e.g.Accounting)</label>
                                                <input type="text" name="major_specialization[]"
                                                       id="major_specialization" class="form-control">
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="minor_spacialization" class="col-md-6"> Minor
                                                    Specialization (e.g. Finance)</label>
                                                <input type="text" name="minor_spacialization[]"
                                                       class="form-control">
                                            </div>


                                            <div class="col-md-6 ">
                                                <label for="bond_details" class="col-md-6">Bond details</label>
                                                <input type="text" name="bond_details[]" class="form-control">
                                            </div>


                                            <div class="col-md-6 ">
                                                <label for="source_of_funding" class="col-md-6">Source of
                                                    funding</label>
                                                <input type="text" name="source_of_funding[]" class="form-control">
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6">
                                                    Division/Grade</label>
                                                <input type="text" name="grade[]" class="form-control ">
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="degree_status" class="col-md-6">Degree Status*</label>
                                                <select name="degree_status[]"
                                                        class="form-control" required>
                                                    <option value="Completed">Completed</option>
                                                    <option value="In Process">In Process</option>
                                                    <option value="Failed">Failed</option>
                                                </select>
                                            </div>

                                            <hr width="100%" style="margin-top: 2rem">

                                            <div class="col-md-12" align="center">
                                                <button type="submit" name="submit" value="Save" class="btn btn-info">
                                                    Save
                                                </button>
                                                <button type="submit" name="submit" value="Next" class="btn btn-primary">
                                                    Save & Next
                                                </button>
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
