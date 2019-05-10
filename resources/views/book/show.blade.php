@extends('layouts.master')
@section('title', '投稿編集')
@section('script')
    @include('parts.img_script')
@endsection
@section('content')
    <div class="fh5co-narrow-content text-center">
        <legend>投稿を編集する</legend>
        <div class="edit_wrapper">
            <form method="post" action="{{ url("/book/{$book->id}") }}" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                {{ method_field('patch') }}
                @include('parts.book.form', [
                    'update' => true,
                    'img_name' => $book->img_name,
                    'title' => $book->title,
                    'categoryId' => $book->category_id,
                    'comment' => $book->comment,
                ])
            </form>
      </div>
@endsection
