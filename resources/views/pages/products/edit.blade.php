@extends('layouts.app')

@push('header-script')
<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section('content')

<div class="container">
    <h2>Edit Product</h2>
    <br>
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="product_name" class="col-sm-2 col-form-label">Product Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_name" name="product_name"
                            value="{{ $product->product_name }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="product_description" class="col-sm-2 col-form-label">Product Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="product_description"
                            name="product_description">{{ $product->product_description }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="product_price" class="col-sm-2 col-form-label">Product Price</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="product_price" name="product_price"
                            value="{{ $product->product_price }}">
                    </div>
                </div>
                {{-- Categories --}}
                <div class="form-group row">
                    <label for="product_category" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <!-- Replace "categories" with your actual categories variable name -->
                        <select id='product_category' name='product_category' class='form-control'>

                            @foreach ($categories as $category)
                            <!-- Set the selected option based on the product's category -->
                            @if ($category->id == $product->category_id)
                            <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                            @else
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Supplier --}}
                {{-- <div class="form-group row">
                    <label for="product_supplier" class="col-sm-2 col-form-label">Supplier</label>
                    <div class="col-sm-10">
                        <!-- Replace "categories" with your actual categories variable name -->
                        <select id='product_supplier' name='product_supplier' class='form-control'>

                            @foreach ($suppliers as $supplier)
                            <!-- Set the selected option based on the product's category -->
                            @if ($supplier->id == $product->supplier_id)
                            <option value="{{ $supplier->id }}" selected>{{ $supplier->supplier_name }}</option>
                            @else
                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                {{-- Brands --}}
                <div class="form-group row">
                    <label for="product_brand" class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <!-- Replace "brands" with your actual brands variable name -->
                        <select id='product_brand' name='product_brand' class='form-control'>
                            @foreach ($brands as $brand)
                            <!-- Set the selected option based on the product's brand -->
                            @if ($brand->id == $product->brand_id)
                            <option value="{{ $brand->id }}" selected>{{ $brand->brand_name }}</option>
                            @else
                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Units --}}
                <div class="form-group row">
                    <label for="product_unit" class="col-sm-2 col-form-label">Unit</label>
                    <div class="col-sm-10">
                        <!-- Replace "units" with your actual units variable name -->
                        <select id='product_unit' name='product_unit' class='form-control'>
                            @foreach ($units as $unit)
                            <!-- Set the selected option based on the product's unit -->
                            @if ($unit->id == $product->unit_id)
                            <option value="{{ $unit->id }}" selected>{{ $unit->unit_shortform }}</option>
                            @else
                            <option value="{{ $unit->id }}">{{ $unit->unit_shortform }}</option>
                            @endif
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