@extends('base')
@section('content')

  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb" style="place-content: center;">
      <li class="breadcrumb-item active" aria-current="page">/ <a href="{{route('home')}}">Home</a> / Certificates</li>
      
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



<br>

<div class="d-flex justify-content-center">
<h4>Certifications and recognitions <img src="../icons/certificado.png" alt="" style="width: 50px"></h4>
</div>
<br>

@foreach ($certificates as $cert)
  <div class="d-flex justify-content-center">
    <div class="card" style="width: 97%">
      <div class="card-header">
        {{$cert->institute}}
        <img src="{{asset('storage/logos/'.$cert->logo)}}" class="img-fluid rounded-start" style="padding: 10px 10px;width:50px" alt="...">
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


@endsection