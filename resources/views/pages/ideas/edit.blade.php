@extends('layouts.app')

@push('header-script')
<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
@endpush

@section('content')

<div class="container">
    <h2>Edit Idea</h2>
    <br>
    <form class='form-horizontal' method="POST" action="{{ route('ideas.update', $idea->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="form-group form-inline">
                    <label>Type</label>
                    <select name="type" class="form-control selectpicker ml-4" onchange="makeReadOnly(this.value);">
                        <option value="">Select Type</option>
                        <option value="1" {{ $idea->ideaProduct->type == 1 ? 'selected' : '' }} >Input</option>
                        <option value="2" {{ $idea->ideaProduct->type == 2 ? 'selected' : '' }} >End Product</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group form-inline">
                    <label>Input</label>
                    <select name="option_one" class="form-control selectpicker ml-4" id="input" {{ $idea->ideaProduct->type != 1 ? 'disabled' : '' }}>
                        <option value="">Not Selected</option>
                        @foreach ($sources as $source)
                            <option {{ $idea->product == $source->id ? 'selected' : '' }} value="{{$source->id}}">{{$source->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group form-inline">
                    <label>End Product</label>
                    <select name="option_two" class="form-control selectpicker ml-4" id="product" {{ $idea->ideaProduct->type != 2 ? 'disabled' : '' }}>
                        <option value="">Not Selected</option>
                        @foreach ($outcomes as $outcome)
                            <option {{ $idea->product == $outcome->id ? 'selected' : '' }} value="{{$outcome->id}}">{{$outcome->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" name="title" type="text" value="{{ $idea->title }}">
                </div>
            </div>
            <div class="col-6">
                <label>Image</label>
                <input name="image" class="form-control" id="photo" style="display: none;" type="text" value="{{ !empty($idea->image) ? $idea->image : '' }}">
                <img id="upload_widget_1" class="upload-button" src="{{ !empty($idea->image) ? $idea->image : '/assets/img/upload.png' }}" style="max-width:150px; max-height:150px; cursor:pointer;" onclick="openImageUploader()">
            </div>
            <div class="col-12">
                <label>Description</label>
                <textarea class="form-control" name="description" id="description" rows="4" cols="50">{{$idea->description}}</textarea>
            </div>
        </div>

        <button id="save" type="submit" class="btn btn-primary text-center mt-1" @click="save">Save</button>
    </form>
</div>
@endsection

@push('plugin-scripts')
<!-- Plugin js import here -->
<script>
    CKEDITOR.replace( 'description');

    var openImageUploader = function() {
        var cloudinaryWidget = cloudinary.createUploadWidget({
                cloudName: 'augmenta',
                uploadPreset: 'temp_bopinc',
                maxImageFileSize: 1000000
            },
            (error, result) => {
                if (!error && result && result.event === "success") {
                    let oldVal = document.getElementById("photo").value;
                    let val = oldVal ? oldVal + ',' + result.info.secure_url : result.info.secure_url;
                    document.getElementById("photo").value = result.info.secure_url;
                    document.getElementById("upload_widget_1").src = result.info.secure_url;
                }
            })
        cloudinaryWidget.open();
    }

    function makeReadOnly(value)
    {
        if (value == 2) {
            document.getElementById('input').disabled = true;
            document.getElementById('product').disabled = false;
        } else if (value == 1) {
            document.getElementById('product').disabled = true;
            document.getElementById('input').disabled = false;
        } else {
            document.getElementById('input').disabled = true;
            document.getElementById('product').disabled = true;
        }
    }
</script>
@endpush
