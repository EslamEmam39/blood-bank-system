<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;


class ArticleController extends Controller
{ 
    public function index(Request $request)
    {
        // إذا كانت الفئة (category_id) موجودة في الـ request
        $query = Article::query();
    
        if ($request->has('category_id')) {
            // تصفية المقالات حسب category_id
            $query->where('category_id', $request->category_id);
        }
    
        // جلب المقالات مع تصنيفها (category) وتطبيق التصفية
        $data = $query->with('category')->paginate(10);
    
        return response()->json([
            'status' => 200,
            'articles' => $data,
        ]);
    }
    
 
    public function show( $id)
    {
        $data = Article::with('category')->findOrFail($id);

        return response()->json([
            'status' => 200 , 
            'data' => $data 
        ]);
    }



    public function addToFavorites(Request $request, $articleId)
{
    $user = $request->user();  // الحصول على المستخدم من الـ API Token
    $article = Article::findOrFail($articleId);

    // إضافة المقال إلى المفضلة
    $user->articles()->attach($articleId);

    return response()->json([
        'status' => 200,
        'message' => 'تم إضافة المقال إلى المفضلة بنجاح',
    ]);
}

public function getFavorites(Request $request)
{
    $user = $request->user(); 

    // جلب المقالات المفضلة
    $favorites = $user->articles;

    return response()->json([
        'status' => 200,
        'message' => 'تم جلب المقالات المفضلة بنجاح',
        'data' => $favorites
    ]);
}

public function removeFromFavorites(Request $request, $articleId)
{
    $user = $request->user(); 
    $article = Article::findOrFail($articleId);


    $user->articles()->detach($articleId);

    return response()->json([
        'status' => 200,
        'message' => 'تم إزالة المقال من المفضلة بنجاح',
    ]);
}
 
}
