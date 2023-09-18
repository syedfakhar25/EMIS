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

                                <form action="{{url('professional_qualifications/' . $professionalQualification->employee_id . '/'. $professionalQualification->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="myqual">
                                        <div class="row ">
                                            <div class="col-md-4">
                                                <a href="{{ asset('uploads/employee/'. $professionalQualification->degree_image) }}"
                                                   target="_blank">
                                                    <img src="{{ asset('uploads/employee/'. $professionalQualification->degree_image) }}" width="200" height="auto">
                                                </a>
                                            </div>
                                            <div class="col-md-12" align="right">
                                                <input type="file" name="filelogo" for="exampleInputEmail1" class="">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Degree Name*</label>
                                                <input type="text" name="degree_name" value="{{$professionalQualification->degree_name}}" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Year of Passing*</label>
                                                <select name="year" id="year" class="form-control select2" required>
                                                    @for($i = 1900; $i <= date('Y'); $i++)
                                                        <option value="{{$i}}" {{($professionalQualification->year == $i?'selected':'')}}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Institution*</label>
                                                <input type="text" name="institute" value="{{$professionalQualification->institute}}" class="form-control" required>
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Institution*</label>
                                                <input type="text" name="institute" value="{{$professionalQualification->place_of_degree}}" class="form-control" required>
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Place of Degree*</label>
                                                <input type="text" name="place_of_degree" value="{{$professionalQualification->place_of_degree}}" class="form-control" required>
                                            </div>



                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Subject*</label>
                                                <input type="text" name="subject" value="{{$professionalQualification->subject}}" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Division/Grade*</label>
                                                <input type="text" name="grade" value="{{$professionalQualification->grade}}" class="form-control" required>
                                            </div>

                                            <hr width="100%">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" align="center">
                                                <button type="submit" name="submit" value="Update" class="btn btn-info">
                                                    Update
                                                </button>
                                            </div>
                                            <div class="col-md-3" align="right">
                                                <a href="/professional_qualifications/{{$professionalQualification->employee_id}}/edit" type=""
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
