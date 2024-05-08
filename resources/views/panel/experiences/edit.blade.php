@extends('panel.base')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="content">
            {{-- Update Registro --}}
            <h5>Update Register</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('panel.experiences.update')}}" method="POST" enctype="multipart/form-data">@csrf
                        <input type="text" id="id" name="id" value="{{$exp->id}}" readonly hidden>

                        <label for="">Company Name</label>
                        <input type="text" class="form-control" name="place" id="place" value="{{$exp->place}}" required>
                        <label for="">Position</label>
                        <input type="text" class="form-control" name="position" id="position" value="{{$exp->position}}" required>
                        <label for="">Date</label>
                        <input type="text" class="form-control" name="date" id="date" value="{{$exp->date}}" required>
                        <label for="">Description</label>
                        <textarea type="text" class="form-control" name="description" id="description">{{$exp->description}}</textarea>
                        <br>
                        <button class="btn btn-primary" type="submit" >Save</button>
                    </form>
                </div>
            </div>
            {{-- End Update Registro --}}
        </div>
    </div>
</div>


<script src="../../../js/jquery.js"></script>
<script src="https://cdn.tiny.cloud/1/4wya3wjn43w5kzye9wy73hdg6o6fv12cdk8emfpbcztc175m/tinymce/6/tinymce.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
        ejecutartinymce();
});


function ejecutartinymce() { 

     tinymce.init({
            selector: '#description',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            // toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            language: 'es',
            // enable title field in the Image dialog
            image_title: true, 
            // enable automatic uploads of images represented by blob or data URIs
            automatic_uploads: true,
            // add custom filepicker only to Image dialog
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.onchange = function() {
            var file = this.files[0];
            var reader = new FileReader();
            
            reader.onload = function () {
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);

                // call the callback and populate the Title field with the file name
                cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
            };
            
            input.click();
        }
        });
 }

   
</script>

@endsection