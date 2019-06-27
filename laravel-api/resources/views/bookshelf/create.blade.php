@extends('layouts.master')
@section('title', '本棚作成')
@section('script')
    @include('parts.img_script')
@endsection
@section('content')
    <div class="fh5co-narrow-content text-center">
        <legend>本棚を作成する</legend>
            <form method="post" action="{{ url('/bookshelf') }}" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @include('parts.bookshelf.form', [
                    'title' => '',
                    'categoryId' => '',
                    'comment' => '',
                ])
            </form>
@endsection

