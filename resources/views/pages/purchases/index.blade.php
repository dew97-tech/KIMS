@extends('layouts.app')

@section('title', 'Products')

@push('plugin-styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endpush

@section('content')
    <div id="learnings" class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Approved Purchase Orders</h6>
                        <div>
                            <a id="create-new" type="button" class="btn btn-primary float-right"
                                href="{{ route('purchases.create') }}">Add Purchase</a>
                            <a id="create-new" type="button" class="btn btn-warning float-right text-dark mx-3"
                                href="{{ route('purchases.pending') }}">Pending Purchases</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pt-3 px-1">
                            <table class="table table-bordered cell-border" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Purchase No</th>
                                        <th>Date</th>
                                        <th>Supplier</th>
                                        <th>Quantity</th>
                                        <th>Product Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($purchases as $index => $purchase)
                                        <tr>

                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $purchase->purchase_no }}</td>
                                            <td>{{ $purchase->date }}</td>
                                            <td>{{ $purchase->supplier->supplier_name }}</td>
                                            <td>{{ $purchase->buying_quantity }}</td>
                                            <td>{{ $purchase->product->product_name }}</td>

                                            <td class="text-center">
                                                {{-- @if ($purchase->status == '0')
                                            <span class="btn btn-warning">Pending</span>
                                            @elseif ($purchase->status =='1')
                                            @endif --}}
                                                <span class="btn btn-success">Approved</span>
                                            </td>
                                            <td class="text-center">
                                                {{-- @if ($purchase->status == '0')
                                            <a class="btn btn-danger float-left"
                                                href="{{ route('purchases.destroy', $purchase->id) }}"
                                                onclick="return confirm('Are you sure?')">
                                                <span class="glyphicon glyphicon-trash">Delete</span>
                                            </a>
                                            @endif --}}
                                                <a class="btn btn-info text-center"
                                                    href="{{ route('purchases.show', $purchase->purchase_no) }}">
                                                    <span class="glyphicon glyphicon-trash">View</span>
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
