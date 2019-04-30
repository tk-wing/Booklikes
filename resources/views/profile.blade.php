@extends('layouts.master')
@section('title', 'プロフィール編集')
@section('script')
    @include('parts.img_script')
@endsection
@section('content')
<div class="fh5co-narrow-content text-center">
    <legend>{{ auth()->user()->name }}さんのプロフィール編集</legend>
    <div class="edit_wrapper">
        <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4" style="padding-left: 200px;">
                    @if(auth()->user()->img_name)
                        <img id="img1" src="{{ asset("storage/user_images").'/'.auth()->user()->img_name }}" style="width:160px;height:160px;border-radius: 50%;"><br>
                    @else
                        <img id="img1" src="{{ asset("img/profile_img_default.png") }}" style="width:160px;height:160px;border-radius: 50%;"><br>
                    @endif
                    <label>
                        <span class="filelabel" title="ファイルを選択">
                            選択
                        </span>
                        <input type="file" class="filesend" id="filesend" name="img_name" accept="image/*" style="display: none;">
                    </label>
                </div>

                <div class="col-md-8 text-left">
                    <div class="form-group">
                        <label class="col-md-3 control-label">お名前</label>
                        <div class="col-md-6">
                            <input id="name" name="name" type="text" placeholder="お名前" value="{{ auth()->user()->name }}" class="form-control input-md">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">ニックネーム(任意)</label>
                        <div class="col-md-6">
                            <input id="nickname" name="nickname" type="text" placeholder="ニックネーム(任意)" value="" class="form-control input-md">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">好きな本のジャンル<br>(任意)</label>
                        <div class="col-md-6">
                            <select id="category_id" name="category_id" class="form-control">
                                <option value="">選択してください</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">自己紹介＆メッセージ(任意)</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="comment" name="comment" placeholder="自己紹介＆メッセージ(任意)" style="height: 200px;"></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-success">完了</button>
        </form>
    </div>
</div>
@endsection
