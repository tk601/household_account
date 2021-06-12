@extends('layouts.app')
@section('content')
    @if(count($moneys) == 0)
        <div class="seek">
            <p>検索された日にちにリストは作成されていません。</p>
        </div>
    @endif
    @if (count($moneys) > 0)
        <div class="seek">
            <p>{{ date('Y年m月d日', strtotime($from)) }}から<br>{{ date('Y年m月d日', strtotime($until)) }}までの<br>リスト一覧</p>
            <p>リストの合計金額<br>{{ number_format($t_sum) }}円</p>
        </div>
    @endif
    @if (count($moneys) > 0)
        @foreach ($moneys as $money)
            <div class="list_css mb-5">
                <table class="list_flex table table-borderless task-table">
                    <tbody>
                        <tr class="middle_css">
                            <td width="40%">
                                <div>{{ $money->date->format('Y年m月d日') }}</div>
                            </td>
                            <td width="40%">
                                <div>{{ $money->item_name }}</div>
                            </td>
                            <td width="33%">
                                <div>{{ number_format($money->item_amount) }}円</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
<div class="container">
    <div class="row justify-content-center">
        {{ $moneys->appends(request()->query())->links() }}
    </div>
</div>
<div class="well well-sm text-center">
    <a class="btn btn-link pull-right text-white" href="{{ url('/') }}">
        リスト一覧に戻る
    </a>
</div>

@endsection
