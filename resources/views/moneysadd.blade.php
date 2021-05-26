@extends('layouts.app')
@section('content')

    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <h3></h3>
        <!-- バリデーションエラーの表示に使用-->
        @include('common.errors')
        <!-- バリデーションエラーの表示に使用-->

        <!-- タイトル -->
        <form action="{{ url('moneys') }}" method="POST" class="form-horizontal">
            @csrf

            <!-- タイトル -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="money" class="col-sm-3 control-label">タイトル</label>
                    <input type="text" name="item_name" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label for="amount" class="col-sm-3 control-label">金額</label>
                    <input type="text" name="item_amount" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date" class="col-sm-3 control-label">日付</label>
                    <input type="date" name="date" class="form-control">
                </div>
            </div>

            <!-- 登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                    <a class="btn btn-link pull-right" href="{{ url('/') }}">
                        Back
                    </a>
                </div>
            </div>
        </form>
    </div>

@endsection
