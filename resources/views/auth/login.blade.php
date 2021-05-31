@extends('layouts.app')

@section('content')
<div class="start">
    <div class="start_01">
        <img src="h_img/top.png">
        <p>シンプル家計簿</p>
    </div>
</div>
<div class="login_01">
    <div class="container login_register">
        <div class="logo_01">
            <img src="{{ asset('h_img/top.png') }}">
        </div>
        <div class="text-center font_css">
            <p>
                ログインするにはメールアドレス、<br>
                パスワードを入力してください。
            </p>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-8">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-2">
                        <input id="email" type="email" placeholder="メールアドレス" class="col-md-12 form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <input id="password" type="password" placeholder="パスワード" class="col-md-12 form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn col-md-12 btn_css text-white">
                        {{ __('Login') }}
                    </button>
                </form>
                <div class="login_pass text-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label remember_01" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn_css">
                            <a href="{{ route('login.guest') }}">
                                ゲストログイン
                            </a>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn_css">
                            @if (Route::has('register'))
                                <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </button>
                    </div>
                </div>
                <div class="text-center back_btn">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
