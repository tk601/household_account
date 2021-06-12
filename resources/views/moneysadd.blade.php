<!-- 追加画面 -->

@extends('layouts.app')
@section('content')
    <div class="card-body">
        <div class="text-center font_css">
            <p>
                リストを追加します。<br>
                タイトル、金額、日付を入力してください。
            </p>
        </div>
        <!-- バリデーションエラーの表示に使用-->
        @include('common.errors')
        <div class="container">
            <form action="{{ url('moneys') }}" method="POST" class="form-horizontal row justify-content-center">
                @csrf
                <div class="col-md-6 text-center">
                    <div class="form-group">
                        <input type="text" name="item_name" class="form-control-lg col-md-12" placeholder="タイトル">
                    </div>
                    <div class="form-group">
                        <input type="text" name="item_amount" class="form-control-lg col-md-12" placeholder="金額">
                    </div>
                    <div class="form-group">
                        <input type="date" name="date" class="form-control-lg col-md-12">
                    </div>
                    <button type="submit" class="btn btn_css text-white">
                        登録する
                    </button>
                    <a class="btn btn-link pull-right text-white" href="{{ url('/') }}">
                        戻る
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
