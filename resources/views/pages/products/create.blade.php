@extends('layouts.app')

@push('header-script')
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section('content')
    <div class="container">

        <div class="card ">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h4 class="m-0 font-weight-bold text-primary">Create Product</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="product_description" class="form-label">Product Description <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <textarea class="form-control rounded" id="product_description" name="product_description"></textarea>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="product_price" class="form-label">Product Price <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            {{-- <span class="input-group-text">$</span> --}}
                            <input type="number" class="form-control " id="product_price" name="product_price" required>
                        </div>
                    </div>

                    {{-- Categories --}}
                    <div class="form-group row mb-3">
                        <label for="product_category" class="form-label">Category <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select id='product_category' name='product_category' class='form-control ' required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Brands --}}
                    <div class="form-group row mb-3">
                        <label for="product_brand" class="form-label">Brand <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select id='product_brand' name='product_brand' class='form-control ' required>
                                <option value="">Select Brand </option>

                                @foreach ($brands as $brand)
                                    <!-- Set the selected options from brands list-->
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Units --}}
                    <div class="form-group row mb-5">
                        <label for="product_unit" class="form-label">Unit <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select id='product_unit' name='product_unit' class='form-control ' required>
                                <option value="">Select Unit</option>

                                @foreach ($units as $unit)
                                    <!-- Set the selected options from unit list -->
                                    <option value="{{ $unit->id }}">{{ $unit->unit_shortform }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success  py-2 float-right">Save Product</button>
                </form>
            </div>
        </div>
    @endsection

    @push('plugin-scripts')
        <!-- Plugin js import here -->
    @endpush
