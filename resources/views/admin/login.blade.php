<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin/style2.css ')}}">

    <link rel="stylesheet" href=" {{ asset('css/admin/owl.carousel.min.css ')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=" {{ asset('css/admin/bootstrap.min.css ')}}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/admin/style.css ')}}">

    <title>Login User</title>
  </head>
  <body>



  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/undraw_remotely_2j6y.svg')}}" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>{{__('Sign In')}}</h3>
              <p class="mb-4">{{__('Management page for Admin')}}</p>
            </div>
            <form action="{{route('performLoginAdmin')}}" method="post">
            @csrf

              <div class="form-group first">
                <label for="user_name">{{__('Username')}}</label>
                <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name" name="user_name" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>
                @error('user_name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror

              </div>
              <div class="form-group last mb-4">
                <label for="password">{{__('Password')}}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">{{__('Remember me')}}</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">{{__('Forgot Password')}}</a></span>
              </div>

              <button type="submit" class="btn btn-block btn-primary">
                {{ __('Login') }}
              </button>


            </form>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>


    <script src="{{ asset('js/admin/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('js/admin/popper.min.js ')}}"></script>
    <script src="{{ asset('js/admin/bootstrap.min.js ')}}"></script>
    <script src="{{ asset('js/admin/main.js ')}}"></script>
  </body>
</html>
