<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Tag;
use App\Http\Resources\TagResource;
use App\Models\Post;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::paginate(10);

        return TagResource::collection($tags);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $tag->loadCount('posts');

        return new TagResource($tag);
    }

    public function posts(Tag $tag)
    {
        $posts = $tag->posts()->with(['user', 'category', 'tags'])->paginate(10);

        return PostResource::collection($posts);
    }
}
