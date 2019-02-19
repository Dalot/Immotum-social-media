@extends('layouts.layout')

@push('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('css/login.css')}}" type="text/css" />
@endpush




  @section('content')
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Login</h3>
                    <p class="subtitle has-text-grey">Please login to proceed.</p>
                    <div class="box">
                        <figure class="avatar">
                            <img src="https://placehold.it/128x128">
                        </figure>
                        <form method="POST" action="{{ route('login') }}">
                             @csrf
                             
                            
                            
                            <div class="field">
                                <label for="">{{ __('E-Mail Address') }}</label>
                                <div class="control">
                                    
                                    <input id="email" type="email" class="input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="field">
                                <label for="">{{ __('Password') }}</label>
                                <div class="control">
                                    
                                <input id="password" type="password" class="input is-medium form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                 @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="field">
                                <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                            </div>
                            <button type="submit" class="button is-block is-info is-large is-fullwidth">{{ __('Login') }}</button>
                            
                            @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </form>
                    </div>
                    <p class="has-text-grey">
                        <a href="/register">Sign Up</a> &nbsp;·&nbsp;
                        <a href="/">Forgot Password</a> &nbsp;·&nbsp;
                        <a href="../">Need Help?</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    
   @endsection
   
@push('scripts')
<script type="text/javascript" src="{{ asset('js/bulma.js') }}"></script>
@endpush
