@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">

@endsection
@section('content')
<div class="container mt-5 d-flex justify-content-center">
      
        <div style="width:500px;max-width:500px" class="bg-white rounded login">
            <div class="w-100 d-flex flex-column p-3">
                <div class="logo d-flex justify-content-center">
                    <img src="{{asset('logos/logo.png')}}" style="width:200px;height:200px">
                    <h4 class="text-center text-white signup-text">Login</h4>
                </div>
                <div class="form-group">
                    <div class="input-group d-flex justify-content-center">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                              <img src="https://img.icons8.com/color/50/000000/google-logo.png" class="ml-1" width="27" height="28" class="mr-2"/>  
                            </span>
                        </div>
                        <a href="/auth/google" class="btn btn-primary w-50" style="background: #4c8bf5">Sign in With Google </a>
                    </div>
                </div>
                <div class="form-group">
                   <div class="input-group d-flex justify-content-center">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                              <img src="https://img.icons8.com/ios-glyphs/50/000000/github.png" width="30" height="28" />  
                            </span>
                        </div>
                        <a href="/auth/github" class="btn btn-dark w-50">Sign in With Github</a>
                    </div>
                    
                </div>
                <p class="text-center text-white mt-3 mb-4"><span class="or">OR</span></p>
                <div class="w-100">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                         <div class="row mb-4 d-flex justify-content-center">
                            <input id="email" type="email" class="w-75 form-control @error('email') is-invalid @enderror login-field" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Your Email">
                            @error('email')
                                <p class="text-left w-75 error-message">{{$message}}</p>
                            @enderror
                         </div>
                         <div class="row d-flex justify-content-center">
                            <input id="password" type="password" class="w-75 form-control @error('password') is-invalid @enderror login-field" name="password" required autocomplete="current-password" placeholder="Enter Your Password">
                            @error('password')
                                <p class="text-left w-75 error-message">{{$message}}</p>
                            @enderror
                         </div>
                         <div class="row mt-5 d-flex justify-content-center">
                            <button type="submit" class="w-75 btn btn-primary form-control text-white login-field d-flex align-items-center justify-content-center">
                                    {{ __('Login') }}
                            </button>
                         </div>
                    </form>
                    <small class="d-block ml-5 mt-3 text-white">Don't have account ? <a href="/register">Signup</a></small>
                    <p class="text-center mt-5 text-white" style="font-size:16px">Developed By <a href="#">Mohammad Al-Mahmoud</a></p>
                </div>

            </div>
            
            
    </div>
@endsection
