@extends("layouts.app")

@push("header-script")
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section("content")
    <div class="container">

        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h4 class="m-0 font-weight-bold text-primary">Create Customer</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route("customers.store") }}" method="post">
                    @csrf

                    <div class="form-group row mb-3">
                        <label for="customer_name" class="pb-1 form-label font-weight-bold">Customer Name <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="customer_email" class="pb-1 form-label font-weight-bold">Email <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="customer_phone" class="pb-1 form-label font-weight-bold">Phone <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="customer_address" class="pb-1 form-label font-weight-bold">Address <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="customer_address" name="customer_address"
                                required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success py-2 float-right">Save Customer</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@push("plugin-scripts")
    <!-- Plugin js import here -->
@endpush
