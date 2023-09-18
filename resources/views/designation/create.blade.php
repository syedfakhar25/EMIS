@extends('layouts.master')

@section('title')
    Create Designation
@endsection

@section('customScripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="{{ url('select2tree/select2totree.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ url('select2tree/select2totree.js')}}"></script>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header">
                                <h6>Create Designation</h6>
                            </div>
                        </div>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="card-body">


                        <form method="POST" action="{{ route('designation.store') }}">
                            @csrf
                            <div class="form-group row">

                                @if(auth()->user()->usertype == "department_admin")
                                    <input type="hidden" name="dep_id" value="{{auth()->user()->dep_id}}">
                                @elseif(auth()->user()->usertype == "admin")
                                    <div class="col-md-4">
                                        <label for="dep_id">{{ __('Department') }}<span
                                                class="text-danger">*</span></label>
                                        <select id="sel_2" style="width:24em" single name="dep_id" required>
                                            <option value="">None</option>
                                        </select>
                                        @error('dep_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Department is required</strong>
                                        </span>
                                        @enderror
                                    </div>
                                @endif

                                    <div class="col-md-4">
                                        <label for="designation_id">{{ __('Parent Designation') }}
                                            <span class="text-danger">*</span></label><br>
                                        <select id="designation_id" style="width:24em" single name="designation_id">
                                            <option value="0">None</option>
                                        </select>
                                        <script>
                                            var mydata = [
                                                @include('designation.designationTree', ['parent_designations' => $parent_designations])
                                            ];
                                            var mydata2 = [
                                                @include('designation.departmentTree', ['parent_departments' => $parent_departments])
                                            ];
                                            $("#designation_id").select2ToTree({
                                                treeData: {dataArr: mydata},
                                                maximumSelectionLength: 3
                                            });
                                            $("#sel_2").select2ToTree({
                                                treeData: {dataArr: mydata2},
                                                maximumSelectionLength: 3
                                            });
                                        </script>
                                        @error('dep_id')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>Department is required</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">{{ __('Designation') }}<span
                                                class="text-danger">*</span></label>
                                        <input id="designation_name" type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="designation_name" required autocomplete="designation_name   "
                                               autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>

                                    <a href="{{ route('designation.index') }}" class="btn btn-warning">
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
        $('#advance').click(function () {
            $('#filters').slideToggle(1000);
        });

    </script>
@endsection
