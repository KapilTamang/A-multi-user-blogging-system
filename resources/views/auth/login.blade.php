@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 5%;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #3490dc; color:#fff;"><i class="fa fa-sign-in" style="font-size: 18px;" aria-hidden="true"></i>&nbsp; {{ __('Login') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><i class="fa fa-envelope" style="color: #3490dc;" aria-hidden="true"></i>&nbsp; {{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><i class="fa fa-key" style="color: #3490dc; aria-hidden="true"></i>&nbsp; {{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="btn-group login-option">
                            <p>Login with :<p>
                            <a class="btn-facebook" href=" {{ route('login.social', 'facebook') }} " style="background-color: #4267b2; color: #fff; font-size: 16px; padding: 5px 10px; margin-left: 15px; margin-right: 10px; border-radius: 3px; text-decoration: none;"><i class="fa fa-facebook-official" aria-hidden="true"></i>&nbsp; Login</a>
                            <a class="btn-google" href=" {{ route('login.social', 'google') }} " style="background-color: #db3236; color: #fff; font-size: 16px; padding: 5px 10px; border-radius: 3px; text-decoration: none;"><i class="fa fa-google" aria-hidden="true"></i>&nbsp; Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
