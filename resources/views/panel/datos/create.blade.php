@extends('panel.base')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="content">
            <button class="btn btn-info btn-sm" id="btnAgregarDatos" onclick="fnmodalDatos()">Add Data</button>
            <br>
            <table class="table table-bordered table-striped">
                <thead>
                    <th>id</th>
                    <th>actions</th>
                    <th>description</th>
                    <th>names</th>
                    <th>Detalles</th>
                    <th>photo</th>
                    <th>status</th>
                </thead>
                <tbody>
                    @foreach ($datos as $d)
                        <tr>
                            <td>{{$d->id}}</td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm btnEdit"><i class="fas fa-edit"></i></a>
                                <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                            </td>
                            <td>{{$d->description}}</td>
                            <td>{{$d->names}}</td>
                            <td>
                                {!! $d->detalles!!}
                            </td>
                            <td><img src="{{asset('storage/datos/'.$d->photo)}}" style="height: 100px;" alt=""></td>
                            <td>{{$d->status}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



{{-- Nuevo Registro --}}
<div class="modal fade modal-xl" id="modalDatos" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card mb-0 user-card">
            <div class="modal-header">
                <h5>New Register</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('panel.datos.store')}}" method="POST" enctype="multipart/form-data">@csrf
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="names" required>
                    <label for="">Description</label>
                    <textarea type="text" class="form-control" name="description" required></textarea>
                    <label for="">Photo</label>
                    <input type="file" class="form-control" name="photo" required>
                    <label for="">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    <label for="">Detalles</label>
                    <textarea type="text" name="detalles" id="detalles" class="form-control"></textarea>
                    
                    <br>
                    <button class="btn btn-primary" type="submit" >Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End Nuevo Registro --}}

{{-- Editar Registro --}}
<div class="modal fade modal-xl" id="modalUpdateDatos" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card mb-0 user-card">
            <div class="modal-header">
                <h5>Update Register</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('panel.datos.update')}}" method="POST" enctype="multipart/form-data">@csrf
                    <input type="text" id="id" name="id" hidden readonly>
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="names" id="names" required>
                    <label for="">Description</label>
                    <textarea type="text" class="form-control" name="description" id="description" required></textarea>
                    <label for="">Photo</label>
                    <input type="file" class="form-control" name="photo" id="photo">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="status" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    <label for="">Detalles</label>
                    <textarea type="text" name="detalles" id="detalles_update" class="form-control"></textarea>
                    <br>
                    <button class="btn btn-primary" type="submit" >Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End Editar Registro --}}

<script src="../../js/jquery.js"></script>
<script src="https://cdn.tiny.cloud/1/4wya3wjn43w5kzye9wy73hdg6o6fv12cdk8emfpbcztc175m/tinymce/6/tinymce.min.js"></script>

<script>
    
    
    $(document).on("click",".btnEdit",function (e) { 
        e.preventDefault();
        
        fila = $(this).closest("tr");
        id = (fila).find('td:eq(0)').text();
        
        $.ajax({
            type: "GET",
            url: "/panel/datos/edit/"+id,
            dataType: "json",
            success: function (response) {
                $("#id").val(response.data['id']);
                $("#names").val(response.data['names']);
                $("#description").val(response.data['description']);
                $("#status").val(response.data['status']).change();
                $("#detalles_update").val(response.data['detalles']);
                ejecutartinymce('#detalles_update');
            }
        });
        
        $("#modalUpdateDatos").modal('show');
    });
    
    function fnmodalDatos() { 
        // ejecutartinymce('#detalles');
        $("#modalDatos").modal('show');
    }

</script>
<script type="text/javascript">

    $(document).ready(function() {
        ejecutartinymce('#detalles');
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