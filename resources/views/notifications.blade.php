@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/notifications.css')}}">
@endsection
@section('content')
    <div class="container mt-5">
        <livewire:notification-component></livewire:notification-component>
    </div>
@endsection