@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">

@endsection
@section('content')
<div class="container mt-5 d-flex justify-content-center">
      
<div class="container mt-5 d-flex justify-content-center">
      
      <div style="width:600px;max-width:600px" class="bg-white rounded login">
          <div class="w-100 d-flex flex-column p-3">
              <div class="logo d-flex justify-content-center">
                  <img src="{{asset('logos/logo.png')}}" style="width:200px;height:200px">
                  <h4 class="text-center text-white signup-text">Signup</h4>
              </div>
              
              <div class="w-100">
                  <form method="POST" action="{{ route('register') }}">
                      @csrf
                       <div class="row mb-4">
                          <div class="col-md-6 mb-3">
                          <label for="fname" class="text-white">First Name</label>
                              <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="Enter Your First Name">
                              @error('first_name')
                                  <p class="text-left error-message">{{$message}}</p>
                              @enderror
                          </div>
                          <div class="col-md-6 mb-3">
                          <label for="lname" class="text-white">Last Name</label>
                              <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="Enter Your Last Name">
                              @error('last_name')
                                  <p class="text-left error-message">{{$message}}</p>
                              @enderror
                          </div>
                          <div class="col-md-12 mb-3">
                              <label for="gender" class="text-white">Gender</label>
                              <select name="gender" id="gender" class="form-control">
                                  <option disable>Gender</option>
                                  <option value="male">Male</option>
                                  <option value="female">Female</option>
                              </select>
                              @error('gender')
                                  <p class="text-left error-message">{{$message}}</p>
                              @enderror
                          </div>
                          <div class="col-md-12 mb-3">
                              <label for="birth_date" class="text-white">Birth Date</label>
                              <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required autocomplete="birth_date" autofocus>
                              @error('birth_date')
                                  <p class="text-left error-message">{{$message}}</p>
                              @enderror
                          </div>
                          <div class="col-md-12 mb-3">
                          <label for="email" class="text-white">Emil</label>
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Your Email">
                              @error('email')
                                  <p class="text-left error-message">{{$message}}</p>
                              @enderror
                          </div>
                          <div class="col-md-12 mb-3">
                              <label for="password" class="text-white">Password</label>
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter Your Password">
                              @error('password')
                                  <p class="text-left error-message">{{$message}}</p>
                              @enderror
                          </div>
                          <div class="col-md-12 mb-3">
                              <label for="password-confirm" class="text-white">Confirm Password</label>
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Enter Your Password Again">
                           </div>
                          <div class="col-md-12">
                              <button type="submit" class="btn btn-primary form-control mt-5">
                                      {{ __('Signup') }}
                              </button>
                          </div>
                       </div>
                  </form>
                  <small class="d-block  mt-3 text-white">You have account ? <a href="/login">Login</a></small>
                  <p class="text-center mt-5 text-white" style="font-size:16px">Developed By <a href="#">Mohammad Al-Mahmoud</a></p>
              </div>

          </div>
          
          
  </div>



</div>
@endsection
