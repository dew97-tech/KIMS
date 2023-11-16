@extends("layouts.app")

@section("title", "Orders")

@push("plugin-styles")
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endpush

@section("content")
    <div id="learnings" class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h4 class="m-0 font-weight-bold text-primary">Order</h4>
                        <div>
                            <a id="create-new" type="button" class="btn btn-primary float-right"
                                href="{{ route("orders.create") }}">Add New Order</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pt-3 px-1">
                            <table class="table table-bordered cell-border" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Date</th>
                                        <th>Order No</th>
                                        <th>Product Name</th>
                                        <th>Customer Name</th>
                                        <th>Total Amount</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($orders as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $order->order_date }}</td>
                                            <td>{{ $order->order_no }}</td>
                                            <td>{{ $order->product->product_name }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>{{ $order->total_amount }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td class="text-center">
                                                @if ($order->status == "0")
                                                    <span class="btn btn-sm btn-warning mx-2 py-2"
                                                        style="pointer-events: none;">Pending</span>
                                                @elseif ($order->status == "1")
                                                    <span class="btn btn-sm btn-success mx-2 py-2"
                                                        style="pointer-events: none;">Approved</span>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <a class="btn btn-sm btn-info mx-2 py-2"
                                                    href="{{ route("orders.show", $order->order_no) }}">
                                                    View
                                                </a>
                                                {{-- Add other actions if needed --}}
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
