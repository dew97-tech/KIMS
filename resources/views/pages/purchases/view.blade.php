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
                        <h6 class="card-title">Products with same Purchase_NO</h6>
                        {{-- <a id="create-new" type="button" class="btn btn-primary float-right"
                            href="{{route('purchases.create')}}">Add Purchase</a>
                        <a id="create-new" type="button" class="btn btn-info float-right mx-3"
                            href="{{route('purchases.pending')}}">Approve Purchase</a> --}}
                        <div class="table-responsive pt-3 px-1">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Purchase No</th>
                                        <th>Date</th>
                                        <th>Supplier</th>
                                        <th>Quantity</th>
                                        <th>Product Name</th>
                                        {{-- <th>Status</th>
                                        <th>Actions</th> --}}
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($purchases as $index => $purchase)
                                    <tr>
                                        
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $purchase->purchase_no }}</td>
                                        <td>{{ $purchase->date }}</td>
                                        <td>{{ $purchase->supplier->supplier_name }}</td>
                                        <td>{{ $purchase->buying_quantity}}</td>
                                        <td>{{ $purchase->product->product_name }}</td>
                                        
                                        {{-- <td>
                                            @if($purchase->status == '0')
                                            <span class="btn btn-warning">Pending</span>
                                            @elseif ($purchase->status =='1')
                                            <span class="btn btn-success">Approved</span>
                                            @endif
                                        </td> --}}
                                        {{-- <td>
                                            @if($purchase->status == '0')
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