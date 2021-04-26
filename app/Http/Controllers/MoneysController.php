<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//追記
use App\Money;
use Validator;
use Auth;

class MoneysController extends Controller {
    //ダッシュボードの表示
    public function index() {
        $moneys = Money::orderBy('created_at', 'asc')->get();
        return view('moneys', ['moneys' => $moneys]);
    }

    //更新画面
    public function edit(Money $moneys) {
        return view('moneysedit', [
            'money' => $moneys
        ]);
    }

    //更新
    public function update(Request $request) {
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
    }

    //登録
    public function store(Request $request) {
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
    }

    //削除処理
    public function destroy(Money $money) {
        $money->delete();
        return redirect('/');
    }
}
