@extends('layouts.master')
@section('title', 'プロフィール編集')
@section('script')
    @include('parts.img_script')
@endsection
@section('content')
<div class="fh5co-narrow-content text-center">
    <legend>{{ auth()->user()->name }}さんのプロフィール編集</legend>
    <div class="edit_wrapper">
        <form method="post" action="{{ url("/profile/{$profile->id}") }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf {{ method_field('patch') }}
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
                        <label class="col-md-3 control-label" for="input_name">お名前</label>
                        <div class="col-md-6">
                            <input id="input_name" name="name" type="text" placeholder="お名前" value="{{ auth()->user()->name }}" class="form-control input-md">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="input_nickname">ニックネーム(任意)</label>
                        <div class="col-md-6">
                            <input id="input_nickname" name="nickname" type="text" placeholder="ニックネーム(任意)" value="{{ $profile->nickname }}" class="form-control input-md">
                        </div>
                    </div>

                    <div class="entry form-group">
                        <label class="col-md-3 control-label" for='input_category_id'>好きな本のジャンル<br>(任意)</label>
                        <div class="col-md-6">
                            <select id="input_category_id" name="category_id[]" class="form-control">
                                <option disabled selected>選択してください</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="input_comment">自己紹介＆メッセージ(任意)</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="input_comment" name="comment" placeholder="自己紹介＆メッセージ(任意)" style="height: 200px;">{{ $profile->comment }}</textarea>
                        </div>
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-success">完了</button>
        </form>
    </div>
</div>
@endsection

@section('script_bottom')
<script>
    $(function () {
        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();
            var controlForm = $('.controls'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);
            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<i class="fas fa-minus"></i>');
        }).on('click', '.btn-remove', function (e) {
            $(this).parents('.entry:first').remove();
            e.preventDefault();

            return false;
        });
    });
</script>
@endsection
