@extends('layouts.app')

@section('title', 'Products')

@push('plugin-styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endpush

@section('content')
    <div id="learnings" class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-10 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Stocks</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive pt-3 px-1">
                            <table class="table table-bordered cell-border" id="myTable">
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

                                            <td class="text-center">
                                                <a class="btn btn-danger" href="{{ route('stocks.destroy', $stock->id) }}"
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
