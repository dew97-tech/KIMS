@extends('layouts.app')

@section('title', 'Products')

@push('plugin-styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endpush


@section('content')
    <div id="learnings">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                        <h6 class="m-0 font-weight-bold text-white">Units</h6>
                        <a id="create-new" type="button" class="btn btn-light float-right"
                            href="{{ route('units.create') }}">Add New Unit</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 99%" id="myTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Unit Name</th>
                                        <th>Unit Shortform</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($units as $index => $unit)
                                        <tr class="text-center">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $unit->unit_name }}</td>
                                            <td>{{ $unit->unit_shortform }}</td>
                                            <td class="d-flex justify-content-center">
                                                <a class="btn btn-sm btn-warning mr-2"
                                                    href="{{ route('units.edit', $unit->id) }}">Edit</a>
                                                <form action="{{ route('units.destroy', $unit->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                                </form>
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

@push('styles')
    <link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('mdb/js/mdb.min.js') }}"></script>
@endpush


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
