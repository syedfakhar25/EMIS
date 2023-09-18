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
                                <form action="/transfer_history/{{$employee_id }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @if(count($employee->transfer)>0)
                                    @foreach($employee->transfer as $tran)
                                    <div class="myqual">
                                        <div class="col-md-12">
                                            <a href="{{url('transfer_history/' .  $tran->id . '/edit' )}}"
                                                class="btn btn-danger float-right">Edit</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1"  class="col-3"> Date</label>
                                                {{$tran->date}}

                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1" class="col-3">
                                                    From:</label> {{$tran->from_department['dep_name']}}
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1"  class="col-3">
                                                    To:</label>{{$tran->to_department['dep_name']}}
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1"  class="col-3"> Stay:</label>
                                                {{$tran->stay}}years
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1"  class="col-3"> Order No:</label>
                                                {{$tran->order_no}}
                                            </div>
                                            <hr width="100%" style="margin-top: 3rem">
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="myqual">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1" class="col-md-6"> Transfer From</label>
                                                <select name="from_department_id[]" class="form-control ">
                                                    <option class="form-control" value=""> --Select--</option>
                                                    @foreach($department as $dep)
                                                    <option class="form-control" value="{{ $dep->id }}">
                                                        {{ $dep->dep_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Transfer To</label>
                                                <select name="to_department_id[]" class="form-control ">
                                                    <option class="form-control" value=""> --Select--</option>
                                                    @foreach($department as $dep)
                                                    <option class="form-control" value="{{ $dep->id }}">
                                                        {{ $dep->dep_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1" class="col-md-6">Date of
                                                    Transfer</label>
                                                <input type="date" name="date[]" value="{{old('date')}}"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1" class="col-md-6">Stay
                                                    <span style="color: #777777">e.g; 2 years</span>
                                                </label>
                                                <input type="text" name="stay[]" value="{{old('stay')}}"
                                                    class="form-control ">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1" class="col-md-6"> Order No. </label>
                                                <input type="text" name="order_no[]" value="{{old('order_no')}}"
                                                    class="form-control ">
                                            </div>

                                            <div class="col-md-12" align="center">
                                                <button type="submit" name="submit" value="Save" class="btn btn-info">
                                                    Save</button>
                                                <button type="submit" name="submit" value="Next"
                                                    class="btn btn-primary"> Save &
                                                    Finished</button>
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
                                            @if (\Illuminate\Support\Facades\Auth::user()->usertype == "user")

                                            <a href="/employee_profile/{{\Illuminate\Support\Facades\Auth::user()->id}}"
                                                class="btn btn-danger"> Finish </a>
                                            @else

                                            <a href="/employees" class="btn btn-danger"> Finish </a>

                                            @endif
                                        </div>
                                    </div>
                                </form>
                                <div class="newqual" style="display: none">
                                    <div class="row">
                                        <div class="cross col-md-12">
                                            <a href="javascript:0;" class=""><i
                                                    class="now-ui-icons ui-1_simple-remove"></i></a>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1" class="col-md-6"> Transfer From</label>
                                            <select name="from_department_id[]" class="form-control ">
                                                <option class="form-control" value=""> --Select--</option>
                                                @foreach($department as $dep)
                                                <option class="form-control" value="{{ $dep->id }}">
                                                    {{ $dep->dep_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Transfer To</label>
                                            <select name="to_department_id[]" class="form-control ">
                                                <option class="form-control" value=""> --Select--</option>
                                                @foreach($department as $dep)
                                                <option class="form-control" value="{{$dep->id}}">
                                                    {{ $dep->dep_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1" class="col-md-6">Date of Transfer</label>
                                            <input type="date" name="date[]" value="" class="form-control ">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1" class="col-md-6">Stay
                                                <span style="color: #777777">e.g; 2 years</span>
                                            </label>
                                            <input type="text" name="stay[]" value="" class="form-control ">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1" class="col-md-6"> Order No. </label>
                                            <input type="text" name="order_no[]" value="" class="form-control ">
                                        </div>


                                        <div class="col-md-12" align="center">
                                            <button type="submit" name="submit" value="Save" class="btn btn-info">
                                                Save</button>
                                            <button type="submit" name="submit" value="Next" class="btn btn-primary">
                                                Save & Next</button>
                                        </div>
                                        <hr width="100%">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </form>
        </div>
    </div>
    @endsection