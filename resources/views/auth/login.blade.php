@extends('layouts.master')
@section('title', 'サインアップ')
@section('content')
<div class="fh5co-narrow-content text-center">
    <form method="post" class="form-horizontal">
        @csrf
        <fieldset>
            <legend>サインイン</legend>
            @if (old('email'))
                <p class='error_msg'>{{ __('auth.failed')}}</p>
            @endif
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
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">ログイン</button>
                </div>
            </div>
        </fieldset>
    </form>
    <a href="{{ url('/password/reset') }}"><button type="button" class="btn btn-info">パスワードお忘れの方はこちら</button></a>
    </div>
</div>
@endsection
