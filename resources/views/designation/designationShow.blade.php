@if($categories)
    <ul>
        @php
            try {
                foreach ($categories as $category) {
                    echo '<li><a href="' . route('designation.edit', $category->id) . '" class="inline">' . $category->designation_name . '</a></li>';

                    if (count($category->subcategory)) {
                        echo view('designation.designationShow', ['categories' => $category->subcategory])->render();
                    }
                }
            } catch (\Exception $e) {
                // Handle the exception here
            }
        @endphp
    </ul>
@endif