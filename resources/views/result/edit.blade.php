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
                                <form action="/result_history/{{$resultHistory->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="myqual">
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-4">S. No*</label>
                                                <input type="number" name="number" class="form-control" value="{{$resultHistory->number}}" required minlength="1">
                                            </div>

                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-4">Subject*</label>
                                                <input type="text" name="subject" class="form-control " required minlength="1" value="{{$resultHistory->subject}}">
                                            </div>

                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-4">Class*</label>
                                                <input type="text" name="class" class="form-control " required minlength="1" value="{{$resultHistory->class}}">
                                            </div>

                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-4">Session*</label>
                                                <input type="number" name="year"  class="form-control " required minlength="1" value="{{$resultHistory->year}}">
                                            </div>

                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-4">% Board/Uni*</label>
                                                <input type="text" name="percentage_board"  class="form-control " required minlength="1" value="{{$resultHistory->percentage_board}}">
                                            </div>

                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-4">% College*</label>
                                                <input type="text" name="percentage_college"  class="form-control " required minlength="1" value="{{$resultHistory->percentage_college}}">
                                            </div>

                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-4">% Individual*</label>
                                                <input type="text" name="percentage_individual"  class="form-control " required minlength="1" value="{{$resultHistory->percentage_individual}}">
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
                                            <a href="/result_history/{{$resultHistory->employee_id}}" type=""
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
