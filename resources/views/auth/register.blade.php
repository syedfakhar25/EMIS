@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 pt-5 pb-5">
                <div class="card" style="background-color: #141e30; color: white; opacity: 85%">
                    <div class="card-header" style="background-color: black">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
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
                                                    <option
                                                        value="{{$region}}:{{$district}}">{{strtoupper($district)}}</option>
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
                                    <label for="mobile_phone">{{ __('Mobile #') }}</label>
                                    <input id="mobile_phone" type="tel" placeholder="03008169924"
                                           class="form-control @error('mobile_phone') is-invalid @enderror"
                                           name="mobile_phone" value="{{ old('mobile_phone') }}"
                                           autocomplete="mobile_phone" required minlength="11" maxlength="11">
                                    @error('mobile_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="dep_id">{{ __('Department') }}<span class="text-danger">*</span></label>
                                    <select name="dep_id"
                                            class="form-control select2 @error('dep_id') is-invalid @enderror"
                                            id="dep_id">
                                        <option class="form-control " value=""> Choose Department</option>

                                        @foreach(\App\Models\Department::where('parent_id',0)->get() as $dep)
                                            <option
                                                value="{{ $dep->id }}" {{(old('dep_id')==$dep->id)?'selected="selected"':''}} >
                                                {{ strtoupper($dep->dep_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('dep_id')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>department is required</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="designation">{{ __('Designation') }}<span
                                            class="text-danger">*</span></label>

                                    <select id="designation" class="form-control" name="designation" >
                                        <option class="form-control " value=""> Choose department first</option>
                                    </select>

                                    @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 ">
                                    <label> Employee Type</label><span class="text-danger">*</span></label>
                                    <select name="emp_type" required class="form-control select2 ">
                                        <option value="" class="form-control">Choose employee type</option>
                                        <option value="permanent" class="form-control" >
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
@endsection
@section('customJsCode')

    <script src="{{ asset('js/external/jquery/jquery.js') }}"></script>
    <script src="{{ asset('js/external/jquery/jquery-ui.js') }}"></script>
    <script>
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
