@extends('layouts.master')
@section('title', 'Booklikes')
@section('content')
    @if(auth()->user())
        @include('parts.img_script')
        @include('home.mypage')
    @else
        @include('home.welcome')
    @endif
@endsection
