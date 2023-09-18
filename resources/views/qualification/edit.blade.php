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

                                <form
                                    action="{{url('qualifications/' . $qualification->employee_id . '/' . $qualification->id)}}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="myqual">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a href="{{ asset('uploads/employee/'. $qualification->degree_image) }}"
                                                   target="_blank">
                                                    <img
                                                        src="{{ asset('uploads/employee/'. $qualification->degree_image) }}"
                                                        width="200" height="auto">
                                                </a>
                                            </div>
                                            <div class="col-md-12" align="right">
                                                <input type="file" name="filelogo" for="exampleInputEmail1"
                                                       class="form-control-file">
                                            </div>
                                            <hr width="100%" style="margin-top: 1rem">
                                            <div class="col-md-6 ">
                                                <label for="browser" class="col-md-6"> Degree Name</label>
                                                <input list="browsers" name="degree_name" id="browser" required
                                                       class="form-control" value="{{$qualification->degree_name}}">
                                                <datalist id="browsers">
                                                    <option value="Matric Science">
                                                    <option value="Matric Arts">
                                                    <option value="O Level">
                                                    <option value="FA">
                                                    <option value="FSc Pre-M">
                                                    <option value="FSc Pre-Engg">
                                                    <option value="A-Level">
                                                    <option value="BA Arts">
													<option value="BA">
													<option value="B.ED">
													<option value="MA">
													<option value="MBA">
                                                    <option value="BCS">
                                                    <option value="BSC">
                                                    <option value="MBBS">
                                                    <option value="BE">
                                                    <option value="M.Phil">
                                                    <option value="MSCS">
                                                    <option value="PHD">
                                                </datalist>
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Year of
                                                    Passing</label>
                                                <select name="year" id="year" class="form-control select2" required>
                                                    @for($i = 1900; $i <= date('Y'); $i++)
                                                        <option value="{{$i}}" {{($qualification->year == $i)?'selected':''}}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>


                                            <div class="col-md-6 ">
                                                <label class="form-label  mt-0" for="file">Qualification Level</label>
                                                <select name="qualification_level"  id="qualification_level"
                                                        class="form-control" required>
                                                    <option value="">None</option>
                                                    <option value="Non-Educated" @if($qualification->qualification_level == "Non-Educated") selected @endif>Non-Educated</option>
                                                    <option value="Primary" @if($qualification->qualification_level == "Primary") selected @endif>Primary</option>
                                                    <option value="Middle" @if($qualification->qualification_level == "Middle") selected @endif>Middle</option>
                                                    <option value="Secondary School Certificate / Matriculation / O - level" @if($qualification->qualification_level == "Secondary School Certificate / Matriculation / O - level") selected @endif>Secondary School Certificate / Matriculation / O - level</option>
                                                    <option value="Higher Secondary School Certificate / Intermediate/ A - level" @if($qualification->qualification_level == "Higher Secondary School Certificate / Intermediate/ A - level") selected @endif>Higher Secondary School Certificate / Intermediate/ A - level</option>
                                                    <option value="Bachelor (14 Years) Degree" @if($qualification->qualification_level == "Bachelor (14 Years) Degree") selected @endif>Bachelor (14 Years) Degree</option>
                                                    <option value="Bachelor (15 Years) Degree" @if($qualification->qualification_level == "Bachelor (15 Years) Degree") selected @endif>Bachelor (15 Years) Degree</option>
                                                    <option value="Bachelor (16 Years) Degree" @if($qualification->qualification_level == "Bachelor (16 Years) Degree") selected @endif>Bachelor (16 Years) Degree</option>
                                                    <option value="Master (16 Years) Degree" @if($qualification->qualification_level == "Master (16 Years) Degree") selected @endif>Master (16 Years) Degree</option>
                                                    <option value="Master (17 years) Degree" @if($qualification->qualification_level == "Master (17 years) Degree") selected @endif>Master (17 years) Degree</option>
                                                    <option value="Master/ MS (18 Years) Degree" @if($qualification->qualification_level == "Master/ MS (18 Years) Degree") selected @endif>Master/ MS (18 Years) Degree</option>
                                                    <option value="M-Phil (18 Years) Degree" @if($qualification->qualification_level == "M-Phil (18 Years) Degree") selected @endif>M-Phil (18 Years) Degree</option>
                                                    <option value="Doctorate Degree" @if($qualification->qualification_level == "Doctorate Degree") selected @endif>Doctorate Degree</option>
                                                    <option value="MS leading to PhD" @if($qualification->qualification_level == "MS leading to PhD") selected @endif>MS leading to PhD</option>
                                                    <option value="Post Doctorate" @if($qualification->qualification_level == "Post Doctorate") selected @endif>Post Doctorate</option>
                                                    <option value="PGD" @if($qualification->qualification_level == "PGD") selected @endif>PGD</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6">
                                                    Field/Subject</label>
                                                <input type="text" name="subject" class="form-control"
                                                       value="{{$qualification->subject}}" required>
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6">Start Date</label>
                                                <input type="date" name="start_date" class="form-control"
                                                       value="{{$qualification->start_date}}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6">End Date</label>
                                                <input type="date" name="end_date" class="form-control"
                                                       value="{{$qualification->end_date}}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="national_foreign"
                                                       class="col-md-6">National/Foreign</label>
                                                <select name="national_foreign" id="national_foreign"
                                                        class="form-control select2" required>
                                                    <option value="National" {{($qualification->national_foreign == 'National')?'selected':''}}>National</option>
                                                    <option value="Foreign" {{($qualification->national_foreign == 'Foreign')?'selected':''}}>Foreign</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1"
                                                       class="col-md-6">Institution/School/College/University</label>
                                                <input type="text" name="institute" class="form-control "
                                                       value="{{$qualification->institute}}" required>
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Country</label>
                                                <input type="text" name="country"  class="form-control"
                                                       value="{{$qualification->country}}" required>
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Province</label>
                                                <input type="text" name="province" class="form-control "
                                                       value="{{$qualification->province}}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="city" class="col-md-6">District/City/Location</label>
                                                <input type="text" name="city" class="form-control "
                                                       value="{{$qualification->city}}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="marks" class="col-md-6">
                                                    Division/Grade/GPA/CGPA/Marks(%)</label>
                                                <input type="text" name="marks_percentage" id="marks"
                                                       class="form-control " required
                                                       value="{{$qualification->marks_percentage}}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="major_specialization" class="col-md-6"> Major
                                                    Specialization(e.g.Accounting)</label>
                                                <input type="text" name="major_specialization"
                                                       id="major_specialization" class="form-control"
                                                       value="{{$qualification->major_specialization}}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="minor_spacialization" class="col-md-6"> Minor
                                                    Specialization (e.g. Finance)</label>
                                                <input type="text" name="minor_spacialization"
                                                       class="form-control"
                                                       value="{{$qualification->minor_spacialization}}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="bond_details" class="col-md-6">Bond details</label>
                                                <input type="text" name="bond_details" class="form-control"
                                                       value="{{$qualification->bond_details}}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="source_of_funding" class="col-md-6">Source of
                                                    funding</label>
                                                <input type="text" name="source_of_funding" class="form-control"
                                                       value="{{$qualification->source_of_funding}}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6">
                                                    Division/Grade</label>
                                                <input type="text" name="grade" class="form-control "
                                                       value="{{$qualification->grade}}">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="degree_status" class="col-md-6">Degree Status</label>
                                                <select name="degree_status" id="degree_status" required
                                                        class="form-control select2">
                                                    <option value="Completed" {{($qualification->degree_status == 'Completed')?'selected':''}}>Completed</option>
                                                    <option value="In Process" {{($qualification->degree_status == 'In Process')?'selected':''}}>In Process</option>
                                                    <option value="Failed" {{($qualification->degree_status == 'Failed')?'selected':''}}>Failed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" align="center">
                                                <button type="submit" name="submit" value="Update" class="btn btn-info">
                                                    Update
                                                </button>
                                            </div>
                                            <div class="col-md-3" align="right">
                                                <a href="/qualifications/{{$qualification->employee_id}}/edit" type=""
                                                   class="btn btn-danger"> Skip </a>
                                            </div>
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
