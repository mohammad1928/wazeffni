@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection
@section('content')
    <div class="container mt-5">
    
        <livewire:post-component :presents="$presents"></livewire:post-component>
          

    </div>
    
@endsection