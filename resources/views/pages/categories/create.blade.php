@extends("layouts.app")

@push("header-script")
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section("content")
    <div class="container">

        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h4 class="m-0 font-weight-bold text-primary">Create Category</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route("categories.store") }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row mb-3">
                        <label for="category_name" class="pb-1 form-label font-weight-bold">Category Name <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
                        </div>
                    </div>

                    {{-- Parent Category --}}
                    <div class="form-group row mb-3">
                        <label for="parent_category_id" class="pb-1 form-label font-weight-bold">Parent Category</label>
                        <div class="input-group">
                            <select id='parent_category_id' name='parent_category_id' class='form-control'>
                                <!-- added empty option -->
                                <option value="">Select parent category (optional)</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success py-2 float-right">Save Category</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@push("plugin-scripts")
    <!-- Plugin js import here -->
@endpush
