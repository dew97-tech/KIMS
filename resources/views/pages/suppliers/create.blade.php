@extends("layouts.app")

@push("header-script")
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section("content")
    <div class="container">

        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h4 class="m-0 font-weight-bold text-primary">Create Supplier</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route("suppliers.store") }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row mb-3">
                        <label for="supplier_name" class="pb-1 form-label font-weight-bold">Supplier Name <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="supplier_name" name="supplier_name" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="supplier_phone" class="pb-1 form-label font-weight-bold">Supplier Phone <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="supplier_phone" name="supplier_phone" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="supplier_address" class="pb-1 form-label font-weight-bold">Supplier Address <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="supplier_address" name="supplier_address"
                                required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success py-2 float-right">Save Supplier</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@push("plugin-scripts")
    <!-- Plugin js import here -->
@endpush
