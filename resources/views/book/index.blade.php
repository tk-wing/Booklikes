@extends('layouts.master')
@section('title', 'MyBooks')
@section('content')

<div class="fh5co-narrow-content">
    <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">My Books</h2>
    @include('parts.card', [
        'editable' => true,
        'feed' => false,
    ])
</div>
@endsection
