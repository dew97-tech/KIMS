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
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Suppliers</h6>
                                <a id="create-new" type="button" class="btn btn-primary float-right"
                                    href="{{ route('suppliers.create') }}">Add New Supplier</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive pt-3 px-1">
                                    <table class="table table-striped table-bordered table-hover" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Supplier Name</th>
                                                <th>Supplier Phone</th>
                                                <th>Supplier Address</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($suppliers as $index => $supplier)
                                                <tr>
                                                    {{-- {{ dd($product->brand) }} --}}
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $supplier->supplier_name }}</td>
                                                    <td>{{ $supplier->supplier_phone }}</td>
                                                    <td>{{ $supplier->supplier_address }}</td>
                                                    <td>

                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('suppliers.edit', $supplier->id) }}">
                                                            <span class="glyphicon glyphicon-edit">Edit</span>
                                                        </a>
                                                        <a class="btn btn-danger btn-sm"
                                                            href="{{ route('suppliers.destroy', $supplier->id) }}"
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
