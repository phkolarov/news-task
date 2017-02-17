<?php
/**
 * Created by PhpStorm.
 * User: mst
 * Date: 17.2.2017 г.
 * Time: 19:24
 */

namespace App\Http\Controllers;


use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function article(Request $request){

        $articleData = Article::find($request->id);
        return view('article',compact('articleData'));
    }


}