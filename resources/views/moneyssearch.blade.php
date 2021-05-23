@extends('layouts.app')
@section('content')

<div class="">
    <form action="{{ url('moneyssearch') }}" method="GET">
        <input type="date" name="from" placeholder="from_date">
            <span class="mx-3 text-grey">~</span>
        <input type="date" name="until" placeholder="until_date">
        <button type="submit">検索</button>
    </form>
</form>
</div>
@if (count($date) > 0)
    <div class="">
        {{ $t_sum }}
    </div>
@endif
<div class="well well-sm">
    <a class="btn btn-link pull-right" href="{{ url('/') }}">
        リスト一覧に戻る
    </a>
</div>
    @if (count($date) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <tbody>
                        @foreach ($date as $date)
                            <tr>
                                <!-- タイトル -->
                                <td class="table-text">
                                    <div>{{ $date->date }}</div>
                                </td>
                                <td>
                                    <div>{{ $date->item_name }}</div>
                                </td>
                                <td>
                                    <div>{{ $date->item_amount }}円</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection