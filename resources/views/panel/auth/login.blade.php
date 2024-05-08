<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../assets/fonts/tabler-icons.min.css" >
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="../../../assets/fonts/feather.css" >
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="../../../assets/fonts/fontawesome.css" >
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="../../../assets/fonts/material.css" >
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="../../../assets/css/style.css" id="main-style-link" >
    <link rel="stylesheet" href="../../../assets/css/style-preset.css" >

    <title>Login</title>
</head>
<body>
    

    <div class="auth-main v1">
        <div class="auth-wrapper">
            <div class="auth-form">
                <div class="card my-5">
                  <div class="card-body">
                    <div class="text-center">
                      <h4 class="f-w-500 mb-1">Login with your email</h4>
                    </div>
                    <form action="{{route('login')}}" method="POST">@csrf
                        <div class="mb-3">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email Address">
                        </div>
                        <div class="mb-3">
                        <input type="password" name="password" class="form-control" id="floatingInput1" placeholder="Password">
                        </div>
                        <div class="d-flex mt-1 justify-content-between align-items-center">
                        <div class="form-check">
                            {{-- <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked=""> --}}
                            {{-- <label class="form-check-label text-muted" for="customCheckc1">Remember me?</label> --}}
                        </div>
                        {{-- <a href="forgot-password-v1.html"><h6 class="f-w-400 mb-0">Forgot Password?</h6></a> --}}
                        </div>
                        <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>