<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alex Vasquez</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
</head>
<body>
    
    {{-- Menu --}}

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid justify-content-center">
          <a class="navbar-brand" href="#">alexiotovv@gmail.com</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('certificates')}}">Certificates</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Download CV</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
      {{-- End Menu --}}

      @yield('content')

    <script src="../../../js/bootstrap.bundle.min.js"></script>
</body>
</html>