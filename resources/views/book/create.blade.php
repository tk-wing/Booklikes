@extends('layouts.master')
@section('title', '書籍投稿')
@section('script')
    @include('parts.img_script')
@endsection
@section('content')
    <div class="fh5co-narrow-content text-center">
        <legend>おすすめ書籍を投稿する</legend>
        <div class="edit_wrapper">
            <form method="post" action="{{ url('/book') }}" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @include('parts.book.form', [
                    'update' => false,
                    'img_name' => '',
                    'title' => '',
                    'categoryId' => '',
                    'comment' => '',
                ])
            </form>
      </div>
@endsection
