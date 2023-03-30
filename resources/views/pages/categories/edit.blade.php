@extends('layouts.app')

@push('header-script')
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@section('content')
    <div class="container">
        <h2>Edit Categpry</h2>
        <br>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="category_name" name="category_name"
                                value="{{ $category->category_name }}">
                        </div>
                    </div>
                    {{-- Parent Categories --}}
                    {{-- It should be There --}}
                    <div class="form-group row">
                        <label for="parent_category_id" class="col-sm-2 col-form-label">Parent Category</label>
                        <div class="col-sm-10">
                          
                            <select id='parent_category_id' name='parent_category_id' class='form-control'>
                                {{-- This condition checks if $category has a parent category 
                                        and if $cat is the parent of that parent category. 
                                        If this condition is true, it means that $cat is a child of $category, 
                                        so we shouldn't add it as an option. --}}
                                <option value="" {{ $category->parentCategory ? '' : 'selected' }}>No Parent Category
                                </option>
                                @foreach ($categories as $cat)
                                    @php
                                        $isChild = false;
                                        if ($cat->parentCategory) {
                                            $isChild = $cat->parentCategory->id == $category->id; 
                                        }
                                    @endphp
                                    @if ($cat->id != $category->id && !$isChild)
                                        
                                        <option value="{{ $cat->id }}"
                                            {{ $category->parentCategory && $cat->id == $category->parentCategory->id ? 'selected' : '' }}>
                                            {{ $cat->category_name }}</option>
                                    @endif
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
