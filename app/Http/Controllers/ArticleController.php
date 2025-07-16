<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
 
    public function index()
    {
         $articles = Article::latest()->paginate(10);
        return view('articles.index', compact('articles'));       }

 
    public function create()
    {
           $categories = Category::all();
    return view('articles.create', compact('categories'));
    }
 
    public function store(Request $request)

    {

    $request->validate([
        'title'       => 'required',
        'content'     => 'required',
        'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'category_id' => 'required|exists:categories,id',
    ]);

      $imagePath = $request->file('image')->store('articles', 'public');

    Article::create([
        'title'       => $request->title,
        'content'     => $request->content,
        'image'       => $imagePath,
        'category_id' => $request->category_id,
    ]);
 
    return redirect()->route('articles.index')->with('success', 'تمت الإضافة بنجاح');
    

    }

 
    public function show(string $id)

    // web 
    {
         $article = Article::findOrFail($id); 
         $articles = Article::latest()->paginate(9);

    return view('front.articles-show', compact('article','articles'));
    }

 
    public function edit(string $id)
    {
       $article = Article::findOrFail($id);
       $categories = Category::all() ;
       return view('articles.edit',compact('article' , 'categories'));
    }

 
    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);

      $request->validate([
        'title'       => 'required',
        'content'     => 'required',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'category_id' => 'required|exists:categories,id',
    ]);
   
    if($request->hasFile('image')){
        $imagePath = $request->file('image')->store('articles' , 'public');
    }else{
        $imagePath = $article->image ;
    }

    $article->update([
        'title'       => $request->title,
        'content'     => $request->content,
        'image'       => $imagePath,
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('articles.index')->with('success', 'تمت التعديل بنجاح');

    }
 
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id)->delete();

        return redirect()->route('articles.index')->with('success' , 'تم الحذف بنجاح');

        // لسا مش حذف من المشروع
    }
}
