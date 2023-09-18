@extends('layouts.master')

@section('title')
    Department Focal Person Report
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header">
                                <h3>Department Focal Person Report</h3>
                            </div>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-info" role="alert">
                            {{ session('success') }}
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

                            #adminCard h4 {
                            }
                        </style>
                        <div class="card" id="filters" style="display: none;">
                            <div class="col-md-12">
                                {{--{{$all_dep}}--}}

                            </div>
                        </div>


                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable" class="table table-striped table-bordered dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable_info"
                                           style="width: 100%;">
                                        <thead>

                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 85px;" aria-sort="ascending"
                                                aria-label="Sr. No: activate to sort column descending">Sr. No
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 263px;"
                                                aria-label="Department: activate to sort column ascending">Department
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 263px;"
                                                aria-label="Focal Person: activate to sort column ascending">Focal Person
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 264px;"
                                                aria-label="Contact No: activate to sort column ascending">Contact No
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 264px;"
                                                aria-label="Email: activate to sort column ascending">Email
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($focalPerson as $fp)
                                        <tr role="row">
                                            <td>{{$loop->iteration}}</td>
                                            <td><a href="{{url('employees?dep_id[]='.$fp->dep_id)}}">{{ucwords($fp->dep_name)}}</a></td>
                                            <td><a href="{{url('employee_profile/'.$fp->user_id)}}">{{ucwords($fp->first_name . ' ' . $fp->last_name)}}</a></td>
                                            <td>{{$fp->personal_no}}</td>
                                            <td>{{$fp->email}}</td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
        $('#advance').click(function () {
            $('#filters').slideToggle(1000);
        });
    </script>
@endsection
