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
                            <h6 class="card-title">Stocks List</h6>
                            <a id="create-new" type="button" class="btn btn-primary float-right"
                                href="{{ route('stocks.create') }}">Add New Stock</a>
                            {{-- <a id="create-new" type="button" class="btn btn-primary float-right"
                                href="{{ route('stocks.viewPurchase') }}">View Purchase</a> --}}
                            <div class="table-responsive pt-3 px-1">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Unit</th>
                                            <th>Category</th>
                                            <th>Supplier</th>
                                            <th>In_Quantity</th>
                                            <th>Remaining_Quantity</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($stocks as $index => $stock)
                                            <tr>
                                                {{-- {{ dd($product->brand) }} --}}
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $stock->product->product_name }}</td>
                                                <td>{{ $stock->unit->unit_shortform }}</td>
                                                <td>{{ $stock->category->category_name }}</td>
                                                <td>{{ $stock->supplier->supplier_name }}</td>
                                                <td>{{ $stock->in_quantity }}</td>
                                                <td>{{ $stock->remaining_quantity }}</td>

                                                <td>
                                                    {{-- <a class="btn btn-primary"
                                                href="{{route('subjects.show', $batch->id)}}">
                                                <span class="glyphicon glyphicon-edit">Details</span>
                                            </a> --}}
                                                    <a class="btn btn-primary"
                                                        href="{{ route('stocks.edit', $stock->id) }}">
                                                        <span class="glyphicon glyphicon-edit">Edit</span>
                                                    </a>
                                                    <a class="btn btn-warning"
                                                        href="{{ route('stocks.viewPurchase', $stock->id) }}">
                                                        <span class="glyphicon glyphicon-edit">View Purchase</span>
                                                    </a>
                                                    <a class="btn btn-danger"
                                                        href="{{ route('stocks.destroy', $stock->id) }}"
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
