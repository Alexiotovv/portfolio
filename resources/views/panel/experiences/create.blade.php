@extends('panel.base')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="content">
            @if ($id_datos)
                <button class="btn btn-info btn-sm" id="btnAgregarDatos" onclick="fnmodalExperiences()">Add Experience</button>
            @else
                <h6>No data or try enable a data register</h6>
            @endif
            <br>
            <br>
                        
            @foreach ($experiences as $e)

                <div class="d-flex justify-content-center">
                    <div class="card" style="width: 97%">
                        <div class="card-header">
                            {{$e->place}}
                            
                            <button class="btn btn-warning btn btn-sm" onclick="fnEditar({{$e->id}})"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn btn-sm" onclick="fnEliminar({{$e->id}})"> <i class="fas fa-trash "></i></button>
                            <p class="d-inline-block">Orden: {{$e->orden}}</p>
                        
                        
                        
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$e->position}}</h5>
                            <h6>{{$e->date}}</h6>
                            <p class="card-text">
                            {!! $e->description !!}
                            </p>
                        </div>
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>
</div>


 {{-- Nuevo Registro --}}
 <div class="modal fade modal-xl" id="modalExperiences" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card mb-0 user-card">
            <div class="modal-header">
                <h5>New Work Experience </h5>
            </div>
            <div class="modal-body">
                <form action="{{route('panel.experiences.store')}}" method="POST" enctype="multipart/form-data">@csrf
                    <input type="text" id="id_datos" name="id_datos" value="{{$id_datos}}" hidden readonly>
                    <label for="">Company Name</label>
                    <input type="text" class="form-control" name="place" required>
                    <label for="">Position</label>
                    <textarea type="text" class="form-control" name="position" required></textarea>
                    <label for="">Date</label>
                    <input type="text" class="form-control" name="date" required>
                    <label for="">Order</label>
                    <input type="number" class="form-control" name="orden">
                    <label for="">Description</label>
                    <textarea type="text" class="form-control" name="description" id="description"></textarea>
                    <br>
                    <button class="btn btn-primary" type="submit" >Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End Nuevo Registro --}}

 {{-- Update Registro --}}
 <div class="modal fade modal-xl" id="modalUpdateExperiences" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card mb-0 user-card">
            <div class="modal-header">
                <h5>Update Work Experience</h5>
            </div>
            <div class="modal-body">
                
                <form action="{{route('panel.experiences.update')}}" method="POST" enctype="multipart/form-data">@csrf
                    <input type="text" id="id" name="id" readonly hidden>
                    <label for="">Company Name</label>
                    <input type="text" class="form-control" name="place" id="place" required>
                    <label for="">Position</label>
                    <textarea type="text" class="form-control" name="position" id="position" required></textarea>
                    <label for="">Date</label>
                    <input type="text" class="form-control" name="date" id="date" required>
                    <label for="">Order</label>
                    <input type="number" class="form-control" name="orden" id="orden">
                    <label for="">Description</label>
                    <textarea type="text" class="form-control" name="description_update" id="description_update"></textarea>
                    <br>
                    <button class="btn btn-primary" type="submit" >Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End Update Registro --}}


<div class="modal fade login-modal" id="modalConfirmarEliminar" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card mb-0 user-card">
            <div class="modal-header">
                <h5>Delete Experience</h5>                    
            </div>
            <div class="modal-body">
            <form action="{{route('panel.experiences.destroy')}}" method="POST">@csrf
                <input type="text" name="id_experience" id="id_experience" hidden readonly>
                <h5>Please, confirm to delete.</h5>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Yes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

            </div>
            </form>
        </div>
    </div>
</div>



<script src="../../js/jquery.js"></script>
<script src="https://cdn.tiny.cloud/1/4wya3wjn43w5kzye9wy73hdg6o6fv12cdk8emfpbcztc175m/tinymce/6/tinymce.min.js"></script>
<script>
    function fnmodalExperiences() { 
        $("#modalExperiences").modal('show');
    }
    

    

    function fnEliminar(id) { 
        $("#id_experience").val(id);
        $("#modalConfirmarEliminar").modal('show');

     }
        
    function fnEditar(id) { 

        $.ajax({
            type: "GET",
            url: "/panel/experiences/edit/"+id,
            dataType: "json",
            success: function (response) {
                $("#id").val(response.data['id']);
                $("#place").val(response.data['place']);
                $("#position").val(response.data['position']);
                $("#date").val(response.data['date']);
                $("#orden").val(response.data['orden']);
                $("#description_update").val(response.data['description']);
                ejecutartinymce('#description_update');
            }
        });
        
        $("#modalUpdateExperiences").modal('show');
    }
    
</script>


    
<script type="text/javascript">

    $(document).ready(function() {
        ejecutartinymce('#description');
    });


function ejecutartinymce(id) { 

     tinymce.init({
            selector: id,
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