@extends('layouts.layout')

@push('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('css/login.css')}}" type="text/css" />
@endpush




  @section('content')
    <section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Register</h3>
                    <p class="subtitle has-text-grey">Please login to proceed.</p>
                    <div class="box">
                        <figure class="avatar">
                            <img src="https://placehold.it/128x128">
                        </figure>
                        <form method="POST" action="{{ route('register') }}">
                             @csrf
                             
                            
                            
                            <div class="field">
                                <label for="">{{ __('Name') }}</label>
                                <div class="control">
                                    
                                    <input id="name" type="text" class="input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="field">
                                <label for="">{{ __('Email Address') }}</label>
                                <div class="control">
                                    
                                    <input id="name" type="text" class="input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

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
                                    
                                    <input id="name" type="password" class="input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="field">
                                <label for="">{{ __('Confirm Password') }}</label>
                                <div class="control">
                                    
                                    <input id="name" type="password" class="input" name="password_confirmation" required>

                                </div>
                            </div>
                            <button type="submit" class="button is-block is-info is-large is-fullwidth">{{ __('Register') }}</button>
                     
                    
                        </form>
                    </div>
                  
                </div>
            </div>
        </div>
    </section>
    
   @endsection
   
@push('scripts')
<script type="text/javascript" src="{{ asset('js/bulma.js') }}"></script>
@endpush
