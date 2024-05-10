@extends('panel.base')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="content">
                @if ($id_datos)
                    <button class="btn btn-info btn-sm" onclick="fnmodalCertificates()">Add Certificates</button>
                @else
                    <h6>No data or try enable a data register</h6>
                @endif
                <br>
                <br> 
               
               
                        @foreach ($certificates as $cert)
                            
                        <div class="d-flex justify-content-center">
                            <div class="card" style="width: 97%">
                              <div class="card-header">
                                {{$cert->institute}}
                                <img src="{{asset('storage/logos/'.$cert->logo)}}" class="img-fluid rounded-start" style="padding: 10px 10px;width:50px" alt="...">

                                <button class="btn btn-warning btn btn-sm" onclick="fnEditar({{$cert->id}})"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn btn-sm" onclick="fnEliminar({{$cert->id}})"> <i class="fas fa-trash "></i></button>
                                <p class="d-inline-block">Orden: {{$cert->orden}}</p>
                              </div>
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-8">
                                    <h5 class="card-title">{{$cert->title}}</h5>
                                    <h6>{{$cert->date}}</h6>
                                    {!! $cert->description!!}
                                  </div>
                                  <div class="col-4">
                                    <img src="{{asset('storage/files/'.$cert->file)}}" class="img-fluid rounded-start" style="padding: 10px 10px;width:200px" alt="...">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        
                          <br>

                        @endforeach
               
            </div>
        </div>
    </div>


    {{-- Nuevo Registro --}}
    <div class="modal fade modal-xl" id="modalCertificates" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card mb-0 user-card">
                <div class="modal-header">
                    <h5>New Certificate</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('panel.certificates.store')}}" method="POST" enctype="multipart/form-data">@csrf
                        <input type="text" id="id_datos" name="id_datos" value="{{$id_datos}}" hidden readonly>
                        <label for="">School</label>
                        <input type="text" class="form-control" name="institute" required>
                        <label for="">Title</label>
                        <textarea type="text" class="form-control" name="title" required></textarea>
                        <label for="">Date</label>
                        <input type="text" class="form-control" name="date" required>
                        <label for="">Logo</label>
                        <input type="file" class="form-control" name="logo">
                        <label for="">Certificate</label>
                        <input type="file" class="form-control" name="file">
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
    <div class="modal fade modal-xl" id="modalUpdateCertificates" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card mb-0 user-card">
                <div class="modal-header">
                    <h5>Update Register</h5>
                </div>
                <div class="modal-body">
                    
                    <form action="{{route('panel.certificates.update')}}" method="POST" enctype="multipart/form-data">@csrf
                        <input type="text" id="id" name="id" readonly hidden>
                        <label for="">School</label>
                        <input type="text" class="form-control" name="institute" id="institute" required>
                        <label for="">Title</label>
                        <textarea type="text" class="form-control" name="title" id="title" required></textarea>
                        <label for="">Date</label>
                        <input type="text" class="form-control" name="date" id="date" required>
                        <label for="">Logo</label>
                        <input type="file" class="form-control" name="logo" id="logo">
                        <label for="">Certificate</label>
                        <input type="file" class="form-control" name="file" id="file">
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
                    <h5>Delete Certificate</h5>                    
                </div>
                <div class="modal-body">
                <form action="{{route('panel.certificates.destroy')}}" method="POST">@csrf
                    <input type="text" name="id_certificate" id="id_certificate" hidden readonly>
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
    function fnmodalCertificates() { 
        $("#modalCertificates").modal('show');
    }
    

    
    function fnEditar(id) { 
        $.ajax({
            type: "GET",
            url: "/panel/certificates/edit/"+id,
            dataType: "json",
            success: function (response) {
                $("#id").val(response.data['id']);
                $("#institute").val(response.data['institute']);
                $("#title").val(response.data['title']);
                $("#date").val(response.data['date']);
                $("#orden").val(response.data['orden']);
                $("#description_update").val(response.data['description']);
                ejecutartinymce('#description_update');
            }
        });
        
        $("#modalUpdateCertificates").modal('show');
    }

    function fnEliminar(id) {  
        $("#id_certificate").val(id);
        $("#modalConfirmarEliminar").modal('show');
    };
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

<script>
    $('#dtexperiences').DataTable({
        responsive: true
    });

    // [ New Constructor ]
    var newcs = $('#dtexperiences').DataTable();

    new $.fn.dataTable.Responsive(newcs);
    
</script>
@endsection