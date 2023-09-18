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
                        <form method="POST" action="{{ route('cadres.update', $cadre->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="dep_id">{{ __('Department') }} <span class="text-danger">*</span></label>
                                    <select name="dep_id" class="form-control select2 @error('dep_id') is-invalid @enderror" id="dep_id" required>
                                        <option class="form-control " value=""> Choose Department</option>
                                        @foreach (\App\Models\Department::all() as $dep)
                                            @if (auth()->user()->usertype == 'department_admin' && $dep->id == auth()->user()->dep_id)
                                                <option value="{{ $dep->id }}" {{ $cadre->dep_id == $dep->id ? 'selected' : '' }}>{{ $dep->dep_name }}</option>
                                            @elseif((auth()->user()->usertype == 'admin'))
                                                <option value="{{ $dep->id }}" {{ $cadre->dep_id == $dep->id ? 'selected' : '' }}>{{ $dep->dep_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('dep_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Department is required</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="first_name">{{ __('Name') }}<span class="text-danger">*</span></label>
                                    <input id="first_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $cadre->name }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="included_designation">{{ __('Included Designation') }}<span class="text-danger">*</span></label>
                                    <select name="included_designation[]" multiple required class="form-control select2 @error('included_designation[]') is-invalid @enderror" id="included_designation">
                                        <option class="form-control " value=""> Choose Department</option>

{{--                                        @foreach ($designations as $des)--}}
{{--                                            <option value="{{ $des->designation }}" @foreach ($inc_desig as $x)  @if ($x==$des->designation) selected @endif--}}
{{--                                        @endforeach--}}
{{--                                        >{{ $des->designation }}</option>--}}

                                            @foreach($designations as $des)
                                                <option value="{{ $des->id }}" @foreach ($inc_desig as $x)  @if ($x==$des->id) selected @endif  @endforeach>{{ $des->designation_name }}</option>
                                            @endforeach

                                        {{-- {{(old('dep_id')==$dep->id)?'selected="selected"':''}} --}}
{{--                                        @endforeach--}}
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
                                    {{ __('Update') }}
                                </button>

                                <a href="{{ route('cadres.index') }}" class="btn btn-warning">
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


    <script src="{{ asset('js/external/jquery/jquery.js') }}"></script>
    <script src="{{ asset('js/external/jquery/jquery-ui.js') }}"></script>

    <script type="text/javascript">
        $('#advance').click(function() {
            $('#filters').slideToggle(1000);
        });

    </script>
@endsection
