<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

        public function index()
    {
         $articles = Article::latest()->paginate(10);
        return view('front.articles.index', compact('articles')); 
    }
public function show($id){
    $article = Article::findOrFail($id);
    $articles = Article::latest()->paginate(9);

    return view('front.articles.show', compact('article','articles'));

    }
}
