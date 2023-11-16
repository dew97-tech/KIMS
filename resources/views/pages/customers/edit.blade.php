@extends("layouts.app")

@push("header-script")
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section("content")
    <div class="container">
        <h2>Edit Customer</h2>
        <br>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route("customers.update", $customer->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="form-group row">
                        <label for="customer_name" class="col-sm-2 col-form-label">Customer Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_name" name="customer_name"
                                value="{{ $customer->customer_name }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customer_email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="customer_email" name="customer_email"
                                value="{{ $customer->customer_email }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customer_phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_phone" name="customer_phone"
                                value="{{ $customer->customer_phone }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customer_address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="customer_address" name="customer_address"
                                value="{{ $customer->customer_address }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push("plugin-scripts")
    <!-- Plugin js import here -->
@endpush
