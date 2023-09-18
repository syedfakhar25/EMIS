@extends('layouts.master')

@section('title')
    Create Sub Departments
@endsection

@section('customScripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
<link href="{{ asset('select2tree/select2totree.css') }}" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{ asset('select2tree/select2totree.js')}}"></script>
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
                                <h6>Sub Departments</h6>
                            </div>
                        </div>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="card-body">

                        <a href="{{ route('sub-departments.create') }}" class="btn btn-info">
                            <i class="fa fa-plus"></i>
                            Create Sub Department/Sections
                        </a>


                        <table id="example" class="display">
                            <thead>
                                <tr role="row">
                                    <th width="30" class="text-center">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">
                                        Department Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">
                                        Sub Department Name
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collection as $item)
                                <tr role="row">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        @if($item->parent_id == 0)
                                                {{ $item->dep_name }}
                                        @else
                                            {{\App\Models\Department::find($item->parent_id)->dep_name }} => {{$item->dep_name}}
                                        @endif
                                    </td>
                                    <td><a href="{{ route('sub-departments.edit',$item->id) }}" >{{ $item->name }}</a></td>
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
