@extends('layouts.app')

@push('header-script')
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Create Product</h4>
                    </div>
                    <div class="card-body p-5">
                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control rounded-pill" id="product_name"
                                    name="product_name" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="product_description" class="form-label">Product Description</label>
                                <textarea class="form-control rounded" id="product_description" name="product_description"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="product_price" class="form-label">Product Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control rounded-pill" id="product_price"
                                        name="product_price" required>
                                </div>
                            </div>

                            {{-- Categories --}}
                            <div class="form-group mb-3">
                                <label for="product_category" class="form-label">Category</label>
                                <select id='product_category' name='product_category' class='form-control rounded-pill'
                                    required>
                                    <option value="">Select Category (mandatory)</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Brands --}}
                            <div class="form-group mb-3">
                                <label for="product_brand" class="form-label">Brand</label>
                                <select id='product_brand' name='product_brand' class='form-control rounded-pill' required>
                                    <option value="">Select Brand (mandatory)</option>

                                    @foreach ($brands as $brand)
                                        <!-- Set the selected options from brands list-->
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Units --}}
                            <div class="form-group mb-3">
                                <label for="product_unit" class="form-label">Unit</label>
                                <select id='product_unit' name='product_unit' class='form-control rounded-pill' required>
                                    <option value="">Select Unit (mandatory)</option>

                                    @foreach ($units as $unit)
                                        <!-- Set the selected options from unit list -->
                                        <option value="{{ $unit->id }}">{{ $unit->unit_shortform }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success rounded-pill px-4">Save Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <!-- Plugin js import here -->
@endpush
