@extends('backend.layouts.app')

@section('content')
  <style>
    body {
      background: linear-gradient(135deg, #74ebd5, #ACB6E5);

     
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.15);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 16px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      padding: 40px 30px;
      max-width: 400px;
      width: 100%;
      color: #fff;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
    }

    .form-control {
      background-color: rgba(255, 255, 255, 0.1);
      border: none;
      color: #fff;
    }

    .form-control:focus {
      background-color: rgba(255, 255, 255, 0.2);
      border: none;
      color: #fff;
      box-shadow: none;
    }

    .form-label {
      color: #fff;
    }

    .btn-primary {
      background-color: #4b6cb7;
      border: none;
      border-radius: 30px;
    }

    .btn-primary:hover {
      background-color: #3a55a1;
    }

    a {
      color: #e0e0e0;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>

 <div class="container">
    <div class="row">
        <div class="col-lg-4 m-auto">
            <div class="login-container">
                <h2>Admin Login</h2>
               
                @include('backend.partials.message.error')
                
                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="email" class="form-label">Email address</label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
              
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
              
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                    </div>
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary"> {{ __('Login') }}</button>
                    </div>
              
                    <div class="mt-3 text-center">
                      @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>

@endsection
