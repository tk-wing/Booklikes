@extends('layouts.master')
@section('title', 'パスワード再設定')
@section('content')
<div class="fh5co-narrow-content text-center">
    <legend>パスワードの再設定</legend>
    @if(!$expiry)
        <form method="post" class="form-horizontal">
            @csrf {{ method_field('patch') }}
            <fieldset>
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
                <button type="submit" class="btn btn-success">パスワードを再設定する</button>
            </fieldset>
        </form>
    @else
        <p class="text-danger">パスワード再設定の有効期限が切れています。下記より再度手続きください。</p>
        <a href="{{ url('/password/reset/create') }}"><button type="button" class="btn btn-info">パスワード再設定</button></a>


    @endif
</div>
@endsection
