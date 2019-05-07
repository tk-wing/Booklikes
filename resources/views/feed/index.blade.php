@extends('layouts.master')
@section('title', 'AllBooks')
@section('content')

<div class="fh5co-narrow-content">
    <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">All Books</h2>
    @include('parts.card', [
        'editable' => false,
        'feed' => true,
    ])
</div>
@endsection
