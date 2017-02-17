<?php
/**
 * Created by PhpStorm.
 * User: mst
 * Date: 16.2.2017 г.
 * Time: 22:01
 */

namespace App\Http\Controllers;


use App\Http\Helpers\Helpers;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function articleAdministration()
    {
        $articles = Article::orderBy('date_added', 'desc')->paginate(10);
        return view('admin.article-administration', compact('articles'));
    }

    public function addArticle()
    {
        $categories = Category::all();
        return view('admin.add-article', compact('categories'));
    }

    public function addingNewArticle(Request $request)
    {
        try {
            $base64ImageData = preg_replace('/data:image\/png;base64,/', '', $request->resizedImage);
            $image = base64_decode($base64ImageData);

            if (isset($request->title) && isset($request->articleContent) && isset($request->category) && isset($request->resizedImage)) {

                $newArticle = new Article();
                $newArticle->title = $request->title;
                $newArticle->content = $request->articleContent;

                $filename = uniqid() . '.png';
                file_put_contents('../public/images/articles/big_thumbnails/' . $filename, $image);
                Helpers::makeThumbnail("articles/big_thumbnails/$filename", $filename);

                $newArticle->image_name = $filename;

                if (isset($request->isActive)) {
                    $newArticle->posted = 1;
                } else {
                    $newArticle->posted = 0;
                }

                $newArticle->category_id = $request->category;
                $newArticle->save();

                return redirect('/admin/article-administration#success=Успешно качена статия');
            } else {
                return redirect('/admin/article-administration#error=Проблем при качване на статията');
            }
        } catch (\Exception $ex) {
            return redirect('/admin/article-administration#error=Проблем при качване на статията');
        }
    }

    public function editArticle(Request $request)
    {

        $articleId = $request->id;
        $article = Article::where('id', $articleId)->first();
        $categories = Category::all();

        if ($article != null) {
            return view('admin.edit-article', compact('article', 'categories'));
        } else {
            return redirect('/admin/article-administration#error=Не е открита подобна статия');
        }
    }

    public function editingArticle(Request $request)
    {
        try {
            $articleId = $request->id;
            $article = Article::where('id', $articleId)->first();

            if (isset($request->title) && isset($request->articleContent) && isset($request->category)) {

                $article->title = $request->title;
                $article->content = $request->articleContent;
                $article->category_id = $request->category;

                if (isset($request->resizedImage)) {

                    $base64ImageData = preg_replace('/data:image\/png;base64,/', '', $request->resizedImage);
                    $image = base64_decode($base64ImageData);

                    $filename = uniqid() . '.png';
                    file_put_contents('../public/images/articles/big_thumbnails/' . $filename, $image);
                    Helpers::makeThumbnail("articles/big_thumbnails/$filename", $filename);
                    $article->image_name = $filename;
                }

                if(!isset($request->isActive)){
                    $article->posted = 0;
                }else{
                    $article->posted = 1;
                }

                $article->date_edited = date("Y-m-d H:i:s");
                $article->save();
                return redirect('/admin/article-administration#success=Успешно променена статия');
            }
        } catch (\Exception $ex) {

            return redirect('/admin/article-administration#error=Проблем при редакция на статията');
        }
    }

    public function deleteArticle(Request $request)
    {

        $articleId = $request->deletingArticleId;
        $article = Article::where('id', $articleId)->first();

        if ($article != null) {
            $article->delete();
            return redirect('/admin/article-administration#success=Успешно изтрита статия');
        } else {
            return redirect('/admin/article-administration#error=Проблем при изтриване на статията');

        }
    }
}