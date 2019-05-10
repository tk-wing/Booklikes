@extends('layouts.master')
@section('title', 'Books')
@section('content')

<div class="fh5co-narrow-content">
    <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">直近の投稿</h2>
    @include('parts.card', [
        'editable' => false,
        'feed' => false,
        'paginate' => false,
    ])
</div>
@endsection
