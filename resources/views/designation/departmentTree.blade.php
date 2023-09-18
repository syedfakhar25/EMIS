@foreach ($parent_departments as $department)
    {
    id: {{ $department->id }},
    text: "{{ strtoupper($department->dep_name) }}",
    @if (isset($des))
        @if ($department->id == $des->dep_id) selected:"true", @endif
    @endif
    @if (count($department->subcategory))
        inc: [@include('designation.departmentTree',['parent_departments' => $department->subcategory])]
    @endif
    },
@endforeach
