@extends('layouts.app')

@push('header-script')
<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section('content')

<div class="container">
    <h2>Create Category</h2>
    <br>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="category_name" name="category_name">
                    </div>
                </div>
                {{-- Parent Category --}}
                <div class="form-group row">
                    <label for="parent_category_id" class="col-sm-2 col-form-label">Parent Category</label>
                    <div class="col-sm-10">
                        
                        <select id='parent_category_id' name='parent_category_id' class='form-control'>
                            <!-- added empty option -->
                            <option value="">Select parent category (optional)</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
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