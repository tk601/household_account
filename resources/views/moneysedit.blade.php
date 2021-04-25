@extends('layouts.app')
@section('content')
<div class="row container">
    <div class="col-md-12">
    @include('common.errors')
    <form action="{{ url('moneys/update') }}" method="POST">

        <!-- item_name -->
        <div class="form-group">
           <label for="item_name">Title</label>
           <input type="text" name="item_name" class="form-control" value="{{$money->item_name}}">
        </div>
        <!--/ item_name -->

        <!-- item_amount -->
        <div class="form-group">
           <label for="item_amount">Amount</label>
        <input type="text" name="item_amount" class="form-control" value="{{$money->item_amount}}">
        </div>
        <!--/ item_amount -->

        <!-- date -->
        <div class="form-group">
            <label for="date">date</label>
            <input type="datetime" name="date" class="form-control" value="{{$money->date}}"/>
        </div>
        <!--/ date -->

        <!-- Saveボタン/Backボタン -->
        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                Back
            </a>
        </div>
        <!--/ Saveボタン/Backボタン -->

         <!-- id値を送信 -->
         <input type="hidden" name="id" value="{{$money->id}}">
         <!--/ id値を送信 -->

         <!-- CSRF -->
         @csrf
         <!--/ CSRF -->

    </form>
    </div>
</div>
@endsection
