<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('article.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required'],
            'category' => ['required'],
            'image' => ['required'],
        ]);

        if ($request->hasFile('image')) {

            $image_url = Storage::url($request->file('image')->storePublicly('/public/images'));
        }

        $article = Article::create([
            'title' => Str::title($request->input('title')),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'category_id' => $request->input('category'),
            'image' => $image_url
        ]);

        return back()->with('status', "{$article->title} Created Successfully!");
    }

    public function show($slug)
    {
        $article = Article::query()->where([
            'slug' => $slug,
            'flag' => 1
        ])->first();

        return response()->json($article, 200);
    }

    public function delete($ids)
    {
        Article::destroy($ids);
    }
}
