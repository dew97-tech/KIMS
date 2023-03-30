@extends('layouts.app')

@section('title', 'Products')

@push('plugin-styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endpush

@section('content')
<div id="learnings">
    <div class="row justify-content-md-center">
        <div class="col-md-10">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Product List</h6>
                        <a id="create-new" type="button" class="btn btn-primary float-right"
                            href="{{route('products.create')}}">Add New</a>
                        <div class="table-responsive pt-3 px-1">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Supplier</th>
                                        <th>Brand</th>
                                        <th>Unit</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($products as $index => $product)
                                    <tr>
                                        {{-- {{ dd($product->brand) }} --}}
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_description }}</td>
                                        <td>{{ $product->product_price }}</td>
                                        <td>{{ $product->category->category_name}}</td>
                                        <td>{{ $product->supplier->supplier_name}}</td>
                                        <td>{{ $product->brand->brand_name }}</td>
                                        <td>{{ $product->unit->unit_shortform }}</td>
                                        <td>
                                            {{-- <a class="btn btn-primary"
                                                href="{{route('subjects.show', $batch->id)}}">
                                                <span class="glyphicon glyphicon-edit">Details</span>
                                            </a> --}}
                                            <a class="btn btn-primary" href="{{route('products.edit', $product->id)}}">
                                                <span class="glyphicon glyphicon-edit">Edit</span>
                                            </a>
                                            <a class="btn btn-danger"
                                                href="{{ route('products.destroy', $product->id) }}"
                                                onclick="return confirm('Are you sure?')">
                                                <span class="glyphicon glyphicon-trash">Delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endpush

@push('custom-scripts')
<!-- Custom js here -->
@endpush