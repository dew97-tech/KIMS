@extends('layouts.app')

@section('title', 'Products')

@push('plugin-styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endpush

@section('content')
    <div id="learnings" class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Brands</h6>
                        <a id="create-new" type="button" class="btn btn-primary float-right"
                            href="{{ route('brands.create') }}">Add New Brand</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pt-3 px-1">
                            <table class="table table-bordered table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Brand Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($brands as $index => $brand)
                                        <tr>
                                            {{-- {{ dd($product->brand) }} --}}
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $brand->brand_name }}</td>
                                            <td>

                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('brands.edit', $brand->id) }}">
                                                    <span class="glyphicon glyphicon-edit">Edit</span>
                                                </a>
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('brands.destroy', $brand->id) }}"
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
