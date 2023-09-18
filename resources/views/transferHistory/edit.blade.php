@extends('layouts.master')

@section('title')
Transfer History - Step 9
@endsection


@section('content')

<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3> Transfer History
                            <span style="color: #777777"> - Step 9 </span>
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
                                <form action="/transfer_history/{{$transfer_history->id}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="myqual">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1" class="col-md-6"> Transfer From</label>
                                                <select name="from_department_id" class="form-control ">
                                                    <option class="form-control" value=""> --Select--</option>
                                                    @foreach($department as $dep)
                                                    <option class="form-control" value="{{ $dep->id }}" {{ ($transfer_history->from_department_id == $dep->id)?'selected':'' }}>
                                                        {{ $dep->dep_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Transfer To</label>
                                                <select name="to_department_id" class="form-control ">
                                                    <option class="form-control" value=""> --Select--</option>
                                                    @foreach($department as $dep)
                                                    <option class="form-control" value="{{ $dep->id }}"
                                                        {{ ($transfer_history->to_department_id == $dep->id)?'selected':'' }}>
                                                        {{ $dep->dep_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1" class="col-md-6">Date of
                                                    Transfer</label>
                                                <input type="date" name="date" value="{{$transfer_history->date}}"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1" class="col-md-6">Stay
                                                    <span style="color: #777777">e.g; 2 years</span>
                                                </label>
                                                <input type="text" name="stay" value="{{$transfer_history->stay}}"
                                                    class="form-control ">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1" class="col-md-6"> Order No. </label>
                                                <input type="text" name="order_no" value="{{$transfer_history->order_no}}"
                                                    class="form-control ">
                                            </div>

                                            <div class="col-md-12" align="center">
                                                <button type="submit" name="submit" value="Save" class="btn btn-info">
                                                    Update</button>

                                                    <a href="/promotion_history/{{$transfer_history->employee_id}}" type=""
                                                        class="btn btn-danger"> Skip </a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="myrow">

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </form>
        </div>
    </div>
    @endsection