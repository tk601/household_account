@extends('layouts.app')
@section('content')

    <!-- フラッシュメッセージ -->
    @if (session('store_message'))
        <div class="alert alert-success">
            {{ session('store_message') }}
        </div>
    @endif
    @if (session('update_message'))
        <div class="alert alert-success">
            {{ session('update_message') }}
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
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>sa</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($moneys as $money)
                            <tr>
                                <!-- タイトル -->
                                <td class="table-text">
                                    <div>{{ $money->date }}</div>
                                </td>
                                <td>
                                    <div>{{ $money->item_name }}</div>
                                </td>
                                <td>
                                    <div>{{ $money->item_amount }}</div>
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
        <div class="">
            <a class="btn btn-success" href="{{ url('moneysadd') }}">追加</a>
        </div>
    @endif
@endsection
