@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
@endsection
@section('content')
    <livewire:profile-component :filter="$id"></livewire:profile-component>
@endsection