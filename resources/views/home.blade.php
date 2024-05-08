@extends('base')
@section('content')

  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb" style="place-content: center;">
      <li class="breadcrumb-item active" aria-current="page">/ Home</li>
      
    </ol>
  </nav>


  {{-- Card --}}
  
  <div class="d-flex justify-content-center">

      <div class="card mb-2" style="width: 97%;">
        <div class="row g-0">
          <div class="col-md-4" style="text-align: center">
            @if ($datos)
              <img src="{{asset('storage/datos/'.$datos->photo)}}" class="img-fluid rounded-start" style="padding: 10px 10px;width:260px" alt="...">
            @endif
          </div>
          <div class="col-md-8">
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