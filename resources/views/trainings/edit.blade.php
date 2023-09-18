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
                                <form action="/trainings/{{$trainings->employee_id}}/{{$trainings->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="myqual">
                                        <div class="row">
                                            @if($trainings->degree_image)
                                            <div class="col-md-4">
                                                <a href="{{ asset('uploads/training/'. $trainings->degree_image) }}"
                                                   target="_blank">
                                                    <img
                                                        src="{{ asset('uploads/training/'. $trainings->degree_image) }}"
                                                        width="200" height="auto">
                                                </a>
                                            </div>
                                            @endif
                                            <div class="col-md-6" align="right">
                                                <input type="file" name="filelogo" for="exampleInputEmail1" class="">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Title of Training*</label>
                                                <input type="text" name="title" value="{{$trainings->title}}" class="form-control " required>
                                            </div>
                                            <div class="col-md-6">
                                                <label> National/Foreign </label>
                                                <select name="national" class="form-control "  required>
                                                    <option value="" class="form-control"> --Select--</option>
                                                    <option value="national"
                                                            class="form-control" {{($trainings->national == "national")?'selected':''}}>
                                                        National/Local
                                                    </option>
                                                    <option value="foreign"
                                                            class="form-control" {{($trainings->national == "foreign")?'selected':''}}>
                                                        Foreign
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Start Date</label>
                                                <input type="date" name="start_date" value="{{$trainings->start_date}}" class="form-control ">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> End Date*</label>
                                                <input type="date" name="end_date" value="{{$trainings->end_date}}" class="form-control ">
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Training Type*</label>
                                                <select name="type" class="form-control " required>
                                                    <option value="" class="form-control"> --Select--</option>
                                                    <option value="Foreign"
                                                            class="form-control" {{($trainings->type == "Foreign")?'selected':''}}>
                                                        Foreign
                                                    </option>
                                                    <option value="Local"
                                                            class="form-control" {{($trainings->type == "Local")?'selected':''}}>
                                                        Local
                                                    </option>
                                                    <option value="Distant Learning"
                                                            class="form-control" {{($trainings->type == "Distant Learning")?'selected':''}}>
                                                        Distant Learning
                                                    </option>
                                                    <option value="Online"
                                                            class="form-control" {{($trainings->type == "Online")?'selected':''}}>
                                                        Online
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 ">
                                               <label for="exampleInputEmail1" class="col-md-6"> Institute/Organization*</label>
                                                <input type="text" name="institute" value="{{$trainings->institute}}" class="form-control " required>
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Place/Location*</label>
                                                <input type="text" name="place" value="{{$trainings->place}}" class="form-control " required>
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Country*</label>
                                                <input type="text" name="country" value="{{$trainings->country}}" class="form-control " required>
                                            </div>

                                            <div class="col-md-6 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Funded By*</label>
                                                <input type="text" name="funded_by" value="{{$trainings->funded_by}}" class="form-control " required>
                                            </div>
                                            <hr width="100%" style="margin-top: 3rem">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6" align="center">
                                            <button type="submit" name="submit" value="Update" class="btn btn-info">
                                                Update
                                            </button>
                                        </div>
                                        <div class="col-md-3" align="right">
                                            <a href="/trainings/{{$trainings->employee_id}}/edit" type=""
                                               class="btn btn-danger"> Skip </a>
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
