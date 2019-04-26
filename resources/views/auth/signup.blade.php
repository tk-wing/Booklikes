@extends('layouts.master')
@section('title', 'サインアップ')
@section('script')
	<script>
	$(function(){
	  $('#filesend').change(function(e){
	    //ファイルオブジェクトを取得する
	    var file = e.target.files[0];
	    var reader = new FileReader();

	    //画像でない場合は処理終了
	    if(file.type.indexOf("image") < 0){
	      alert("画像ファイルを指定してください。");
	      return false;
	    }

	    //アップロードした画像を設定する
	    reader.onload = (function(file){
	      return function(e){
	        $("#img1").attr("src", e.target.result);
	        $("#img1").attr("title", file.name);
	      };
	    })(file);
	    reader.readAsDataURL(file);

	  });
	});
	</script>
@endsection
@section('content')
<div class="fh5co-narrow-content text-center">
    <form method="post" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        <fieldset>

        {{-- <legend>新規会員登録</legend> --}}
        {{-- 新規会員登録 --}}
        <legend>{{ __('booklikes.blade.signup') }}</legend>

        <div class="form-group">
            <label class="col-md-4 control-label" for="input-name">お名前</label>
            <div class="col-md-4">
                <input id="input-name" name="name" type="text" placeholder="お名前" value="" class="form-control input-md {{ $errors->has('name') ? 'is-invalid' : '' }}">
                <ul class="invalid-feedback" style="list-style-type: none">
                    @foreach($errors->get('name') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="input-email">メールアドレス</label>
            <div class="col-md-4">
                <input id="input-email" name="email" type="text" placeholder="メールアドレス" value="" class="form-control input-md {{ $errors->has('email') ? 'is-invalid' : '' }}">
                <ul class="invalid-feedback" style="list-style-type: none">
                    @foreach($errors->get('email') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="input-password">パスワード(4~16文字の英数字)</label>
            <div class="col-md-4">
                <input id="input-password" name="password" type="password" placeholder="パスワード" class="form-control input-md {{ $errors->has('password') ? 'is-invalid' : '' }}">
                <ul class="invalid-feedback" style="list-style-type: none">
                    @foreach($errors->get('password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="input-password_confirmation">パスワード確認</label>
            <div class="col-md-4">
                <input id="input-password_confirmation" name="password_confirmation" type="password" placeholder="パスワード確認" class="form-control input-md">
            </div>
        </div>

        <div class="form-group">
            <img id="img1" src="https://placehold.jp/160x160.png" style="width:160px;height:160px;border-radius: 50%;"><br>
            <label>
                <span class="filelabel" title="ファイルを選択">
                選択
                </span>
                <input type="file" class="filesend" id="filesend" name="img_name" accept="image/*" style="display: none;">
            </label><br>
    </div>

        <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4">
                <button type="submit" class="btn btn-success">登録する</button>
            </div>
        </div>

        </fieldset>
    </form>
</div>
@endsection
