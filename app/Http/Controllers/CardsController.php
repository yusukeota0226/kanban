<?php

namespace App\Http\Controllers;

use Auth;
use App\Card;
use App\Listing;
use Validator;

use Illuminate\Http\Request;

class CardsController extends Controller
{
    //コンストラクタ
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function new($listing_id)
    {
        //テンプレート「card/new.blade.php」を表示する
        return view('card/new', ['listing_id' => $listing_id]);
    }
    
    public function store(Request $request)
    {
        //バリデーションチェック
        $validator = Validator::make($request->all(), ['card_title' => 'required|max:255', 'card_memo' => 'required|max:255',]);
        
        //バリデーションチェックがエラーの場合
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        //Cardの登録処理
        $cards = new Card;
        $cards->title = $request->card_title;
        $cards->listing_id = $request->listing_id;
        $cards->memo = $request->card_memo;
        
        $cards->save();
        
        //ルートにリダイレクト
        return redirect('/');
    }
}
