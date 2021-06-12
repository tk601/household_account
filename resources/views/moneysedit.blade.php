<!-- 更新画面 -->

@extends('layouts.app')
@section('content')
<div class="text-center font_css">
    <p>
        タイトル、金額、日付、
        それぞれの変更ができます。
    </p>
</div>
<div class="container">
    <form action="{{ url('moneys/update') }}" method="POST" class="form-horizontal row justify-content-center">
        <div class="col-md-6">
            <div class="form-group">
               <label for="item_name" class="font_css">タイトル</label>
               <input type="text" name="item_name" class="form-control-lg col-md-12" value="{{$money->item_name}}">
            </div>
            <div class="form-group">
               <label for="item_amount" class="font_css">金額</label>
               <input type="text" name="item_amount" class="form-control-lg col-md-12" value="{{$money->item_amount}}">
            </div>
            <div class="form-group">
                <label for="date" class="font_css">日付</label>
                <input type="date" name="date" class="form-control-lg col-md-12" value="{{$money->date->format('Y-m-d')}}">
            </div>
            <div class="well well-sm text-center">
                <button type="submit" class="btn btn_css text-white">更新する</button>
                <a class="btn btn-link pull-right text-white" href="{{ url('/') }}">
                    戻る
                </a>
            </div>
            <input type="hidden" name="id" value="{{$money->id}}">
            @csrf
        </div>
    </form>
</div>
@endsection
