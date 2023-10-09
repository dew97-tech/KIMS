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
                        <h6 class="m-0 font-weight-bold text-primary">{{ $purchases[0]->purchase_no }}
                        </h6>
                        <h6 class="m-0 font-weight-bold text-primary">Date : {{ $purchases[0]->date }}
                        </h6>
                        @php
                            $totalPrice = $purchases->sum('buying_price');
                        @endphp
                        <h6 class="m-0 font-weight-bold text-primary">Price: {{ $totalPrice }}</h6>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive pt-3 px-1">
                            <table class="table table-bordered cell-border" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        {{-- <th>Purchase No</th> --}}
                                        {{-- <th>Date</th> --}}
                                        <th>Product Name</th>
                                        <th>Supplier</th>
                                        <th>Quantity</th>
                                        {{-- <th>Price</th> --}}
                                        <th>Status</th>
                                        {{-- <th>Status</th>
                                        <th>Actions</th> --}}
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($purchases as $index => $purchase)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            {{-- <td class="text-center">{{ $purchase->purchase_no }}</td> --}}
                                            {{-- <td class="text-center">{{ $purchase->date }}</td> --}}
                                            <td>{{ $purchase->product->product_name }}</td>
                                            <td>{{ $purchase->supplier->supplier_name }}</td>
                                            <td>{{ $purchase->buying_quantity }}</td>
                                            {{-- <td class="text-center">{{ $purchase->buying_price }}</td> --}}
                                            <td class="text-center">
                                                @if ($purchase->status == '0')
                                                    <span class="btn btn-warning"
                                                        style="pointer-events: none;">Pending</span>
                                                @elseif ($purchase->status == '1')
                                                    <span class="btn btn-success"
                                                        style="pointer-events: none;">Approved</span>
                                                @endif
                                            </td>
                                            {{-- <td>
                                            @if ($purchase->status == '0')
                                            <a class="btn btn-danger"
                                                href="{{ route('purchases.destroy', $purchase->id) }}"
                                                onclick="return confirm('Are you sure?')">
                                                <span class="glyphicon glyphicon-trash">Delete</span>
                                            </a>
                                            @endif
                                            <a class="btn btn-primary"
                                                href="{{ route('purchases.view', $purchase->purchase_no) }}">
                                                <span class="glyphicon glyphicon-trash">View</span>
                                            </a>
                                        </td> --}}
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
