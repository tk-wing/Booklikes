@extends('layouts.master')
@section('title', 'パスワード再設定')
@section('content')
<div class="fh5co-narrow-content text-center">
    <form method="post" class="form-horizontal">
        @csrf
        <fieldset>
            <legend>パスワードの再設定</legend>
            <div class="form-group">
                <label class="col-md-4 control-label" for="input-email">メールアドレス</label>
                <div class="col-md-4">
                    <input id="input-email" name="email" type="text" placeholder="メールアドレス" class="form-control input-md {{ $errors->has('email') ? 'is-invalid' : '' }}">
                    <ul class="invalid-feedback" style="list-style-type: none">
                        @foreach($errors->get('email') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">メールを送信する</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection
