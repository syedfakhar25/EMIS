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
                                <form action="/teaching_details/{{$teachingDetail->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="myqual">
                                        <div class="row">

                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-4">S. No*</label>
                                                <input type="number" name="number" value="{{$teachingDetail->number}}" class="form-control " required minlength="1">
                                            </div>

                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-4">Subject*</label>
                                                <input type="text" name="subject" value="{{$teachingDetail->subject}}" class="form-control " required minlength="1">
                                            </div>

                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-4">Class *</label>
                                                <input type="text" name="class" value="{{$teachingDetail->class}}" class="form-control " required minlength="1">
                                            </div>

                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-4">Periods*</label>
                                                <input type="text" name="periods" value="{{$teachingDetail->periods}}" class="form-control " required minlength="1">
                                            </div>

                                            <hr width="100%" style="margin-top: 3rem">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" align="center">
                                            <button type="submit"  class="btn btn-info">
                                                Update
                                            </button>
                                        </div>
                                        <div class="col-md-3" align="right">
                                            <a href="/teaching_details/{{$teachingDetail->employee_id}}" type=""
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
