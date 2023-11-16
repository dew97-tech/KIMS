@extends("layouts.app")

@section("title", "Products")

@push("plugin-styles")
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endpush

@section("content")
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-lg-10 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h4 class="m-0 font-weight-bold text-primary">Product List</h4>
                        <a id="create-new" type="button" class="btn btn-primary float-right"
                            href="{{ route("products.create") }}">Add New Product</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pt-3 px-1">
                            <table class="table table-bordered border-secondary cell-border" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        {{-- <th scope="col">Description</th> --}}
                                        <th scope="col">Cost</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $index => $product)
                                        <tr>
                                            {{-- {{ dd($product->brand) }} --}}
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            {{-- <td>{{ $product->product_description }}
                                            </td> --}}
                                            <td>{{ $product->product_cost }}</td>
                                            <td>{{ $product->product_price }}</td>
                                            <td>
                                                {{ $product->category->category_name }}</td>
                                            <td>{{ $product->brand->brand_name }}
                                            </td>
                                            <td>
                                                {{ $product->unit->unit_shortform }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-warning mx-2 py-2"
                                                    href="{{ route("products.edit", $product->id) }}">
                                                    {{-- <i class="fas fa-edit"></i> --}}Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger mx-2 py-2"
                                                    href="{{ route("products.destroy", $product->id) }}">
                                                    {{-- <i class="fas fa-trash"></i> --}}Delete
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
@endsection


@push("plugin-scripts")
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush

@push("custom-scripts")
    <!-- Custom js here -->
@endpush
