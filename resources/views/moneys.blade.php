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
    @include('common.errors')


    <!-- Money: 既に登録されてるリスト -->
    <!-- 現在の支出 -->
    <div class="content">
        <h2>今までの合計金額<span>{{ number_format($sum) }}円</span></h2>
    </div>

    <div class="">
        <div class="">
            <form action="{{ url('moneyssearch') }}" method="GET">
                <input type="date" name="from">
                    <span class="mx-3 text-grey">~</span>
                <input type="date" name="until">
                <button type="submit">検索</button>
            </form>
        </div>

        <th><a class="btn btn-success" href="{{ url('moneysadd') }}">追加する</a></th>
    </div>
    @if (count($moneys) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <tbody>
                        @foreach ($moneys as $money)
                            <tr>
                                <!-- タイトル  -->
                                <td class="table-text">
                                    <div>{{ $money->date }}</div>
                                </td>
                                <td>
                                    <div>{{ $money->item_name }}</div>
                                </td>
                                <td>
                                    <div>{{ number_format($money->item_amount) }}円</div>
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
