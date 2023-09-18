@extends('layouts.master')

@section('title')
    Employees
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="card-header">
                                <h3>All Employees</h3>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 fo" style="padding-top: 15px;">
                            <button type="button" id="advance" style="" class="btn btn-info float-right">
                                <i class="fa fa-plus"></i>
                                Show/Hide
                            </button>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-info" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif


                    <div class="card" id="filters" style="display: none;">
                        <div class="col-md-12">
                            {{--{{$all_dep}}--}}
                            <form action="{{ url('employees?') }}" method="get">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="name">Name</label>
                                        <input type="search" id="name" class="form-control" name="name"
                                               value="{{ Request::get('name')}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="emis_code">Emis Code</label>
                                        <input type="text" id="emis_code" class="form-control" name="emis_code"
                                               value="{{ Request::get('emis_code') }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="personal_no">Personal No</label>
                                        <input type="text" class="form-control" id="personal_no" name="personal_no"
                                               value="{{ Request::get('personal_no') }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="cnic">CNIC</label>
                                        <input type="text" id="cnic" class="form-control cnic_mask" name="cnic"
                                               value="{{ Request::get('cnic') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                               value="{{ Request::get('phone') }}">
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="ddo_code">DDO Code</label>
                                        <input type="text" class="form-control" id="ddo_code" name="ddo_code"
                                               value="{{ Request::get('ddo_code') }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="scale">Scale</label>
                                        <input type="number" class="form-control" id="scale" name="scale"
                                               value="{{ Request::get('scale') }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="scale_greater">Scale Greater than</label>
                                        <input type="number" class="form-control" id="scale_greater" name="scale_greater"
                                               value="{{ Request::get('scale_greater') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="scale_less">Scale Less Than</label>
                                        <input type="number" class="form-control" id="scale_less" name="scale_less"
                                               value="{{ Request::get('scale_less') }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="designation">Designation</label>
                                        <select class="form-control select2" name="designation[]" id="designation"
                                                style="width:100%" multiple>

{{--                                            @if(auth()->user()->usertype == "admin")--}}
{{--                                                @foreach(\App\Models\Designation::all() as $des)--}}
{{--                                                    <option value="{{$des->designation_name}}" > {{$des->designation_name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            @elseif(auth()->user()->usertype == "department_admin")--}}
{{--                                                @foreach(\App\Models\Designation::where('dep_id',auth()->user()->dep_id)->get() as $des)--}}
{{--                                                    <option value="{{$des->designation_name}}" > {{$des->designation_name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}

                                            @if(auth()->user()->usertype == "admin")
                                                @foreach(\App\Models\Designation::all() as $des)
                                                    <option value="{{$des->designation_name}}" > {{$des->designation_name}}</option>
                                                @endforeach
                                            @elseif(auth()->user()->usertype == "department_admin")
                                                @foreach(\App\User::where('dep_id',auth()->user()->dep_id)->groupBy('designation')->get() as $des)
                                                    <option value="{{$des->designation}}" > {{$des->designation}}</option>
                                                @endforeach
                                            @endif



                                        </select>
                                    </div>







                                    <div class="form-group col-md-3">
                                        <label for="cost_center">Cost Center</label>

                                            <select class="form-control select2" name="cost_center"
                                                id="cost_center" style="width:100%">
                                            <option value="">None</option>
                                            @foreach(\App\User::select('cost_center')->distinct()->pluck('cost_center') as $cc)
                                                <option value="{{$cc}}"
                                                @if(Request::get('cost_center'))
                                                        {{($cc == Request::get('cost_center') ? 'selected':'')}}
                                                @endif

                                                >{{$cc}}</option>
                                            @endforeach

{{--                                            <option value="Male"--}}
{{--                                            @if(Request::get('gender'))--}}
{{--                                                @php $gender = Request::get('gender'); @endphp--}}
{{--                                                @foreach($gender as $m)--}}
{{--                                                    {{($m=="Male"?'selected':'')}}--}}
{{--                                                    @endforeach--}}
{{--                                                @endif--}}
{{--                                            >Male--}}
{{--                                            </option>--}}
{{--                                            <option--}}
{{--                                                value="Female"--}}
{{--                                            @if(Request::get('gender'))--}}
{{--                                                @php $gender = Request::get('gender'); @endphp--}}
{{--                                                @foreach($gender as $m)--}}
{{--                                                    {{($m=="Female"?'selected':'')}}--}}
{{--                                                    @endforeach--}}
{{--                                                @endif--}}
{{--                                            >Female--}}
{{--                                            </option>--}}
                                        </select>
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="gender">Gender</label>

                                        <select class="form-control select2" name="gender[]" multiple="multiple"
                                                id="gender" style="width:100%">
                                            <option value="Male"
                                            @if(Request::get('gender'))
                                                @php $gender = Request::get('gender'); @endphp
                                                @foreach($gender as $m)
                                                    {{($m=="Male"?'selected':'')}}
                                                    @endforeach
                                                @endif
                                            >Male
                                            </option>
                                            <option
                                                value="Female"
                                            @if(Request::get('gender'))
                                                @php $gender = Request::get('gender'); @endphp
                                                @foreach($gender as $m)
                                                    {{($m=="Female"?'selected':'')}}
                                                    @endforeach
                                                @endif
                                            >Female
                                            </option>
                                        </select>
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="marital_status">Marital Status</label>
                                        <select class="form-control select2" name="marital_status[]" id="marital_status"
                                                style="width:100%" multiple>

                                            <option value="married"
                                            @if(Request::get('marital_status'))
                                                @php $marital_status = Request::get('marital_status'); @endphp
                                                @foreach($marital_status as $m)
                                                    {{($m=="married"?'selected':'')}}
                                                    @endforeach
                                                @endif
                                            > Married
                                            </option>
                                            <option
                                                value="un_married"
                                            @if(Request::get('marital_status'))
                                                @php $marital_status = Request::get('marital_status'); @endphp
                                                @foreach($marital_status as $m)
                                                    {{($m=="un_married"?'selected':'')}}
                                                    @endforeach
                                                @endif
                                            >
                                                Un-Married
                                            </option>
                                            <option
                                                value="divorced"
                                            @if(Request::get('marital_status'))
                                                @php $marital_status = Request::get('marital_status'); @endphp
                                                @foreach($marital_status as $m)
                                                    {{($m=="divorced"?'selected':'')}}
                                                    @endforeach
                                                @endif
                                            >
                                                Divorced
                                            </option>
                                            <option
                                                value="widow"
                                            @if(Request::get('marital_status'))
                                                @php $marital_status = Request::get('marital_status'); @endphp
                                                @foreach($marital_status as $m)
                                                    {{($m=="widow"?'selected':'')}}
                                                    @endforeach
                                                @endif
                                            >
                                                Widow
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="refugee_status">Refugee Status</label>
                                        <select class="form-control select2" name="refugee_status[]" id="refugee_status"
                                                style="width:100%" multiple>
                                            <option
                                                value="1947"
                                            @if(Request::get('refugee_status'))
                                                @php $refugee_status = Request::get('refugee_status'); @endphp
                                                @foreach($refugee_status as $m)
                                                    {{($m=="1947"?'selected':'')}}
                                                    @endforeach
                                                @endif
                                            >
                                                1947
                                            </option>
                                            <option
                                                value="1965"
                                            @if(Request::get('refugee_status'))
                                                @php $refugee_status = Request::get('refugee_status'); @endphp
                                                @foreach($refugee_status as $m)
                                                    {{($m=="1965"?'selected':'')}}
                                                    @endforeach
                                                @endif
                                            >
                                                1965
                                            </option>
                                            <option
                                                value="1989"
                                            @if(Request::get('refugee_status'))
                                                @php $refugee_status = Request::get('refugee_status'); @endphp
                                                @foreach($refugee_status as $m)
                                                    {{($m=="1989"?'selected':'')}}
                                                    @endforeach
                                                @endif

                                            >
                                                1989
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="emp_type">Employee Type</label>
                                        <select class="form-control select2" name="emp_type[]" id="emp_type"
                                                style="width:100%" multiple>
                                            @php $emp_type = array();
                                                if(Request::get('emp_type')){
                                                    $emp_type = Request::get('emp_type');
                                                }
                                                 @endphp
                                            <option value="permanent" {{(@in_array(  'permanent' , $emp_type)?'selected':'')}}>Permanent</option>
                                            <option value="adhoc" {{(@in_array(  'adhoc' , $emp_type)?'selected':'')}}>Adhoc</option>
                                            <option value="deputation" {{(@in_array(  'deputation' , $emp_type)?'selected':'')}}>Deputation</option>
                                            <option value="contract" {{(@in_array(  'contract' , $emp_type)?'selected':'')}}>Contract</option>
                                            <option value="internee" {{(@in_array(  'internee' , $emp_type)?'selected':'')}}>Internee</option>
                                            <option value="temporary" {{(@in_array(  'temporary' , $emp_type)?'selected':'')}}>Temporary</option>
                                            <option value="retired" {{(@in_array(  'permanent' , $emp_type)?'retired':'')}}>Retired</option>
                                            <option value="work_charge" {{(@in_array(  'work_charge' , $emp_type)?'selected':'')}}>Work Charge</option>
                                            <option value="contingent_paid" {{(@in_array(  'contingent_paid' , $emp_type)?'selected':'')}}>Contingent Paid</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="province_domicile">Province Domicile</label>
                                        <select class="form-control select2" name="province_domicile[]"
                                                id="province_domicile" style="width:100%" multiple>

                                            @foreach(\App\User::districts() as $region => $districts)
                                                <option
                                                    value="{{$region}}"
                                                @if(Request::get('province_domicile'))
                                                    @php $province_domicile = Request::get('province_domicile'); @endphp
                                                    @foreach($province_domicile as $m)
                                                        {{($m == $region?'selected':'')}}
                                                        @endforeach
                                                    @endif
                                                >{{$region}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="district_domicile">District Domicile</label>
                                        <select class="form-control select2" name="district_domicile[]" multiple
                                                id="district_domicile" style="width:100%">
                                            @foreach(\App\User::districts() as $region => $districts)
                                                <optgroup label="{{$region}}">
                                                    @foreach($districts as $district)
                                                        <option
                                                            value="{{$district}}"
                                                        @if(Request::get('district_domicile'))
                                                            @php $district_domicile = Request::get('district_domicile'); @endphp
                                                            @foreach($district_domicile as $m)
                                                                {{($m == $district?'selected':'')}}
                                                                @endforeach
                                                            @endif
                                                        >{{$district}}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if(Auth::user()->usertype == 'admin')
                                        <div class="form-group col-md-3">
                                            <label for="dep_id">Department</label>
                                            <select class="form-control select2" name="dep_id[]" id="dep_id" multiple
                                                    style="width:100%">
                                                @foreach ($dept as $department)
                                                    <option
                                                        value="{{$department->id}}"
                                                    @if(Request::get('dep_id'))
                                                        @php $dep_id = Request::get('dep_id'); @endphp
                                                        @foreach($dep_id as $m)
                                                            {{($m == $department->id?'selected':'')}}
                                                            @endforeach
                                                        @endif
                                                    >{{$department->dep_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="form-group col-md-3">
                                        <label for="verified">Verified</label>
                                        <select class="form-control select2" name="verified[]" id="verified" multiple
                                                style="width:100%">
                                            <option value="1"
                                            @if(Request::get('verified'))
                                                @php $verified = Request::get('verified'); @endphp
                                                @foreach($verified as $m)
                                                    {{($m == '1'?'selected':'')}}
                                                    @endforeach
                                                @endif
                                            >Yes
                                            </option>
                                            <option value="0"
                                            @if(Request::get('verified'))
                                                @php $verified = Request::get('verified'); @endphp
                                                @foreach($verified as $m)
                                                    {{($m == '0'?'selected':'')}}
                                                    @endforeach
                                                @endif
                                            >No
                                            </option>
                                        </select>
                                    </div>

{{--                                    <div class="form-group col-md-3">--}}
{{--                                        <p>--}}
{{--                                            <label for="amount">Age:</label>--}}
{{--                                            <input type="text" id="amount" readonly style="border:0; color:#f6931f;--}}
{{--                                            font-weight:bold;" name="age">--}}
{{--                                        </p>--}}
{{--                                        <div id="slider-range"></div>--}}

{{--                                    </div>--}}
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <style>
                            th {
                                font-weight: bold !important;
                            }

                            #adminCard p {
                                color: #141e30;
                            }

                            #adminCard h4 {
                            }
                        </style>

                        <div class="font-weight-bold text-danger">
                            Showing {{($users->currentpage()-1)*$users->perpage()+1}}
                            to {{$users->currentpage()*$users->perpage()}}
                            of {{$users->total()}} entries
                        </div>
                        <div class="table-responsive" id="adminCard">
                            <table class="table table-condensed table-bordered table-hover">
                                <thead>
                                <tr class="table table-condensed table-bordered">
                                    <th>Name</th>
                                    {{--                                    <th>CNIC</th>--}}
                                    <th>Department</th>
                                    <th>Designation</th>
                                    @if(auth()->user()->dep_id != 94)
                                    <th>District</th>
                                    @endif
                                    @if(auth()->user()->dep_id == 94)
                                    <th>DDO Code</th>
                                    <th>Cost Center</th>
                                    @endif
                                    <th style="text-align: center;">Actions</th>
                                </tr>
                                </thead>
                                <?php $count = 0?>
                                @foreach($users as $user)
                                    <?php $count++ ?>
                                    <tr>
                                        <td>{{$user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name}}</td>
                                        {{--                                        <td>{{$user->cnic}}</td>--}}
                                        <td>
{{--                                            @if(!empty($user->department->dep_name))--}}
{{--                                                {{$user->dep_id->dep_name}}--}}
{{--                                            @endif--}}
                                            @php
                                                $depIs = \App\Models\Department::find($user->dep_id);
                                            @endphp
                                           @if($depIs)  {{$depIs->dep_name}} @endif
                                        </td>
                                        <td>
                                            @if(is_numeric($user->designation))

                                                @if(!empty(\App\Models\Designation::find($user->designation)))
                                                    {{\App\Models\Designation::find($user->designation)->designation_name}}
                                                @endif

                                            @else
                                                {{$user->designation}}
                                            @endif
                                        </td>
                                         @if(auth()->user()->dep_id != 94)
                                        <td>{{$user->district_domicile }}</td>
                                         @endif
                                        @if(auth()->user()->dep_id == 94)
                                        <td>{{$user->ddo_code }}</td>
                                        <td>{{$user->cost_center }}</td>
                                        @endif
                                        <td style="text-align: center;">
                                            <a href="{{url('employee_profile/' . $user->id )}}"
                                               class="btn btn-outline-info btn-sm"
                                               style="text-decoration: none" title="View Employee Profile">
                                                <i class="fa fa-eye " style=""></i>
                                            </a>
                                            <a href="{{url('employees/'.  $user->id .'/edit')}}"
                                               class="btn btn-outline-primary btn-sm"
                                               title="Edit Employee"><i
                                                    class="fa fa-edit"></i></a>
                                            @if( $user->verified==1)
                                                <a href="javascript:;" class="btn btn-outline-success btn-sm"
                                                   title="Verified"><i
                                                        class="fa fa-user-check"></i></a>
                                            @else
                                                <a href="{{url('employees/'.  $user->id .'/verify')}}"
                                                   class="btn btn-outline-warning btn-sm"
                                                   title="Not Verified: Click to verify."><i
                                                        class="fa fa-user-check"></i></a>
                                            @endif

                                            {{--<form method="post" action="{{ url('employees') }}" style="display: inline-block;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </form>--}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                            </table>

                            <div class="float-right">{{ $users->withQueryString()->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

    <script src="{{asset('js/external/jquery/jquery.js')}}"></script>
    <script src="{{asset('js/external/jquery/jquery-ui.js')}}"></script>
    <script>
        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 18,
                max: 60,
                values: [18, 60],
                slide: function (event, ui) {
                    $("#amount").val("" + ui.values[0] + "-" + ui.values[1]);
                }
            });
            $("#amount").val("" + $("#slider-range").slider("values", 0) +
                " - " + $("#slider-range").slider("values", 1));
        });
    </script>
    <script type="text/javascript">
        $('#advance').click(function () {
            $('#filters').slideToggle(1000);
        });
    </script>
@endsection
