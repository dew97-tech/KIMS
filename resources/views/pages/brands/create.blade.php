@extends('layouts.app')

@push('header-script')
<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section('content')

<div class="container">
    <h2>Create Brand</h2>
    <br>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('brands.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="brand_name" class="col-sm-2 col-form-label">Brand Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="brand_name" name="brand_name">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('plugin-scripts')
<!-- Plugin js import here -->

@endpush