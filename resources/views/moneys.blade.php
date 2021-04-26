@extends('layouts.app')
@section('content')

    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <div class="card-title">
            タイトル
        </div>

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
                </div>
            </div>
        </form>
    </div>
    <!-- フラッシュメッセージ -->
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Money: 既に登録されてるリスト -->
    <!-- 現在の支出 -->
    @if (count($moneys) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>支出一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($moneys as $money)
                            <tr>
                                <!-- タイトル -->
                                <td class="table-text">
                                    <div>{{ $money->item_name }}</div>
                                </td>

                                <!-- 本: 更新ボタン -->
                                <td>
                                    <form action="{{ url('moneysedit/'.$money->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            更新
                                        </button>
                                    </form>
                                </td>

                                <!-- 削除ボタン -->
                                <td>
                                    <form action="{{ url('money/'.$money->id) }}" method="POST">
                                        @csrf               <!-- CSRFからの保護 -->
                                        @method('DELETE')   <!-- 擬似フォームメソッド -->

                                        <button type="submit" class="btn btn-danger">
                                            削除
                                        </button>
                                     </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                {{ $moneys->links()}}
            </div>
        </div>
    @endif
@endsection
