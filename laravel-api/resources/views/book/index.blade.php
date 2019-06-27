@extends('layouts.master')
@section('title', 'MyBooks')
@section('content')
<div class="fh5co-narrow-content">
    <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">My Books</h2>
    @include('parts.dropdown')
    <form method="get" class="form-horizontal">
        @include('parts.search')
    </form>
    @include('parts.book.card', [
        'editable' => true,
        'feed' => false,
        'removableFromBookshelf' => false,
        'add' => true,
        'paginate' => true,
    ])
</div>
@endsection
