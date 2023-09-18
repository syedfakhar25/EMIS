@foreach ($parent_designations as $des)
    <option value="{{ $des->id }}" @if($designation->id == $des->id) selected @endif>{{ strtoupper($des->designation_name) }} </option>
    @if (count($des->subcategory))
        @include('designation.designationEdit',['parent_designations' => $des->subcategory])
    @endif
@endforeach
