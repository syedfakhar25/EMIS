@extends('layouts.master')

@section('title')
    Add Result History
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3> Result History
                            <span style="color: #777777"> - Step 7 </span>
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
                            label{
                                font-weight:bold !important;
                                color:#000000 !important;
                            }
                        </style>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/result_history/{{$employee_id}}" method="POST" enctype="multipart/form-data" >
                                    @csrf
                                    @if(count($employee->result_history))
                                        @foreach($employee->result_history as $result)
                                            <div class="myqual">
                                                <div class="col-md-12">
                                                    <a href="{{url('result_history/' .  $result->id . '/edit' )}}"
                                                       class="btn btn-danger float-right">Edit</a>
                                                </div>
                                                <div class="row" >
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1" class="col-md-6"> No:</label> {{$result->number}}
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Subject:</label> {{$result->subject}}
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Class:</label>{{$result->class}}
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Session:</label> {{$result->year}}
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Board percentage:</label> {{$result->percentage_board}}%
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1" class="col-md-6"> College percentage:</label> {{$result->percentage_college}}%
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Individual percentage:</label> {{$result->percentage_individual}}%
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
                                                    <input type="number" name="number[]" class="form-control " required minlength="1">
                                                </div>

                                                <div class="col-md-4 ">
                                                    <label for="exampleInputEmail1" class="col-md-4">Subject*</label>
                                                    <input type="text" name="subject[]" class="form-control " required minlength="1">
                                                </div>

                                                <div class="col-md-4 ">
                                                    <label for="exampleInputEmail1" class="col-md-4">Class*</label>
                                                    <input type="text" name="class[]" class="form-control " required minlength="1">
                                                </div>

                                                <div class="col-md-4 ">
                                                    <label for="exampleInputEmail1" class="col-md-4">Session*</label>
                                                    <input type="number" name="year[]"  class="form-control " required minlength="1">
                                                </div>

                                                <div class="col-md-4 ">
                                                    <label for="exampleInputEmail1" class="col-md-4">% Board/Uni*</label>
                                                    <input type="text" name="percentage_board[]"  class="form-control " required minlength="1">
                                                </div>

                                                <div class="col-md-4 ">
                                                    <label for="exampleInputEmail1" class="col-md-4">% College*</label>
                                                    <input type="text" name="percentage_college[]"  class="form-control " required minlength="1">
                                                </div>


                                                <div class="col-md-4 ">
                                                    <label for="exampleInputEmail1" class="col-md-4">% Individual*</label>
                                                    <input type="text" name="percentage_individual[]"  class="form-control " required minlength="1">
                                                </div>
                                                <hr width="100%">

                                                <div class="col-md-12" align="center">
                                                    <button type="submit" name="submit" value="Save" class="btn btn-info"> Save</button>
                                                    <button type="submit"  name="submit" value="Next" class="btn btn-primary"> Save & Next </button>
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
                                            <a href="/promotion_history/{{$employee->id}}" type="" class="btn btn-danger"> Skip </a>
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
                                            <label for="exampleInputEmail1" class="col-md-4">Class*</label>
                                            <input type="text" name="class[]" class="form-control " required minlength="1">
                                        </div>

                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1" class="col-md-4">Session*</label>
                                            <input type="number" name="year[]"  class="form-control " required minlength="1">
                                        </div>

                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1" class="col-md-4">% Board/Uni*</label>
                                            <input type="text" name="percentage_board[]"  class="form-control " required minlength="1">
                                        </div>

                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1" class="col-md-4">% College*</label>
                                            <input type="text" name="percentage_college[]"  class="form-control " required minlength="1">
                                        </div>

                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1" class="col-md-4">% Individual*</label>
                                            <input type="text" name="percentage_individual[]"  class="form-control " required minlength="1">
                                        </div>


                                        <div class="col-md-12" align="center">
                                            <button type="submit" name="submit" value="Save" class="btn btn-info"> Save</button>
                                            <button type="submit"  name="submit" value="Next" class="btn btn-primary"> Save & Next </button>
                                        </div>
                                        <hr width="100%">
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
