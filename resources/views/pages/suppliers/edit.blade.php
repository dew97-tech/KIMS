@extends('layouts.app')

@push('header-script')
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section('content')
    <div class="container">
        <h2>Edit Supplier</h2>
        <br>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('suppliers.update', $supplier->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="supplier_name" class="col-sm-2 col-form-label">Supplier Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="supplier_name" name="supplier_name"
                                value="{{ $supplier->supplier_name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="supplier_phone" class="col-sm-2 col-form-label">Supplier Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="supplier_phone" name="supplier_phone"
                                value="{{ $supplier->supplier_phone }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="supplier_address" class="col-sm-2 col-form-label">Supplier Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="supplier_address" name="supplier_address"
                                value="{{ $supplier->supplier_address }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <!-- Plugin js import here -->
@endpush
