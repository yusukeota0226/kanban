<?php

namespace App\Http\Controllers;

use App\Listing;
use Auth;
use Validator;

use Illuminate\Http\Request;

class ListingsController extends Controller
{
    //コンストラクタ （このクラスが呼ばれると最初にこの処理をする）
    public function __construct()
    {
        //ログインしていなかったらログインページに遷移する
        $this->middleware('auth');
    }

    public function index()
    {
        //Listingテーブルを参照してデータを取得する
        //条件：user_idが現在ログインしているユーザーIDと一致していること
        //ソート：作成日の昇順
        $listings = Listing::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'asc')
            ->get();
            
        //テンプレート「listing/index.blade.php」を表示する。
        return view('listing/index', ['listings' => $listings]);
    }

    public function newlist()
    {
        //テンプレート「listing/newlist.blade.php」を表示する。
        return view('listing/newlist');
        
    }

    public function store(Request $request)
    {
        //バリデーションチェック
        $validator = validator::make($request->all(), ['list_name' => 'required|max:255',]);
        
        //バリデーションチェックの結果がエラーの場合
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        //Listingモデル作成
        $listings = new Listing;
        $listings->title = $request->list_name;
        $listings->user_id = Auth::user()->id;
        
        $listings->save();
        
        //「/」ルートにリダイレクト
        return redirect('/');
    }

    public function edit($listing_id)
    {
        $listing = Listing::find($listing_id);
        //テンプレート「listing/edit.blade.php」を表示する
        return view('listing/edit', ['listing' => $listing]);
    }

    public function update(Request $request)
    {
        //バリデーションチェック
        $validator = Validator::make($request->all(), ['list_name' => 'required|max:255', ]);
        
        //バリデーションの結果がエラーの場合
        if($validator -> fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $listing = Listing::find($request->id);
        $listing->title = $request->list_name;
        $listing->save();
        return redirect('/');
    }


    public function destroy($listing_id)
    {
        $listing = Listing::find($listing_id);
        $listing->delete();
        return redirect('/');
    }
}