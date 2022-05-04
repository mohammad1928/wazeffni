@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection
@section('content')

    <div class="container">
    
        <livewire:post-component :filter="$filter" ></livewire:post-component>
        
    </div>
    
@endsection