@extends('layout.master')

@section('title', 'Edit Product')

@push('header-script')
<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
@endpush

@push('plugin-styles')
<!-- Plugin css import here -->
@endpush

@section('content')

<div class="container">
    <h2>Edit Product</h2>
    <br>
    <form class='form-horizontal' method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input value="{{$product->name}}" class="form-control form-control-lg" name="name" type="text" id="name" placeholder="Enter Name">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control form-control-lg" name="category">
                        @foreach($categories as $category)
                        <option value="{{$category}}" {{$category == $product->category ? 'selected' : ''}}>{{$category}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Image</label>
                    @php
                        $images = explode(",", $product->image);
                    @endphp
                    <input value="{{$images[0]}}" name="image" id="image" style="display: none;" type="text">
                    @if($images[0])
                        <img id="upload_widget" class="upload-button" src="{{$images[0]}}" style="max-width:300px; max-height:300px; cursor:pointer;" onclick="openImageUploader()">
                    @else
                        <img id="upload_widget" class="upload-button" src="/assets/images/upload.png" style="max-width:300px; max-height:300px; cursor:pointer;" onclick="openImageUploader()">
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="no_of_volumes">No of Packages</label>
                    <select class="form-control form-control-lg" id="no_of_volumes" name="no_of_volumes">
                        @for($i = 1; $i < 4; $i++)
                        <option value={{$i}} {{$i == $product->no_of_volumes ? 'selected' : ''}}>{{$i}}</option>
                        @endfor
                        {{-- <option value={{$i}}>2</option>
                        <option value={{$i}}>3</option> --}}
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="company">Company</label>
                    <select class="form-control form-control-lg" name="company">
                        @foreach($companies as $company)
                        <option value="{{$company->id}}" {{$company->id == $product->company ? 'selected' : ''}}>{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Location</label>
                    <input value="{{$product->location}}" class="form-control" name="location" type="text" id="location" placeholder="Enter Location">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="company">Status</label>
                    <select class="form-control form-control-lg" name="status">
                        @foreach ($status as $item)
                            <option value={{$item}} {{$product->status == $item ? 'selected' : ''}}>{{$item}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div id="vol1" class="row">
            <div class="col-3">
                <div class="form-group">
                    <label>Quantity</label>
                    <input value="{{$product->packages[0]->quantity}}" class="form-control" name="quantity1" type="text" id="quantity1" placeholder="Enter Location">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Unit</label>
                    <select class="form-control form-control-lg" name="unit1">
                        @foreach($units as $unit)
                        <option value="{{$unit}}" {{$unit == $product->packages[0]->unit ? 'selected' : ''}}>{{$unit}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Total Price</label>
                    <input value="{{$product->packages[0]->actual_price}}" class="form-control" name="price1" type="text" id="price1" placeholder="Enter Location">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Discount %</label>
                    <input value="{{$product->packages[0]->discount}}" class="form-control" name="discount1" type="text" id="discount1" placeholder="Enter Location">
                </div>
            </div>
        </div>
        @if (count($product->packages) > 1)
        <div id="vol2" class="row" style={{count($product->packages) < 2 ? "display: none" : ""}}>
            <div class="col-3">
                <div class="form-group">
                    <label>Quantity</label>
                    <input value="{{$product->packages[1]->quantity}}" class="form-control" name="quantity2" type="text" id="quantity2" placeholder="Enter Location">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Unit</label>
                    <select class="form-control form-control-lg" name="unit2">
                        @foreach($units as $unit)
                        <option value="{{$unit}}" {{$unit == $product->packages[1]->unit ? 'selected' : ''}}>{{$unit}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Total Price</label>
                    <input value="{{$product->packages[1]->actual_price}}" class="form-control" name="price2" type="text" id="price2" placeholder="Enter Location">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Discount %</label>
                    <input value="{{$product->packages[1]->discount}}" class="form-control" name="discount2" type="text" id="discount2" placeholder="Enter Location">
                </div>
            </div>
        </div>
        @endif
        
        @if (count($product->packages) > 2)
        <div id="vol3" class="row" style={{count($product->packages) < 3 ? "display: none" : ""}}>
            <div class="col-3">
                <div class="form-group">
                    <label>Quantity</label>
                    <input value="{{$product->packages[2]->quantity}}" class="form-control" name="quantity3" type="text" id="quantity3" placeholder="Enter Location">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Unit</label>
                    <select class="form-control form-control-lg" name="unit3">
                        @foreach($units as $unit)
                        <option value="{{$unit}}" {{$unit == $product->packages[2]->unit ? 'selected' : ''}}>{{$unit}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Total Price</label>
                    <input value="{{$product->packages[2]->actual_price}}" class="form-control" name="price3" type="text" id="price3" placeholder="Enter Location">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Discount %</label>
                    <input value="{{$product->packages[2]->discount}}" class="form-control" name="discount3" type="text" id="discount3" placeholder="Enter Location">
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <label>Description</label>
                <textarea class="form-control" name="description" id="description" rows="4" cols="50" placeholder="Enter Description">{{$product->description}}</textarea>
            </div>
        </div> 
        <div class="row">
            <div class="col-12">
                <label>Usage Time</label>
                <textarea class="form-control" name="usage_time" id="usage_time" rows="4" cols="50" placeholder="Enter Description">{{$product->usage_time}}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label>Usage Guide</label>
                <textarea class="form-control" name="usage_guide" id="usage_guide" rows="4" cols="50" placeholder="Enter Description">{{$product->usage_guide}}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label>Usage Image</label>
                @php
                    $usages_images = explode(",", $product->usage_visual);
                @endphp
                <input value="{{$usages_images[0]}}" name="usage_visual" id="usage_visual" style="display: none;" type="text" value="">
                @if($product->usage_visual)
                    <img id="upload_widget" class="upload-button" src="{{$usages_images[0]}}" style="max-width:300px; max-height:300px; cursor:pointer;" onclick="openImageUploader2()">
                @else
                    <img id="upload_widget" class="upload-button" src="/assets/images/upload.png" style="max-width:300px; max-height:300px; cursor:pointer;" onclick="openImageUploader2()">
                @endif
            </div>
        </div>
        <button id="save" type="submit" class="btn btn-primary text-center mt-1" @click="save">Save</button>
    </form>
</div>


@endsection

@push('plugin-scripts')
<!-- Plugin js import here -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script>
    $('#no_of_volumes').on('load change', function() {

        let no = $('#no_of_volumes').val();
        if (no == 1) {
            $('#vol2').hide();
            $('#vol3').hide();
            $('#vol1').show();
        } else if (no == 2) {
            $('#vol3').hide();
            $('#vol2').show();
            $('#vol1').show();
        } else if (no == 3) {
            $('#vol1').show();
            $('#vol2').show();
            $('#vol3').show();
        }
    });

    var openImageUploader = function() {
        var cloudinaryWidget = cloudinary.createUploadWidget({
                cloudName: 'ether-tech',
                uploadPreset: 'trk_general'
            },
            (error, result) => {
                if (!error && result && result.event === "success") {
                    // document.getElementById("default_image").src = result.info.secure_url;
                    // document.getElementById("image").value = result.info.secure_url;

                    let oldVal = document.getElementById("image").value;
                    let val = oldVal ? oldVal + ',' + result.info.secure_url : result.info.secure_url;
                    document.getElementById("image").value = val;                  
                }
            })
        cloudinaryWidget.open();
    }

    var openImageUploader2 = function() {
        var cloudinaryWidget = cloudinary.createUploadWidget({
                cloudName: 'ether-tech',
                uploadPreset: 'trk_general'
            },
            (error, result) => {
                if (!error && result && result.event === "success") {
                    // document.getElementById("default_image").src = result.info.secure_url;
                    // document.getElementById("image").value = result.info.secure_url;

                    let oldVal = document.getElementById("usage_visual").value;                   
                    let val = oldVal ? oldVal + ',' + result.info.secure_url : result.info.secure_url;
                    document.getElementById("usage_visual").value = val;                    
                }
            })
        cloudinaryWidget.open();
    }
</script>

@endpush

@push('custom-scripts')
<!-- Custom js here -->
@endpush
<script>

</script>