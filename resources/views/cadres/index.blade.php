@extends('layouts.master')

@section('title')
    Cadres
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
                                <h3>Cadres Information</h3>
                            </div>
                        </div>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <a href="{{ route('cadres.create') }}" class="btn btn-info">
                            <i class="fa fa-plus"></i>
                            Add Cadres
                        </a>
                        @if ($cadres->isNotEmpty())
                            <table id="example" class="display">

                                <thead>
                                    <tr role="row">
                                        <th width="30">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Department Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Included Designation</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($cadres as $cadre)
                                        <tr role="row">
                                            <td> {{ $loop->iteration }}</td>
                                            <td> {{ $cadre->department->dep_name }}</td>
                                            <td> {{ $cadre->name }}</td>
                                            <td>
                                                @php $desig = explode(', ', $cadre->included_designation); @endphp
                                                @foreach($desig as $key)
                                                    @if(!empty(\App\Models\Designation::find($key)))
                                                        {{\App\Models\Designation::find($key)->designation_name}},
                                                    @endif

                                                @endforeach
{{--                                                {{ $cadre->included_designation}}--}}
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="{{ route('cadres.edit', $cadre->id) }}" class="btn btn-outline-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <form method="post" action="{{ route('cadres.destroy', $cadre->id) }}" style="display: inline-block;">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                {{-- <tfoot> --}}
                                {{-- <tr> --}}
                                {{-- <th colspan="3" class="text-center">Total</th> --}}
                                {{-- <th>{{ $cadres->count() }}</th> --}}
                                {{-- <th></th> --}}
                                {{-- </tr> --}}
                                {{-- </tfoot> --}}
                            </table>
                        @endif
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
