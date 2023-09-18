@extends('layouts.master')

@section('title')
    Create Sub Departments
@endsection

@section('customScripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="{{ asset('select2tree/select2totree.css') }}" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ asset('select2tree/select2totree.js') }}"></script>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header">
                                <h6>Create Sub Departments</h6>
                            </div>
                        </div>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="card-body">

                        <form method="POST" action="{{ route('sub-departments.update', $subDepartment->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                @if (auth()->user()->usertype == 'admin')
                                    <div class="col-md-4">
                                        <label for="dep_id">{{ __('Department') }} <span class="text-danger">*</span></label><br>
                                        <select id="dep_id" style="width:24em" single name="dep_id">
                                        </select>
                                        <script>
                                            var mydata = [
                                                @include('sub-departments.sub-departments', ['parent_designations' => $parent_designations])
                                            ];
                                            $("#dep_id").select2ToTree({
                                                treeData: {
                                                    dataArr: mydata
                                                },
                                                maximumSelectionLength: 3
                                            });

                                        </script>
                                    </div>
                                @elseif(auth()->user()->usertype == 'department_admin')
                                    <input type="hidden" name="dep_id" value="{{ $subDepartment->dep_id }}">
                                @endif

                                @error('dep_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Department is required</strong>
                                    </span>
                                @enderror


                                <div class="col-md-4">
                                    <label for="name">{{ __('Sub Department Name') }}<span class="text-danger">*</span></label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $subDepartment->name }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>

                                <a href="{{ route('sub-departments.index') }}" class="btn btn-warning">
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
