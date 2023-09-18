@extends('layouts.master')

@section('title')
    Add Promotion History
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3> Promotion History
                            <span style="color: #777777"> - Step 8 </span>
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
                                <form action="/promotion_history/{{$employee_id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if(count($employee->promotion)>0)
                                        @foreach($employee->promotion as $prom)
                                        <div class="myqual">
                                            <div class="col-md-12">
                                                <a href="{{url('promotion_history/' .  $prom->id . '/edit' )}}"
                                                   class="btn btn-danger float-right">Edit</a>
                                            </div>
                                            <div class="row" >
                                                    <div class="col-md-6" style="text-overflow: ellipsis;">
                                                        <label for="exampleInputEmail1" class="col-md-6">Induction/Up Gradation</label> {{$prom->pro_ind_upgrad}}
                                                    </div>
                                                    <div class="col-md-6" style="text-overflow: ellipsis;">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Promotion</label> {{$prom->promotion}}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Designation:</label>

                                                        @if(is_numeric($prom->designation))

                                                            @if(!empty(\App\Models\Designation::find($prom->designation)->first()))
                                                                {{\App\Models\Designation::find($prom->designation)->designation_name}}
                                                            @endif

                                                        @else
                                                            {{$prom->designation}}
                                                        @endif

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Date of Promotion:</label>{{\Carbon\Carbon::parse($prom->date)->format('d-m-Y')}}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Date of Selection / PSC:</label> {{\Carbon\Carbon::parse($prom->selection_date)->format('d-m-Y')}}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Order No:</label> {{$prom->order_no}}
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="exampleInputEmail1" class="col-md-6"> Time Scale:</label> {{$prom->time_scale}}
                                                    </div>
                                                    <hr width="100%" style="margin-top: 3rem">
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="myqual">
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1" class="col-md-12"> Promotion/Induction/Up Gradation</label>
                                                    <select name="pro_ind_upgrad[]" class="form-control " required>
                                                        <option value="">None</option>
                                                        <option value="Promotion">Promotion</option>
                                                        <option value="Induction">Induction</option>
                                                        <option value="Up Gradation">Up Gradation</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1" class="col-md-12"> Promotion
                                                        <span style="color: #777777">e.g in BPS-17</span></label>
                                                    <input type="text" name="promotion[]" value="{{old('promotion')}}" class="form-control ">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Designation</label>


                                                    @if(auth()->user()->usertype === "admin")
                                                        @php
                                                            $designationList = \App\Models\Designation::all();
                                                        @endphp
                                                        <select name="designation[]" class="form-control">
                                                            <option value="">--Select--</option>
                                                            {!! \App\User::getDesignationByDepartment($employee->dep_id, $employee->designation) !!}
                                                        </select>
                                                    @else
                                                        @php
                                                            $designationList = \App\Models\Designation::where('dep_id',$employee->dep_id)->get();
                                                        @endphp
                                                        <select name="designation[]" class="form-control">
                                                            <option value="">--Select--</option>
                                                            {!! \App\User::getDesignationByDepartment($employee->dep_id, $employee->designation) !!}
                                                        </select>
                                                    @endif





                                                </div>



                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Date of Promotion</label>
                                                    <input type="date" name="date[]" value="{{old('date')}}" class="form-control ">
                                                </div>
                                                <div class="col-md-4 ">
                                                    <label for="exampleInputEmail1" class="col-md-12"> Date of Selection/PSC</label>
                                                    <input type="date" name="selection_date[]" value="{{old('selection_date')}}" class="form-control ">
                                                </div>
                                                <div class="col-md-4 ">
                                                    <label for="exampleInputEmail1" class="col-md-6"> Order No</label>
                                                    <input type="text" name="order_no[]" value="{{old('order_no')}}" class="form-control ">
                                                </div>


                                                <div class="col-md-4 ">
                                                    <label class="col-md-6"> Time Scale</label>
                                                    <input type="text" name="time_scale[]" value="{{old('time_scale')}}" class="form-control ">
                                                </div>

                                                <div class="col-md-12" align="center">
                                                    <button type="submit" name="submit" value="Save" class="btn btn-info"> Save</button>
                                                    <button type="submit" name="submit" value="Next" class="btn btn-primary"> Save & Next</button>
                                                </div>
                                                <hr width="100%">
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
                                            <a href="/transfer_history/{{$employee->id}}" type="" class="btn btn-danger"> Skip </a>
                                        </div>
                                    </div>
                                </form>
                                <div class="newqual" style="display:none;">
                                    <div class="row">
                                        <div class="cross col-md-12">
                                            <a href="javascript:0;" class=""><i class="now-ui-icons ui-1_simple-remove"></i></a>
                                        </div>


                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1" class="col-md-12"> Promotion/Induction/Up Gradation</label>
                                            <select name="pro_ind_upgrad[]" class="form-control " required>
                                                <option value="">None</option>
                                                <option value="Promotion">Promotion</option>
                                                <option value="Induction">Induction</option>
                                                <option value="Up Gradation">Up Gradation</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1" class="col-md-12"> Promotion
                                                <span style="color: #777777">e.g in BPS-17</span></label>
                                            <input type="text" name="promotion[]" value="{{old('promotion')}}" class="form-control ">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1" class="col-md-6"> Designation</label>


                                            @if(auth()->user()->usertype === "admin")
                                                @php
                                                    $designationList = \App\Models\Designation::all();
                                                @endphp
                                                <select name="designation[]" class="form-control">
                                                    <option value="">--Select--</option>
                                                    {!! \App\User::getDesignationByDepartment($employee->dep_id, $employee->designation) !!}
                                                </select>
                                            @else
                                                @php
                                                    $designationList = \App\Models\Designation::where('dep_id',$employee->dep_id)->get();
                                                @endphp
                                                <select name="designation[]" class="form-control">
                                                    <option value="">--Select--</option>
                                                    {!! \App\User::getDesignationByDepartment($employee->dep_id, $employee->designation) !!}
                                                </select>
                                            @endif

                                        </div>

                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Date of Promotion</label>
                                            <input type="date" name="date[]" value="" class="form-control ">
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1" class="col-md-12"> Date of Selection/PSC</label>
                                            <input type="date" name="selection_date[]" value="" class="form-control ">
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="exampleInputEmail1" class="col-md-6"> Order No</label>
                                            <input type="text" name="order_no[]" value="" class="form-control ">
                                        </div>

                                        <div class="col-md-4 ">
                                            <label class="col-md-6"> Time Scale</label>
                                            <input type="text" name="time_scale[]" value="{{old('time_scale')}}" class="form-control ">
                                        </div>

                                        <div class="col-md-12" align="center">
                                            <button type="submit" name="submit" value="Save" class="btn btn-info"> Save</button>
                                            <button type="submit" name="submit" value="Next" class="btn btn-primary"> Save & Next</button>
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
