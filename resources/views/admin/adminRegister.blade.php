@extends('layouts.master')

@section('title')
    Departments
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header">
                                <h3>Register Employees</h3>
                            </div>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-info" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('registerAdmin') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="first_name">{{ __('First Name') }}<span
                                            class="text-danger">*</span></label>
                                    <input id="first_name" type="text" placeholder="First Name"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           name="first_name" value="{{ old('first_name') }}" required
                                           autocomplete="name" autofocus>

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="middle_name">{{ __('Middle Name') }}</label>
                                    <input id="middle_name" type="text" placeholder="Middle Name"
                                           class="form-control @error('middle_name') is-invalid @enderror"
                                           name="middle_name" value="{{ old('middle_name') }}"
                                           autocomplete="phone" autofocus>

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="last_name">{{ __('Last Name') }}<span
                                            class="text-danger">*</span></label>
                                    <input id="last_name" type="text" placeholder="Last Name"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name" value="{{ old('last_name') }}" required autocomplete="phone"
                                           autofocus>

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="cnic">{{ __('CNIC') }}<span class="text-danger">*</span></label>
                                    <input id="cnic" type="text" placeholder="CNIC: 82203-9444865-3"
                                           class="form-control cnic_mask @error('cnic') is-invalid @enderror"
                                           name="cnic" value="{{ old('cnic') }}" required minlength="15" maxlength="15">
                                    @error('cnic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="district_domicile">{{ __('District') }}<span
                                            class="text-danger">*</span></label>
                                    <select name="district_domicile" id="district_domicile"
                                            class="form-control select2  @error('district_domicile') is-invalid @enderror"
                                            required>
                                        <option value=""> Choose District</option>
                                        @foreach(\App\User::districts() as $region => $districts)
                                            <optgroup label="{{$region}}">
                                                @foreach($districts as $district)
                                                    <option value="{{$region}}:{{$district}}">{{$district}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @error('district_domicile')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>District is required</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="dep_id">{{ __('Department') }}<span class="text-danger">*</span></label>
                                    <select name="dep_id"
                                            class="form-control select2 @error('dep_id') is-invalid @enderror"
                                            id="dep_id" required>
                                        <option class="form-control " value=""> Choose Department</option>

                                        @foreach(\App\Models\Department::where('parent_id',0)->get() as $dep)

                                            @if(Auth::user()->usertype == 'admin')
                                                <option
                                                    value="{{ $dep->id }}" {{(old('dep_id')==$dep->id)?'selected="selected"':''}} >
                                                    {{ strtoupper($dep->dep_name) }}
                                                </option>
                                            @elseif(Auth::user()->usertype == 'department_admin' && auth()->user()->dep_id == $dep->id)
                                                <option
                                                    value="{{ $dep->id }}" {{(old('dep_id')==$dep->id)?'selected="selected"':''}} >
                                                    {{ strtoupper($dep->dep_name) }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('dep_id')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>department is required</strong>
                                            </span>
                                    @enderror
                                </div>


                            </div>



                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="designation">{{ __('Designation') }}<span
                                            class="text-danger">*</span></label>

                                    <select id="designation" class="form-control" name="designation">
                                        <option class="form-control " value=""> Choose department first</option>
                                    </select>

                                    @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label> Employee Type</label><span class="text-danger">*</span>
                                    <select name="emp_type" required class="form-control select2">
                                        <option value="" class="form-control">Choose employee type</option>
                                        <option value="permanent" class="form-control">
                                            Permanent
                                        </option>
                                        <option value="adhoc" class="form-control" >
                                            Adhoc
                                        </option>
                                        <option value="deputation"  class="form-control" >
                                            Deputation
                                        </option>
                                        <option value="contract"  class="form-control" >
                                            Contract
                                        </option>
                                        <option value="internee" class="form-control" >
                                            Internee
                                        </option>
                                        <option value="temporary" class="form-control" >
                                            Temporary
                                        </option>
                                        <option value="temporary" class="form-control" >
                                            Work Charge
                                        </option>
                                        <option value="temporary" class="form-control">
                                            Contingent Paid
                                        </option>
                                    </select>




                                </div>


                                <div class="col-md-4">
                                    <label for="mobile_phone">{{ __('Mobile #') }}<span class="text-danger">*</span></label>
                                    <input id="mobile_phone" type="tel" placeholder="03008169924"
                                           class="form-control @error('mobile_phone') is-invalid @enderror"
                                           name="mobile_phone" value="{{ old('mobile_phone') }}"
                                           autocomplete="mobile_phone" required minlength="11" maxlength="11" >
                                    @error('mobile_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="email">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" placeholder="Email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="password">{{ __('Password') }}<span class="text-danger">*</span></label>
                                    <input id="password" type="password" placeholder="Password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required
                                           autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="password-confirm">{{ __('Re-enter Password') }}<span
                                            class="text-danger">*</span></label>
                                    <input id="password-confirm" type="password" placeholder="Confirm Password"
                                           class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="col-md-4">
                                    @if(Auth::user()->usertype == 'admin')
                                        <label for="usertype">{{ __('Usertype') }}<span
                                                class="text-danger">*</span></label>
                                        <select name="usertype"
                                                class="form-control select2 @error('usertype') is-invalid @enderror"
                                                id="usertype">
                                            <option class="form-control " value=""> Choose Usertype</option>
                                            <option class="form-control " value="admin">Admin</option>
                                            <option class="form-control " value="department_admin">Department Admin
                                            </option>
                                            <option class="form-control " value="user">User</option>
                                        </select>
                                    @elseif(Auth::user()->usertype == 'department_admin')
                                        <input type="hidden" value="user" name="usertype">
                                    @endif
                                    @error('dep_id')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>department is required</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
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


@section('scripts')


    <script src="{{asset('js/external/jquery/jquery.js')}}"></script>
    <script src="{{asset('js/external/jquery/jquery-ui.js')}}"></script>
    <script>
        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 18,
                max: 60,
                @if(Request::get('age'))
                    @php $arr = explode('-',Request::get('age')); @endphp
                values: [{{$arr[0]}}, {{$arr[1]}}],
                @else
                values: [18, 60],
                @endif

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

        $(document).ready(function () {
            $('#dep_id').on('change', function () {

                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('getDesignationByDepartment') }}",
                    data: {'dep_id': $value},
                    success: function (response) {

                        $("#designation").html(response)
                    }
                });
            });
        });

    </script>
@endsection
