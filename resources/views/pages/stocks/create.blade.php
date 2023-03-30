@extends('layouts.app')

@push('header-script')
<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section('content')

<div class="container">
    <h2>Create Stock</h2>
    <br>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('stocks.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="in_quantity" class="col-sm-2 col-form-label">Product In_Quantity</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="in_quantity" name="in_quantity">
                    </div>
                </div>

                {{-- Products --}}
                <div class="form-group row">
                    <label for="product_id" class="col-sm-2 col-form-label">Add Product</label>
                    <div class="col-sm-10">
                        
                        <select id='product_id' name='product_id' class='form-control' required>
                            <option value="">Select Product (mandatory)</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Categories --}}
                <div class="form-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">Add Category</label>
                    <div class="col-sm-10">
                        
                        <select id='category_id' name='category_id' class='form-control' required>
                            <option value="">Select Category (mandatory)</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Supplier --}}
                <div class="form-group row">
                    <label for="supplier_id" class="col-sm-2 col-form-label">Add Supplier</label>
                    <div class="col-sm-10">
                        
                        <select id='supplier_id' name='supplier_id' class='form-control' required>
                            <option value="">Select Supplier (mandatory)</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Units --}}
                <div class="form-group row">
                    <label for="unit_id" class="col-sm-2 col-form-label">Add Unit</label>
                    <div class="col-sm-10">
                        
                        <select id='product_unit' name='unit_id' class='form-control' required>
                            <option value="">Select Unit (mandatory)</option>

                            @foreach ($units as $unit)
                            <!-- Set the selected options from unit list -->
                            <option value="{{ $unit->id }}">{{ $unit->unit_shortform }}</option>
                            @endforeach
                        </select>
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