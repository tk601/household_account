<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//追記
use App\Money;
use Validator;
use Auth;

class MoneysController extends Controller {
    //一覧の表示
    public function index() {
        $moneys = Money::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        $sum = Money::where('user_id',Auth::user()->id)->sum('item_amount');
        return view('moneys' , ['moneys' => $moneys ,'sum' => $sum ]);
    }

    //更新画面
    public function edit($money_id) {
        $moneys = Money::where('user_id',Auth::user()->id)->find($money_id);
        return view('moneysedit', ['money' => $moneys]);
    }

    //検索画面の表示
    public function seek() {
        return view('moneysseek');
    }

    //年月日で検索画面の表示
    public function search(Request $request) {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'from' => 'required',
            'until'=> 'required'
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        $from = $request->input('from');
        $until = $request->input('until');
        $moneys = Money::where('user_id',Auth::user()->id)
            ->orderBy('date', 'desc')
            ->whereBetween('date',[$from,$until])
            ->orwhereBetween('date',[$until,$from])
            ->paginate(10);
        $t_sum = Money::where('user_id',Auth::user()->id)
            ->orderBy('date', 'desc')
            ->whereBetween('date',[$from,$until])
            ->orwhereBetween('date',[$until,$from])
            ->sum('item_amount');
        return view('moneysseek', ['moneys' => $moneys , 't_sum' => $t_sum , 'from' => $from , 'until' => $until]);
    }


    //更新　更新ボタン
    public function update(Request $request) {
        //バリデーション
        $validator = Validator::make($request->all(), [
            //更新処理には「id」がいる
            'id' => 'required',
            'item_name' => 'required|min:1|max:255',
            'item_amount' => 'required|max:6',
            'date' => 'required'
        ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        //データ更新
        $moneys = Money::where('user_id',Auth::user()->id)->find($request->id);
        $moneys->item_name = $request->item_name;
        $moneys->item_amount = $request->item_amount;
        $moneys->date = $request->date;
        $moneys->save();
        return redirect('/')->with('update_message', '更新が完了しました');
    }

    //追加画面の表示
    public function add() {
        return view('moneysadd');
    }

    //登録　SAVEボタン
    public function store(Request $request) {
        //dd($request);どんな情報が送られているか確認できる「request,paraments」
        //バリデーション
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|min:1|max:255',
            'item_amount' => 'required|numeric|min:0',
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
        $moneys->user_id  = Auth::user()->id; //追加のコード
        $moneys->item_name = $request->item_name;
        $moneys->item_amount = $request->item_amount;
        $moneys->date = $request->date;
        $moneys->save();
        return redirect('/')->with('store_message', '登録が完了しました');
        //with('message', '登録が完了しました')...withヘルパー関数　→　moneys.bladeに表示される
    }

    //削除処理
    public function destroy(Money $money) {
        $money->delete();
        return redirect('/');
    }

    //コンストラクタ （このクラスが呼ばれたら最初に処理をする） ログイン承認をしないと、どこのページも開けない。
    public function __construct() {
        $this->middleware('auth');
    }
}
