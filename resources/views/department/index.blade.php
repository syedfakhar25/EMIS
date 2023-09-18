@extends('layouts.master')

@section('title')
    Departments
@endsection


@section('customScripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header">
                                <h3>Departments</h3>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-top: 15px; padding-left: 300px">
                            Total: {{ $total }}
                            <button type="button" id="advance" style="" class="btn btn-info">
                                <i class="fa fa-plus"></i>
                                Add Department / Hide
                            </button>
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

                            #adminCard h4 {}

                        </style>
                        <div class="card" id="filters" style="display: none;">
                            <div class="col-md-12">
                                {{-- {{$all_dep}} --}}
                                <form action="{{ url('departments') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1" class="">Department Name</label>
                                            <input type="text" name="dep_name" class="form-control" value="" class="col-md-3">
                                            {{-- <button type="submit" class="btn btn-primary"> Add </button> --}}
                                        </div>

                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1" class="">Short Name</label>
                                            <input type="text" name="short_name" class="form-control" value="" placeholder="Type description here" class="col-md-3">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1" class="">Website URL</label>
                                            <input type="text" name="website_url" class="form-control" value="" class="col-md-3">
                                            {{-- <button type="submit" class="btn btn-primary"> Add </button> --}}
                                        </div>

                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1" class="">Logo</label><br>
                                            <input type="file" name="filelogo">
                                        </div>


                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1" class="">Description</label>
                                            <textarea name="description" class="form-control tinymce" placeholder="e.g; CD for Civil Defence" class="col-md-3"></textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <br>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-danger" value="Add">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>




                        <table id="example" class="display">

                            <thead>
                                <tr role="row">
                                    <th width="30" colspan="2">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Department Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Focal Person
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Employees
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $count = 0; ?>
                                @foreach ($departments as $dep)
                                    <?php $count++; ?>
                                    <tr role="row">
                                        <td> {{ $loop->iteration }}</td>
                                        <td>
                                            @if (empty($dep->logo))
                                                <img src="{{ url('assets/img/logo.png') }}" width="50" height="auto" class="float-left mr-4">
                                            @else
                                                <img src="{{ url('uploads/department/' . $dep->logo) }}" class="float-left mr-4" width="50" height="auto">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('departments/' . $dep->id) }}" style="text-decoration: none">{{ strtoupper($dep->dep_name) }}</a>
                                        </td>
                                        <td>

{{--                                            {{ $fp_list->where('dep_id',$dep->id)->first()  }}--}}

                        @if(!empty($fp_list->where('dep_id',$dep->id)->first()))
                             <a href="{{ url('employee_profile/' . $fp_list->where('dep_id',$dep->id)->first()->id) }}">{{ ucwords($fp_list->where('dep_id',$dep->id)->first()->first_name . ' ' . $fp_list->where('dep_id',$dep->id)->first()->last_name) }}</a>
                                                <br>
                                <small>
                                    <strong>
                                        Phone: <a href="tel:{{ $fp_list->where('dep_id',$dep->id)->first()->personal_no }}">{{ $fp_list->where('dep_id',$dep->id)->first()->mobile_phone }}</a><br>
                                        Email: <a href="mailto:{{ $fp_list->where('dep_id',$dep->id)->first()->email }}">{{ $fp_list->where('dep_id',$dep->id)->first()->email }}</a>
                                </strong>
                                </small>
                        @endif
{{--                                            @if (isset($focal_person[$dep->id]))--}}
{{--                                                <a href="{{ url('employee_profile/' . $focal_person[$dep->id]->id) }}">{{ ucwords($focal_person[$dep->id]->first_name . ' ' . $focal_person[$dep->id]->last_name) }}</a><br>--}}
{{--                                                <small><strong>--}}
{{--                                                        @if (isset($focal_person[$dep->id]->mobile_phone))--}}
{{--                                                            Phone: <a href="tel:{{ $focal_person[$dep->id]->personal_no }}">{{ $focal_person[$dep->id]->mobile_phone }}</a><br>--}}
{{--                                                        @endif--}}
{{--                                                        @if (isset($focal_person[$dep->id]->email))--}}
{{--                                                            Email: <a href="mailto:{{ $focal_person[$dep->id]->email }}">{{ $focal_person[$dep->id]->email }}</a>--}}
{{--                                                        @endif--}}
{{--                        </strong>--}}
{{--                                                </small>--}}
{{--                                            @endif--}}
                                        </td>

                                        <td style="text-align: center;">
                                            <a href="{{ url('employees?dep_id[]=') . $dep->id }}">{{ $dep->totalEmployees }}</a>
                                        </td>
                                        <td style="text-align: center;">

                                            <a href="{{ url('departments/' . $dep->id . '/edit') }}" class="btn btn-outline-success btn-sm"><i class="fa fa-edit"></i></a>
                                            <form method="post" action="{{ url('departments/' . $dep->id) }}" style="display: inline-block;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <th colspan="3" class="text-center">Total</th>
                                    <th>{{ $dep->totalEmployees }}</th>
                                </tr>
                            </tfoot> --}}
                        </table>
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#example').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],

                iDisplayLength: -1,
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'copy',
                        text: window.copyButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        text: window.csvButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        text: window.excelButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: window.pdfButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: window.printButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },


                ]
            });

        });

    </script>

@endsection
