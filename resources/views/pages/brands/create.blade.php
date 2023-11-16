@extends("layouts.app")

@push("header-script")
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section("content")
    <div class="container">

        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h4 class="m-0 font-weight-bold text-primary">Create Brand</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route("brands.store") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="brand_name" class="pb-1 form-label font-weight-bold">Brand Name <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="brand_name" name="brand_name" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success py-2 float-right">Save Brand</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@push("plugin-scripts")
    <!-- Plugin js import here -->
@endpush
