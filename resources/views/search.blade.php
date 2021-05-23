@extends('layouts.app')
@section('content')
<!-- 年月日で検索するボタン -->
    <form action="hashtag" method="GET">
        <input type="date" name="from" placeholder="from_date">
            <span class="mx-3 text-grey">~</span>
        <input type="date" name="until" placeholder="until_date">
        <button type="submit">検索</button>
    </form>
    <!-- 検索された支出の合計値 -->
    <div class="content">
        <h2>支出合計金額<span>{{  }}円</span></h2>
    </div>
    <div class="well well-sm">
        <a class="btn btn-link pull-right" href="{{ url('/') }}">
            Back
        </a>
    </div>
    <!-- 検索で表示されるリスト -->
    @if (count($moneys) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <tbody>
                        @foreach ($moneys as $money)
                            <tr>
                                <!-- タイトル -->
                                <td class="table-text">
                                    <div>{{ $money->date->format('Y年m月d日') }}</div>
                                </td>
                                <td>
                                    <div>{{ $money->item_name }}</div>
                                </td>
                                <td>
                                    <div>{{ $money->item_amount }}円</div>
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
