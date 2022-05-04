@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection
@section('content')
    <div class="container home">
    
        @livewire('post-component') 
          

    </div>
    
@endsection