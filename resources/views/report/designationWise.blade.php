@extends('layouts.master')

@section('title')
    Designation Wise Report
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
                                <h3>Designation Wise Report
                                    @if (auth()->user()->usertype == 'admin')
{{--                                        - {{ auth()->user()->department->dep_name }}--}}
                                    @else
                                        @if (Request::get('dep_id'))
                                            @php $did = Request::get('dep_id'); @endphp
                                            - {{ \App\Models\Department::find($did)->first()->dep_name }}
                                        @endif
                                    @endif
                                </h3>
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
                        @if (auth()->user()->usertype == 'admin')
                            <form action="{{ route('report.designationWise') }}" method="get">
                                @if (Request::get('dep_id'))
                                    @php $dep_id = Request::get('dep_id'); @endphp
                                @endif
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="dep_id">Department</label>
                                        <select class="form-control select2" name="dep_id[]" id="dep_id" style="width:100%" required>
                                            <option value="">None</option>
                                            @foreach (\App\Models\Department::all() as $department)
                                                <option value="{{ $department->id }}" @if (Request::get('dep_id')) @php $dep_id = Request::get('dep_id'); @endphp
                                                                             @if ($department->id==$dep_id[0])
                                                    selected @endif
                                            @endif
                                            >{{ strtoupper($department->dep_name) }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-9">
                        <br>
                        <button type="submit" class="btn btn-primary float-right">Search</button>
                    </div>
                </div>
                </form>
                @endif


                <table id="example" class="display">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Designation</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $notSet = 0;
                            $count  = 1;
                            // $url = '&dep_id[]=' . $dep_id;
                        @endphp
                        @foreach ($collection as $row)
                            @php
                                /*if ($row->designation == '' || $row->designation == null || $row->designation == null) {
                                    $notSet += $row->total;
                                    continue;
                                }*/

                            @endphp
                            <tr>
                                <td>{{$count++}}</td>
                                <td>
                                    @if($row->designation_name == NULL)
                                        NotSet
                                    @else
                                        {{$row->designation_name}}
                                    @endif
                                </td>
                                <td>{{$row->total_users}} </td>
                                {{--<td>
                                    @if (auth()->user()->usertype == 'admin')
                                        <a href="{{ route('report.districtWise', 'designation=' . $row->designation . (Request::get('dep_id') ? '&dep_id[]=' . $dep_id[0] : '')) }}"> {{ $row->total }}</a>
                                    @elseif(auth()->user()->usertype == 'department_admin')
                                        <a href="{{ route('report.districtWise', 'designation=' . $row->designation  . '&dep_id=' . auth()->user()->dep_id) }}"> {{ $row->total }}</a>
                                    @endif
                                </td>--}}
                            </tr>
                        @endforeach

                       {{-- @if ($notSet > 0)
                            <tr class="text-danger">
                                <td>{{ ++$count }}</td>
                                <td>
                                    Not Set
                                </td>
                                <td>
                                    @if (auth()->user()->usertype == 'admin')
                                        <a href="{{ route('report.districtWise', 'designation=NotSet' . (Request::get('dep_id') ? '&dep_id[]=' . $dep_id[0] : '')) }}"> {{ $notSet }}</a>
                                    @elseif(auth()->user()->usertype == 'department_admin')
                                    <a href="{{ route('report.districtWise', 'designation=' . 'NotSet'  . '&dep_id=' . auth()->user()->dep_id) }}">{{ $notSet }}</a>
                                    @endif

                                </td>
                            </tr>
                        @endif--}}
                    </tbody>

                   {{-- <tfoot>
                        <tr>
                            <th colspan="2" class="text-center">Total</th>
                            <th><a href="{{ route('employees') . (Request::get('dep_id') ? '?dep_id[]=' . $dep_id[0] : '') }}">{{ $collection->sum('total') }}</a></th>
                        </tr>
                    </tfoot>--}}
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
        $(document).ready(function() {

            $('#example').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                dom: 'lBfrtip',
                iDisplayLength: -1,
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

    {{-- <script src="{{asset('js/external/jquery/jquery.js')}}"></script>
    <script src="{{asset('js/external/jquery/jquery-ui.js')}}"></script>
    <script>
        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 18,
                max: 60,
                @if (Request::get('age'))
                    @php $arr = explode('-',Request::get('age')); @endphp
                values: [{{$arr[0]}}, {{$arr[1]}}],
                @else
                values: [18, 60],
                @endif

                slide: function (event, ui) {
                    $("#amount").val("" + ui.values[0] + "-" + ui.values[1]);
                }
            });
            $("#amount").val("" + $("#slider-range").slider("values", 0) +
                " - " + $("#slider-range").slider("values", 1));
        });
    </script>
    <script type="text/javascript">
        $('#advance').click(function () {
            $('#filters').slideToggle(1000);
        });
    </script> --}}
@endsection
