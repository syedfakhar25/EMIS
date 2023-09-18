@foreach ($parent_designations as $designation)
    {
    {{-- @if (!count($designation->subcategory))
        id: {{ $designation->id }},
    @endif --}}
    id: {{ $designation->id }},
    text: "{{ strtoupper($designation->dep_name) }}",
    @if (isset($subDepartment))
        @if ($designation->id == $subDepartment->dep_id) selected:"true", @endif
    @endif
    @if (count($designation->subcategory))
        inc: [@include('sub-departments.sub-departments',['parent_designations' => $designation->subcategory])]
    @endif
    },
@endforeach
