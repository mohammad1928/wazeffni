@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/company.css')}}">
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection
@section('content')
    <div class="container mt-5">
    
        <livewire:company-component :myId="$id"></livewire:company-component>
          

    </div>
    
@endsection