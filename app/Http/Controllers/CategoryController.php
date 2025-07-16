<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()    
    {
    $categories = Category::latest()->paginate(10);
    return view('categories.index', compact('categories'));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name'
        ]);

        Category::create($request->all());
                return redirect()->route('categories.index')->with('success', 'تمت الإضافة');

     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
     }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            $category = Category::findOrFail($id);

        return view('categories.edit',compact('category'));    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name'

        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success'  ,  'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::findOrFail($id)->delete();

        return redirect()->route('categories.index')->with('success' , "تم الحذف بنجاخ ");
    }
}
