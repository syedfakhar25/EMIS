@extends('layouts.master')

@section('title')
    Employees
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <style>
                    label{
                        font-weight:bold !important;
                        color:#000000 !important;
                    }
                </style>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header">
                            <h4 class="card-title">Employees
                            </h4>
                        </div>
                    </div>
                    @if(Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin')
                    <div class="col-md-6" style="padding-top: 20px; padding-left: 300px">
                        <a href="/show-employees" class="" style="text-decoration: none; color: red"><b>Reset</b> </a>
                        <button type="button" id="advance" style="" class="btn btn-info">
                            <i class="now-ui-icons ui-1_zoom-bold" ></i>
                            Search Filters
                        </button>
                    </div>
                    @endif
                   {{-- <div class="col-md-4 ">
                        <label> Employement Status* </label>
                        <select name="emp_status" class="form-control col-md-6">
                            <option value="" class="form-control"> --Select--</option>
                            <option value="adhoc" class="form-control"> Adhoc </option>
                            <option value="permanent" class="form-control"> Permanent </option>
                            <option value="contract" class="form-control"> Contract </option>
                            <option value="temporary" class="form-control"> Temporary </option>
                            <option value="deputation" class="form-control"> Deputation </option>
                            <option value="internee" class="form-control"> Internee </option>
                        </select>
                    </div>--}}

                </div>

                @if (session('success'))
                    <div class="alert alert-info" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert " role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card-body">
                    <style>
                        th{
                            font-weight:bold !important;
                           /* color:#000000 !important;*/
                        }

                    </style>
                    @if(Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin')
                    <form action="/search_employees" id="filters" method="POST" enctype="multipart/form-data" style="display: none">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row" id="">
                            <div class="col-3 ">
                                <input name="first_name" type="search" value="{{$first_name}}" placeholder="First Name.. " class="form-control p-2 " style="border-radius:1 !important" >
                            </div>
                            <div class="col-3">
                                <input name="father" type="search" value="{{$father_name}}" placeholder=" Father/Husband's Name.." class="form-control p-2"  >
                            </div>

                            {{--<div class="col  ">
                                <input name="post" type="search" placeholder="Post.." class="form-control ">
                            </div>--}}
                            <div class="col-3 ">
                                <input name="last_name" type="search" value="{{$last_name}}" placeholder="Last Name.. " class="form-control p-2 " style="border-radius:1 !important" >
                            </div>
                            @if( Auth::user()->usertype == 'department_admin')
                                <div class="col-3">
                                    <select name="department" class="form-control p-2 ">
                                            <option  value="{{ Auth::user()->department->id }}">
                                                {{  Auth::user()->department->dep_name }}
                                            </option>
                                    </select>
                                </div>
                            @elseif(Auth::user()->usertype == 'admin')
                                <div class="col-3">
                                    <select name="department" class="form-control p-2 ">
                                        <option value="" disabled selected hidden> Department </option>
                                        @foreach($department as $dep)
                                            <option  value="{{ $dep->id }}" >
                                                {{ $dep->dep_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <hr width="100%">
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <select name="gender" class="form-control p-2 ">
                                    <option value="" disabled selected hidden> Gender</option>
                                    <option value="male"> Male</option>
                                    <option value="female"> Female </option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="district" class="form-control p-2">
                                    <option value="" disabled selected hidden> District </option>
                                    <option value="bagh" > Bagh </option>
                                    <option value="bhimber" > Bhimber </option>
                                    <option value="hattian"> 	Hattian </option>
                                    <option value="haveli" > 	Haveli </option>
                                    <option value="kotli" > 	Kotli </option>
                                    <option value="mirpur" > 	Mirpur </option>
                                    <option value="muzaffarabad" > 	Muzaffarabad </option>
                                    <option value="neelam" > 		Neelam Valley </option>
                                    <option value="poonch" > 		Poonch </option>
                                    <option value="sudhanoti" > 		Sudhanoti </option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="refugee_status" class="form-control p-2 ">
                                    <option value="" disabled selected hidden> Refugee Status</option>
                                    <option value="1947"> 1947 </option>
                                    <option value="1965"> 1965 </option>
                                    <option value="1989"> 1989 </option>
                                </select>
                            </div>
                            <div class="col-3">
                                <input name="degree_name" type="search" value="{{$degree_name}}" placeholder=" Degree.." class="form-control p-2" {{--style="border-radius: 0 !important"--}} >
                            </div>
                            <hr width="100%">
                        </div>
                        <div class="row">
                            <div class="col-3 ">
                                <select name="emp_status" class="form-control p-2 ">
                                    <option value="" disabled selected hidden> Type </option>
                                    <option value="adhoc"> Adhoc </option>
                                    <option value="permanent" > Permanent </option>
                                    <option value="contract" > Contract </option>
                                    <option value="temporary"> Temporary </option>
                                    <option value="deputation"> Deputation </option>
                                    <option value="internee"> Internee </option>
                                </select>
                            </div>
                            <div class="col-3 ">
                                <select name="verified" class="form-control p-2 ">
                                    <option value="" disabled selected hidden> Is Verified </option>
                                    <option value="1"> Verified </option>
                                    <option value="0" > Not Verified </option>
                                </select>
                            </div>
                            <div class="col-3">
                                <input name="bps" type="search" value="{{$bps}}" placeholder=" Basic Pay Scale.." class="form-control p-2" {{--style="border-radius: 0 !important"--}} >
                            </div>
                            <div class="col-3">
                                <select name="marital_status" class="form-control p-2 ">
                                    <option value="" disabled selected hidden> Marital Status</option>
                                    <option value="married"> Married </option>
                                    <option value="un_married"> Un-Married </option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widow">Widow</option>
                                </select>
                            </div>
                        </div>

                        <div class="row pl-4">

                                <button type="submit" class="btn btn-info">
                                    Search
                                </button>
                        </div>
                        <hr width="100%">
                    </form>
                        <div row pl-4>
                            Total : {{$total}}
                        </div>

                    <div class="table-responsive">

                        <table class="table">
                            <thead class=" text-primary">
                            <th>Sr. No</th>
                            <th> CNIC </th>
                            <th> Name </th>
                            <th> Department </th>
                            <th> District </th>
                            <th> Salary</th>
                            {{--<th> Department </th>--}}
                            <th colspan="2"style="text-align: center"> Action </th>
                            </thead>
                            <tbody>
                            <?php $count = 0?>
                            @foreach($employees as $emp)
                                <?php $count++ ?>
                                <tr>
                                    <td> {{ $count }}</td>
                                    <td>{{$emp->cnic}}</td>
                                    <td>{{$emp->first_name}} {{$emp->last_name}}</td>
                                    <td>{{--{{$emp->department->dep_name}}--}}</td>
                                    <td> {{$emp->district}}</td>
                                    <td>{{$emp->salary}}</td>
                                    {{--<td>{{$emp->department[0]}}</td>--}}
                                    <td style="text-align: center;">
                                        <a href="{{url('employees/'. $emp->id)}}" class="btn btn-outline-info btn-sm" style="text-decoration: none">
                                            <i class="fa fa-eye " style=""></i>
                                        </a>
                                        <a href="{{url('employees/'. $emp->id .'/edit')}}" class="btn btn-outline-success btn-sm"><i class="fa fa-edit"></i></a>

                                        <form method="post" action="{{ url('employees/'. $emp->id ) }}" style="display: inline-block;">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$employees->links()}}
                    </div>
                    @else
                        <div class="col-md-12">
                            <h5>Info Added:</h5>
                            <a href="/employee-profile/{{Auth::user()->employee_id}}">Click here to see Profile </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script type="text/javascript">
        $('#advance').click(function(){
            $('#filters').slideToggle(1000);
        });
    </script>
@endsection
