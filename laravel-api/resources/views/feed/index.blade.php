@extends('layouts.master')
@section('title', 'AllBooks')
@section('content')

<div class="fh5co-narrow-content">
    <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">All Books</h2>
    <form method="get" class="form-horizontal">
        @include('parts.search')
    </form>
    @include('parts.book.card', [
        'editable' => false,
        'feed' => true,
        'removableFromBookshelf' => false,
        'add' => 'ture',
        'paginate' => true,
    ])
</div>
@endsection
