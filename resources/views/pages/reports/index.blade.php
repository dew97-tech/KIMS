@extends('layouts.app')

@section('title', 'Batches')

@push('plugin-styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endpush

@section('content')
<div class="row m-1">
    <div class="col-md-6 ml-auto">
        <div style="float: right" class="dropdown mb-2">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Jan 1, 2023 - Jan 15, 2023
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Jan 1, 2023 - Jan 15, 2023</a>
                <a class="dropdown-item" href="#">Jan 16, 2023 - Jan 31, 2023</a>
                <a class="dropdown-item" href="#">Feb 1, 2023 - Feb 15, 2023</a>
                <a class="dropdown-item" href="#">Feb 16, 2023 - Feb 28, 2023</a>
            </div>
        </div>
    </div>
</div>
<div class="row m-auto">
    <div class="col-md-6 mb-3">
        <div class="d-flex flex-row justify-content-between align-items-center bg-info text-white p-3">
            <h2>Visitors</h2>
            <h4>3,000</h4>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="d-flex flex-row justify-content-between align-items-center bg-danger text-white p-3">
            <h2>Bounce Rate</h2>
            <h4>65%</h4>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <div class="bg-dark text-white p-3">

            <h2>Session Duration</h2>
            <table class="table table-hover">
                <thead class="bg-white text-dark">
                    <tr>
                        <th>Date</th>
                        <th>Average Session Duration</th>
                        <th>Page Views per Session</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-white">
                        <td>2022-02-01</td>
                        <td>00:02:35</td>
                        <td>1.43</td>
                    </tr>
                    <tr class="text-white">
                        <td>2022-02-02</td>
                        <td>00:03:15</td>
                        <td>1.33</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="col-md-6 mb-3">
        <div class="bg-white text-black p-3">
            <h2 style="color: black">Sources</h2>
            <table class="table table-hover">
                <thead class="bg-dark">
                    <tr>
                        <th>#</th>
                        <th>Sources</th>
                        <th>Users</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <td>Organic Search</td>
                        <td>1,500</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Direct</td>
                        <td>1,000</td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td>Referral</td>
                        <td>750</td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <td>Social</td>
                        <td>250</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="bg-secondary text-white p-3">
            <h2 style="color:rgb(90, 90, 90)">Page Hits</h2>
            <table class="table table-hover">
                <thead class="bg-dark">
                    <tr>
                        <th>#</th>
                        <th>Page Title</th>
                        <th>New Users</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Homepage</td>
                        <td>1000</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Product Page</td>
                        <td>750</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>About Us</td>
                        <td>500</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Contact Us</td>
                        <td>250</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>



</div>
@endsection

@push('plugin-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
@endpush

@push('custom-scripts')
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endpush