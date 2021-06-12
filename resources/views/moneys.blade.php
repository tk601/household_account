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
    <div class="container">
        <form class="row text-center justify-content-center" action="{{ url('moneyssearch') }}" method="GET">
            @csrf
            <div class="col-md-6 search_css">
                <div class="col-md-12">
                    <p>日にちを指定してリストを検索する</p>
                </div>
                <div class="form-group col-md-12">
                    <input type="date" name="from" class="form-control">
                </div>
                <div class="col-md-12 bottom_img">
                    <img src="{{ asset('h_img/bottom.png') }}">
                </div>
                <div class="form-group col-md-12">
                    <input type="date" name="until" class="form-control">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn_css text-white">この範囲で検索する</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body mb-5">
        <div class="list_name">
            <p>全てのリスト一覧</p>
        </div>
        <div class="sum_css text-center">
            <p>リストの合計金額<br>{{ number_format($sum) }}円</p>
        </div>
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <a class="btn btn_css text-white" href="{{ url('moneysadd') }}">新しくリストを追加する</a>
                    </div>
                </div>
            </div>
        </div>
        @if (count($moneys) > 0)
            @foreach ($moneys as $money)
                <div class="list_css">
                    <div class="date_01">{{ $money->date->format('Y年m月d日') }}</div>
                    <table class="list_flex table table-borderless task-table">
                        <tbody>
                            <tr class="middle_css">
                                <td width="40%">
                                    <div>{{ $money->item_name }}</div>
                                </td>
                                <td width="40%">
                                    <div>{{ number_format($money->item_amount) }}円</div>
                                </td>
                                <td width="20%" class="btn_flex">
                                    <form action="{{ url('moneysedit/'.$money->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn update_delete up_css">
                                            <img src="{{ asset('h_img/update.png') }}">
                                        </button>
                                    </form>
                                    <form action="{{ url('money/'.$money->id) }}" method="POST">
                                        @csrf               <!-- CSRFからの保護 -->
                                        @method('DELETE')   <!-- 擬似フォームメソッド -->
                                        <button type="submit" class="btn update_delete de_css">
                                            <img src="{{ asset('h_img/delete.png') }}">
                                        </button>
                                     </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
        @endif
    </div>
    <div class="container">
        <div class="row justify-content-center">
            {{ $moneys->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
