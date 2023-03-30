@extends('layouts.app')

@push('header-script')
<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section('content')

<div class="container">
    <h2>Create Product</h2>
    <br>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="product_name" class="col-sm-2 col-form-label">Product Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="product_description" class="col-sm-2 col-form-label">Product Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="product_description" name="product_description"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="product_price" class="col-sm-2 col-form-label">Product Price</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="product_price" name="product_price" required>
                    </div>
                </div>
                {{-- Categories --}}
                <div class="form-group row">
                    <label for="product_category" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        
                        <select id='product_category' name='product_category' class='form-control' required>
                            <option value="">Select Category (mandatory)</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Brands --}}
                <div class="form-group row">
                    <label for="product_brand" class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        
                        <select id='product_brand' name='product_brand' class='form-control' required>
                            <option value="">Select Brand (mandatory)</option>

                            @foreach ($brands as $brand)
                            <!-- Set the selected options from brands list-->
                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Units --}}
                <div class="form-group row">
                    <label for="product_unit" class="col-sm-2 col-form-label">Unit</label>
                    <div class="col-sm-10">
                        
                        <select id='product_unit' name='product_unit' class='form-control' required>
                            <option value="">Select Unit (mandatory)</option>

                            @foreach ($units as $unit)
                            <!-- Set the selected options from unit list -->
                            <option value="{{ $unit->id }}">{{ $unit->unit_shortform }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Suppliers --}}
                <div class="form-group row">
                    <label for="product_supplier" class="col-sm-2 col-form-label">Supplier</label>
                    <div class="col-sm-10">
                        
                        <select id='product_supplier' name='product_supplier' class='form-control' required>
                            <option value="">Select Supplier (mandatory)</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
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