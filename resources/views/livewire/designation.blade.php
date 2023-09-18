{{--<div>--}}

{{--    <div wire:ignore>--}}
{{--        <select class="form-control select2" id="dep_id"  wire:change="getDesignationForDepartment($event.target.value)">--}}
{{--            <option value="">Select Option</option>--}}
{{--            @foreach($webseries as $item)--}}
{{--                <option value="{{ $item }}">{{ $item }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--    </div>--}}

{{--</div>--}}




<div class="form-group row">
    <div class="col-md-4">
        <label for="dep_id">{{ __('Department') }}<span class="text-danger">*</span></label>
        <select name="dep_id"
                class="form-control select2 @error('dep_id') is-invalid @enderror"
                wire:change="getDesignationForDepartment($event.target.value)"
                id="dep_id">
            <option class="form-control " value=""> Choose Department</option>

            @foreach(\App\Models\Department::where('parent_id',0)->get() as $dep)
                <option value="{{ $dep->id }}" {{(old('dep_id')==$dep->id)?'selected="selected"':''}} >
                    {{ strtoupper($dep->dep_name) }}
                </option>
            @endforeach
        </select>
        @error('dep_id')
        <span class="invalid-feedback" role="alert">
                                                <strong>department is required</strong>
                                            </span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="designation">{{ __('Designation') }}<span class="text-danger">*</span></label>
        <input list="designation" type="text" placeholder="Your designation"
               class="form-control @error('designation') is-invalid @enderror"
               name="designation" value="{{ old('designation') }}" required minlength="3">
        <datalist id="designation">
            @foreach(\App\User::whereNotNull('designation')->distinct('designation')->orderBy('designation', 'ASC')->get('designation') as $des)
                <option value="{{$des->designation}}">
            @endforeach
        </datalist>

        @error('designation')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="email">{{ __('Email Address') }}</label>
        <input id="email" type="email" placeholder="Email"
               class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email') }}" autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>

</div>
{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#dep_id').on('change', function (e) {--}}
{{--                var data = $('#dep_id').select2("val");--}}
{{--            @this.set('department_id', data);--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
