@foreach ($parent_designations as $designation)
    {
    {{-- @if (!count($designation->subcategory))
        id: {{ $designation->id }},
    @endif --}}
    id: {{ $designation->id }},
    text: "{{ strtoupper($designation->designation_name) }}",
    @if (isset($des))
        @if ($designation->id == $des->parent_id) selected:"true", @endif
    @endif
    @if (count($designation->subcategory))
        inc: [@include('designation.designationTree',['parent_designations' => $designation->subcategory])]
    @endif
    },
@endforeach
