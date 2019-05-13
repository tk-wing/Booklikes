@extends('layouts.master')
@section('title', 'MyBookshelves')
@section('content')
<div class="fh5co-narrow-content">
    <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">My Bookshelves</h2>
    @include('parts.dropdown')
    @include('parts.bookshelf.card')
</div>
@endsection
