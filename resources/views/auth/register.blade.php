@extends('layouts.app')

@section('content')
<div class="login_01">
    <div class="container login_register">
        <div class="logo_01">
            <img src="h_img/top.png">
        </div>
        <div class="text-center font_css">
            <p>
                ユーザーを新しく登録します。<br>
                名前、メールアドレス、パスワードを入力してください。
            </p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-2">
                        <input id="name" type="text" placeholder="名前" class="col-md-12 form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <input id="email" type="email" placeholder="メールアドレス" class="col-md-12 form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <input id="password" type="password" placeholder="パスワード" class="col-md-12 form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <input id="password-confirm" type="password" placeholder="パスワード（確認用）" class="col-md-12 form-control-lg" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="mb-2">
                        <button type="submit" class="btn text-white btn_css">
                            {{ __('Register') }}
                        </button>
                        <div class="text-center back_btn">
                            <a class="btn btn-link" href="{{ url('/login') }}">
                                戻る
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
