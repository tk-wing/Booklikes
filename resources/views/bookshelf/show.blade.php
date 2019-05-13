@extends('layouts.master')
@section('title', 'MyBookshelves')
@section('content')
<div class="fh5co-narrow-content">
    <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">My Bookshelves / {{ $bookshelf->title }}</h2>
    @include('parts.dropdown')
    <form method="get" class="form-horizontal">
        @include('parts.search')
    </form>
    @include('parts.book.card', [
        'editable' => false,
        'feed' => true,
        'removableFromBookshelf' => true,
        'add' => false,
        'paginate' => true,
    ])
</div>
@endsection
