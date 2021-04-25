<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Money;
use Illuminate\Http\Request;

/**
* 一覧表示(moneys.blade.php)
*/
Route::get('/', function () {
    $moneys = Money::orderBy('created_at', 'asc')->get();
    return view('moneys', [
        'moneys' => $moneys
    ]);
    //return view('moneys',compact('moneys')); //も同じ意味
});

/**
* 登録
*/
Route::post('/moneys', function (Request $request) {
    //dd($request);どんな情報が送られているか確認できる「request,paraments」
    //バリデーション
    $validator = Validator::make($request->all(), [
        'item_name' => 'required|min:3|max:255',
        'item_amount' => 'required|max:6',
        'date' => 'required',
    ]);

    //バリデーション:エラー
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }


    //Eloquentモデル（登録処理）
    $moneys = new Money;
    $moneys->item_name = $request->item_name;
    $moneys->item_amount = $request->item_amount;
    $moneys->date = $request->date;
    $moneys->save();
    return redirect('/');
});

//更新画面
Route::post('/moneysedit/{moneys}', function(Money $moneys) {
    //{moneys}id 値を取得 => Money $moneys id 値の1レコード取得
    return view('moneysedit', ['money' => $moneys]);
});

//更新処理
Route::post('/moneys/update',function(Request $request){
    //バリデーション
    $validator = Validator::make($request->all(), [
        //更新処理には「id」がいる
        'id' => 'required',
        'item_name' => 'required|min:3|max:255',
        'item_amount' => 'required|max:6',
        'date' => 'required',
    ]);

    //バリデーション:エラー
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    //データ更新
    $moneys = Money::find($request->id);
    $moneys->item_name = $request->item_name;
    $moneys->item_amount = $request->item_amount;
    $moneys->date = $request->date;
    $moneys->save();
    return redirect('/');
});

/**
* 削除
*/
Route::delete('/money/{money}', function (Money $money) {
    $money->delete();
    return redirect('/');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
