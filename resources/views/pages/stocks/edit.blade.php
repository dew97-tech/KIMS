@extends('layouts.app')

@push('header-script')
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section('content')
    <div class="container">
        <h2>Edit Stock</h2>
        <br>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('stocks.update', $stock->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="in_quantity" class="col-sm-2 col-form-label">Product In_Quantity</label>
                        <div class="col-sm-10">

                            <input class="form-control" id="in_quantity" name="in_quantity"
                                value=" {{ $stock->in_quantity }} ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="remaining_quantity" class="col-sm-2 col-form-label">Product Remaining</label>
                        <div class="col-sm-10">

                            <input class="form-control" id="remaining_quantity" name="remaining_quantity"
                                value=" {{ $stock->remaining_quantity }} ">
                        </div>
                    </div>

                    {{-- Categories --}}
                    <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <!-- Replace "categories" with your actual categories variable name -->
                            <select id='category_id' name='category_id' class='form-control'>

                                @foreach ($categories as $category)
                                    <!-- Set the selected option based on the product's category -->
                                    @if ($category->id == $stock->category_id)
                                        <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- Products --}}
                    <div class="form-group row">
                        <label for="product_id" class="col-sm-2 col-form-label">Product</label>
                        <div class="col-sm-10">
                            
                            <select id='product_id' name='product_id' class='form-control'>
                                @foreach ($products as $product)
                                    
                                    @if ($product->id == $stock->product_id)
                                        <option value="{{ $product->id }}" selected>{{ $product->product_name }}</option>
                                    @else
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- Units --}}
                    <div class="form-group row">
                        <label for="unit_id" class="col-sm-2 col-form-label">Unit</label>
                        <div class="col-sm-10">
                            <!-- Replace "units" with your actual units variable name -->
                            <select id='unit_id' name='unit_id' class='form-control'>
                                @foreach ($units as $unit)
                                    <!-- Set the selected option based on the product's unit -->
                                    @if ($unit->id == $stock->unit_id)
                                        <option value="{{ $unit->id }}" selected>{{ $unit->unit_shortform }}</option>
                                    @else
                                        <option value="{{ $unit->id }}">{{ $unit->unit_shortform }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- Supplier --}}
                    <div class="form-group row">
                        <label for="supplier_id" class="col-sm-2 col-form-label">Supplier</label>
                        <div class="col-sm-10">
                            <!-- Replace "units" with your actual units variable name -->
                            <select id='supplier_id' name='supplier_id' class='form-control'>
                                @foreach ($suppliers as $supplier)
                                    <!-- Set the selected option based on the product's unit -->
                                    @if ($supplier->id == $stock->supplier_id)
                                        <option value="{{ $supplier->id }}" selected>{{ $supplier->supplier_name }}
                                        </option>
                                    @else
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
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
