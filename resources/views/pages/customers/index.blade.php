@extends("layouts.app")

@section("title", "Customers")

@push("plugin-styles")
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endpush

@section("content")
    <div id="customers" class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h4 class="m-0 font-weight-bold text-primary">Customer List</h4>
                        <a id="create-new" type="button" class="btn btn-primary float-right"
                            href="{{ route("customers.create") }}">Add New Customer</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pt-3 px-1">
                            <table class="table table-bordered cell-border" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($customers as $index => $customer)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $customer->customer_name }}</td>
                                            <td>{{ $customer->customer_email }}</td>
                                            <td>{{ $customer->customer_phone }}</td>
                                            <td>{{ $customer->customer_address }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-warning btn-sm mx-2 py-2"
                                                    href="{{ route("customers.edit", $customer->id) }}">
                                                    <span class="glyphicon glyphicon-edit">Edit</span>
                                                </a>
                                                <a class="btn btn-danger btn-sm mx-2 py-2"
                                                    href="{{ route("customers.destroy", $customer->id) }}"
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

@push("plugin-scripts")
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

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
