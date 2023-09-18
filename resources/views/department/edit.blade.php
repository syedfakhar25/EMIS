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
                        <div class="col-md-12">
                            <div class="card-header">
                                <h3>Departments</h3>
                            </div>
                        </div>

                    </div>
                    @if (\Session::has('success'))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <div class="alert alert-success">
                                        {!! \Session::get('success') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="card-body">
                        <style>
                            th {
                                font-weight: bold !important;
                            }

                            #adminCard p {
                                color: #141e30;
                            }

                            #adminCard h4 {}

                        </style>
                        <div id="adminCard">
                            <div class="col-md-12">
                                {{-- {{$all_dep}} --}}
                                <form action="{{ url('departments/' . $department->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6    ">
                                            <label for="exampleInputEmail1" class="">Department Name</label>
                                            <input type="text" name="dep_name" class="form-control" value="{{ $department->dep_name }}" class="col-md-6">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1" class="">Short Name</label>
                                            <input type="text" name="short_name" class="form-control" value="{{ $department->short_name }}" placeholder="e.g; CD for Civil Defence" class="col-md-6">
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1" class="">Website URL</label>
                                            <input type="text" name="website_url" class="form-control" value="{{ $department->website_url }}" class="col-md-3">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1" class="">Description</label>
                                            <textarea name="description" class="form-control tinymce" placeholder="e.g; CD for Civil Defence" class="col-md-3">{{ $department->description }}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ url('uploads/department/' . $department->logo) }}" target="_blank"><img src="{{ url('uploads/department/' . $department->logo) }}"></a>

                                        </div>
                                        <div class="col-md-4">
                                            <label>Logo</label>
                                            <input type="file" name="filelogo">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-danger float-right" value="Update">
                                        </div>
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
    <script type="text/javascript">
        $('#advance').click(function() {
            $('#filters').slideToggle(1000);
        });

    </script>
@endsection
