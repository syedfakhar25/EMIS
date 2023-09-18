@extends('layouts.master')

@section('title')
    District Wise Designation Report
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
                                <h5>District Wise Designation Report</h5>
                                {{-- district wise designation report --}}
                            </div>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-info" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <table id="example" class="display">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Designation</th>
                                <th>Bagh</th>
                                <th>Bhimber</th>
                                <th>Haveli</th>
                                <th>Jhelum Valley</th>
                                <th>Kotli</th>
                                <th>Mirpur</th>
                                <th>Muzaffarabad</th>
                                <th>Neelum</th>
                                <th>Poonch</th>
                                <th>Sudhnati</th>
                                <th>Others</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $notSet = 0;
                                $count = 1;
                            @endphp
                            @if (Request::get('dep_id'))
                                @php $dep_id = Request::get('dep_id'); @endphp
                            @endif
                            {{--                            @foreach ($collection as $row)--}}

                            {{--                                <tr>--}}
                            {{--                                    <td>{{ $count }}</td>--}}
                            {{--                                    @php $count++; @endphp--}}
                            {{--                                    <td> {{ $row->designation_name }} </td>--}}
                            {{--                                    <td> {{ $row->district_domicile }} </td>--}}
                            {{--                                    <td>--}}

                            {{--                                        @if (auth()->user()->usertype == 'admin')--}}
                            {{--                                            <a href="{{ route('employees', 'district_domicile[]=' . urlencode($row->district_domicile) . (Request::get('dep_id') ? '&dep_id[]=' . $dep_id[0] : '') . (Request::get('designation') == 'NotSet' ? '&designation[]=NotSet' : '&designation[]=' . Request::get('designation'))) }}">--}}
                            {{--                                                {{ $row->total }}</a>--}}
                            {{--                                        @elseif(auth()->user()->usertype == 'department_admin')--}}
                            {{--                                            <a href="{{ route('employees', 'district_domicile[]=' . urlencode($row->district_domicile) . (Request::get('dep_id') ? '&dep_id[]=' . $dep_id[0] : '') . (Request::get('designation') == 'NotSet' ? '&designation[]=NotSet' : '&designation[]=' . Request::get('designation'))) }}">--}}
                            {{--                                                {{ $row->total }}</a>--}}
                            {{--                                        @endif--}}
                            {{--                                    </td>--}}
                            {{--                                </tr>--}}
                            {{--                            @endforeach--}}


                            @foreach ($data as $key => $value)

                                <tr>
                                    <td>{{ $count }}</td>
                                    @php $count++; @endphp
                                    <td>  <strong>{{ $key }}</strong> </td>
                                    @php $row_total = 0; @endphp
                                    @foreach($districts as $district)
                                        <td>
                                            @if(isset($value[$district]))
                                                {{$value[$district]}}

                                                @php $row_total += $value[$district]; @endphp
                                            @else
                                                0
                                            @endif
                                        </td>
                                    @endforeach

                                    <td>
                                        <strong>{{$row_total}}</strong>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                            <tfoot>
{{--                            <tr>--}}
{{--                                <th colspan="3" class="text-center">Total</th>--}}
{{--                                <th>{{ $collection->sum('total') }}</th>--}}
{{--                            </tr>--}}
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@section('scripts')


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#example').DataTable({
                "scrollY": 500,
                "scrollX": true,
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
