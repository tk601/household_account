@extends('layouts.app')

@section('content')
<!-- パスワード設定 -->
<div class="login_01">
    <div class="container login_register">
        <div class="logo_01">
            <img src="{{ asset('h_img/top.png') }}">
        </div>
        <div class="text-center font_css">
            <p>
                パスワード再設定をします。<br>
                メールアドレスを入力してください。
            </p>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-6">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="text-center" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <input id="email" type="email" placeholder="メールアドレス" class="col-md-12 mb-4 form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn btn_css link_01 text-white">
                        {{ __('Send Password Reset Link') }}
                    </button>
                    <div class="back_btn">
                        <a class="btn btn-link" href="{{ url('/login') }}">
                            戻る
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
