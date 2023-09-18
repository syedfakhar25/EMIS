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
                            <form action="/promotion_history/{{$promotionHistory->id}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="myqual">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1" class="col-md-12"> Promotion/Induction/Up Gradation</label>
                                            <select name="pro_ind_upgrad" class="form-control " required>
                                                <option value="">None</option>
                                                <option value="Promotion" {{$promotionHistory->pro_ind_upgrad == "Promotion"?'selected':''}}>Promotion</option>
                                                <option value="Induction" {{$promotionHistory->pro_ind_upgrad == "Induction"?'selected':''}}>Induction</option>
                                                <option value="Up Gradation" {{$promotionHistory->pro_ind_upgrad == "Up Gradation"?'selected':''}}>Up Gradation</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1" class="col-md-12"> Promotion
                                                <span style="color: #777777">e.g in BPS-17</span></label>
                                                <input type="text" name="promotion" value="{{$promotionHistory->promotion}}" class="form-control ">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1" class="col-md-6"> Designation</label>

                                                @php
                                                    $designationList = \App\Models\Designation::where('dep_id',$employees->dep_id)->get();
                                                @endphp
                                                <select name="designation" class="form-control">
                                                    <option value="">--Select--</option>
                                                    @if($designationList->isNotEmpty())
                                                        @foreach($designationList as $desList)
                                                            <option value="{{$desList->id}}"
                                                                    @if($employees->designation == $desList->id) selected @endif>{{$desList->designation_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>


{{--                                                <input type="text" name="designation" value="{{$promotionHistory->designation}}" class="form-control ">--}}
                                            </div>



                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Date of Promotion</label>
                                                <input type="date" name="date" value="{{$promotionHistory->date}}" class="form-control ">
                                            </div>
                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-12"> Date of Selection/PSC</label>
                                                <input type="date" name="selection_date" value="{{$promotionHistory->selection_date}}" class="form-control ">
                                            </div>
                                            <div class="col-md-4 ">
                                                <label for="exampleInputEmail1" class="col-md-6"> Order No</label>
                                                <input type="text" name="order_no" value="{{$promotionHistory->order_no}}" class="form-control ">
                                            </div>

                                            <div class="col-md-4 ">
                                                <label class="col-md-6"> Time Scale</label>
                                                <input type="text" name="time_scale"  value="{{$promotionHistory->time_scale}}"  class="form-control ">
                                            </div>

                                            <hr width="100%">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6" align="center">
                                            <button type="submit"  class="btn btn-info">
                                                Update
                                            </button>
                                        </div>
                                        <div class="col-md-3" align="right">
                                            <a href="/promotion_history/{{$promotionHistory->employee_id}}" type=""
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
            @endsection
