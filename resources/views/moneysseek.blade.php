@extends('layouts.app')
@section('content')


@if (count($date) >0)
    <div class="">
        {{ number_format($t_sum) }}
    </div>
@endif
<div class="well well-sm">
    <a class="btn btn-link pull-right" href="{{ url('/') }}">
        リスト一覧に戻る
    </a>
</div>
    @if (count($date) >0)
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
                                <div>{{ number_format($date->item_amount) }}円</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
