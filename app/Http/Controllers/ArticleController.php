<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    // 商品一覧画面を表示
    public function showList() {
        return view('list');
    }

    // テスト画面を表示
    public function showTest()
    {
        return view('test');
    }
}
