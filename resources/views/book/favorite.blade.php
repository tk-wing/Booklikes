@extends('layouts.master')
@section('title', 'FavoriteBooks')
@section('content')
<div class="fh5co-narrow-content">
    <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Favorite Books</h2>
    @include('parts.dropdown')
    <form method="get" class="form-horizontal">
        @include('parts.search')
    </form>
    @include('parts.book.card', [
        'editable' => false,
        'feed' => true,
        'removableFromBookshelf' => false,
        'add' => true,
        'paginate' => true,
    ])
</div>
@endsection
