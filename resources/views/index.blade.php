@extends('layouts.master')
@section('title', 'Booklikes')
@section('content')
    @if(auth()->user())
        @include('home.mypage')
    @else
        @include('home.welcome')
    @endif
@endsection
