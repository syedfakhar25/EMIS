@extends('layouts.master')

@section('title')
    Cadres
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header">
                                <h3>Cadres</h3>
                            </div>
                        </div>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('cadres.store') }}">
                            @csrf

                            <div class="form-group row">






                                    @if(auth()->user()->usertype == "department_admin")
                                        <input type="hidden" name="dep_id" value="{{auth()->user()->dep_id}}">
                                    @elseif(auth()->user()->usertype == "admin")

                                    <div class="col-md-4">
                                        <label for="dep_id">{{ __('Department') }}<span class="text-danger">*</span></label>
                                        <select name="dep_id"
                                                class="form-control select2 @error('dep_id') is-invalid @enderror"
                                                id="dep_id" required>
                                            <option class="form-control " value=""> Choose Department</option>

                                            @foreach($deps as $dep)

                                                <option value="{{ $dep->id }}">{{ $dep->dep_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('dep_id')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>department is required</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    @endif



                                <div class="col-md-4">
                                    <label for="first_name">{{ __('Name') }}<span class="text-danger">*</span></label>
                                    <input id="first_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required
                                           autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="included_designation">{{ __('Included Designation') }}<span class="text-danger">*</span></label>
                                    <select name="included_designation[]" multiple required
                                            class="form-control select2 @error('included_designation[]') is-invalid @enderror"
                                            id="included_designation">
                                        <option class="form-control " value=""> Choose Department</option>

                                        @php $count = 0; @endphp
                                        @foreach($designations as $des)
                                            <option value="{{ $des->id }}">{{ $des->designation_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('included_designation')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>Included designation is required</strong>
                                            </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>

                                <a href="{{route('cadres.index')}}" class="btn btn-warning">
                                    Back
                                </a>
                            </div>

                        </form>
                    </div>
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

    <script type="text/javascript">
        $('#advance').click(function () {
            $('#filters').slideToggle(1000);
        });
    </script>
@endsection
