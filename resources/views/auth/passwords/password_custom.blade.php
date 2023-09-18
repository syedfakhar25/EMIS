@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="padding-top: 5%;">
                <div class="card" style="background-color: #141e30; color: white; opacity: 85%">
                    <div class="card-header" style="background-color: black">{{ __('Reset Password') }}</div>
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('update-password') }}">
                            @method('PUT')
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label ">{{ __('Enter Cnic') }}</label>
                                <div class="col-md-6">
                                    <input id="cnic" type="text" placeholder="CNIC: 82203-1234567-3"
                                           class="form-control cnic_mask @error('cnic') is-invalid @enderror"
                                           name="cnic" value="{{ old('cnic') }}"
                                           required minlength="15" maxlength="15"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label ">{{ __('Enter New Password') }}</label>
                                <div class="col-md-6">
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
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
