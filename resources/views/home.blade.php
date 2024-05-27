@extends('base')
@section('content')
<style>
   .background-img {
      width: 100%; /* Ajusta el ancho de la imagen de fondo al contenedor */
      height: 100%; /* Mantén la proporción de la imagen */
      display: block; /* Asegura que la imagen ocupe todo el espacio del contenedor */
  }

  .overlay-container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5); /* Fondo semitransparente negro para oscurecer la imagen */
      z-index: 1; /* Asegura que el pseudo-elemento esté encima de la imagen de fondo */
  }
    .overlay-img {
      width: 20%;
      height: 82%; /* Asegura que la imagen sea cuadrada para que border-radius funcione correctamente */
      position: absolute;
      top: 10px; /* Ajusta según la posición deseada */
      left: 10px; /* Ajusta según la posición deseada */
      z-index: 2; /* Asegura que la imagen superpuesta esté encima del pseudo-elemento */
      border-radius: 50%; /* Hace que la imagen tenga bordes circulares */
      
  }
</style>

  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb" style="place-content: center;">
      <li class="breadcrumb-item active" aria-current="page">/ Home</li>
      
    </ol>
  </nav>


  {{-- Card --}}
  <div class="row" style="width: 95%;padding-left:5%">
    
    <div class="col-md-8">
      <div class="d-flex justify-content-center">
        <div class="card overlay-container" style="width: 100%; position: relative;">
            <img src="../../../img/banner_fondo.jpeg" alt="Fondo" class="background-img">
            <div class="row g-0">
                @if ($datos)
                    <img src="{{ asset('storage/datos/'.$datos->photo) }}" class="img-fluid overlay-img" alt="...">
                @endif
            </div>
        </div>
      </div>
    </div>


    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">
            @if ($datos)
              {{$datos->names}}
            @endif
          </h5>
          <p class="card-text">
            @if ($datos)
              {{$datos->description}}
            @endif
          </p>
          <p>
            @if ($datos)
              {!! $datos['detalles'] !!}
            @endif
          </p>
        </div>

      </div>
    </div>
  </div>
  
  {{-- End Card --}}


      <br>

{{-- Experiencia --}}
<div class="d-flex justify-content-center">
  <h4>Work experience <img src="../icons/maleta.png" style="width: 50px" alt=""></h4>
</div>

@if ($datos)
  @foreach ($experiences as $e)
  <div class="d-flex justify-content-center">
    <div class="card" style="width: 97%">
      <div class="card-header">
          {{$e->place}}
      </div>
      <div class="card-body">
          <h5 class="card-title">{{$e->position}}</h5>
          <h6>{{$e->date}}</h6>
          <p class="card-text">
            {!! $e['description'] !!}
          </p>
      </div>
    </div>
  </div>
  <br>
  @endforeach
@endif


<br>



@endsection