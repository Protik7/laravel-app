<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Post;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories =  Category::paginate(10);

        return CategoryResource::collection($categories);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->loadCount('posts');

        return new CategoryResource($category);
    }

    public function posts(Category $category)
    {
        $posts = $category->posts()->with(['user', 'category', 'tags'])->paginate(10);

        return PostResource::collection($posts);
    }
}
