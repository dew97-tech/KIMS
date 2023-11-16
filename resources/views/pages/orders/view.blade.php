@extends("layouts.app")

@section("title", "Order Details")

@push("plugin-styles")
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endpush

@section("content")
    <div id="learnings" class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-10">

                <div class="card mb-3">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $orders[0]->order_no }}</h6>
                        <h6 class="m-0 font-weight-bold text-primary">Customer: {{ $orders[0]->customer_name }}</h6>
                        <h6 class="m-0 font-weight-bold text-primary">Total Amount: {{ $totalAmount }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="float-right">
                            @if (!$orders->contains("status", 0))
                                <button class="btn btn-sm btn-success mx-2 py-2 text-white" disabled>Approve All</button>
                            @else
                                <a href="{{ route("orders.approveAll", $orders[0]->order_no) }}"
                                    class="btn btn-sm btn-success mx-2 py-2">Approve All</a>
                            @endif
                        </div>

                        <div class="table-responsive pt-3 px-1">
                            <table class="table table-bordered cell-border" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Unit Cost</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $order->product->product_name }}</td>
                                            <td>{{ $order->product->product_price }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td class="text-center">
                                                @if ($order->status == "0")
                                                    <span class="btn btn-warning"
                                                        style="pointer-events: none;">Pending</span>
                                                @elseif ($order->status == "1")
                                                    <span class="btn btn-success"
                                                        style="pointer-events: none;">Approved</span>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-evenly">
                                                @if ($order->status == "0")
                                                    <a class="btn btn-sm btn-danger mx-2 py-2"
                                                        href="{{ route("orders.destroy", $order->id) }}"
                                                        onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </a>
                                                    <a class="btn btn-sm btn-success mx-2 py-2" type="button"
                                                        href="{{ route("orders.approve", $order->id) }}"
                                                        onclick="return confirm('Sure you want to approve this Order?')">
                                                        Approve
                                                    </a>
                                                @elseif ($order->status == "1")
                                                    <span class="btn btn-sm btn-success mx-2 py-2"
                                                        style="pointer-events: none;">Approved</span>
                                                @endif
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
    <!-- DataTable and Notify js initialization script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#myTable').DataTable();

            // Display notifications
            @if (session("alert-type") && session("message"))
                var alertType = "{{ session("alert-type") }}";
                var message = "{{ session("message") }}";

                if (alertType === 'error') {
                    // Use your notification library to show an error message
                    $.notify(message, {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                } else if (alertType === 'success') {
                    // Use your notification library to show a success message
                    $.notify(message, {
                        globalPosition: 'top right',
                        className: 'success'
                    });
                }
            @endif
        });
    </script>
@endpush

@push("custom-scripts")
    <!-- Custom js here -->
@endpush
