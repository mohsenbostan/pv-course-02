<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return back()->with('status', "{$category->name} Created Successfully!");
    }

    public function update($category_id, Request $request)
    {
        $category = Category::find($category_id);
        $category->name = $request->input('name');
        $category->save();
    }

    public function showCategoriesAndArticles()
    {
        return response()->json(Category::with('articles')->get(), 200);
    }
}
