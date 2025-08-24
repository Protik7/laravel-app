<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Tag;
use App\Http\Resources\TagResource;
use App\Models\Post;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|max:255'
        ]);

        $tag = Tag::create($fields);

        return new TagResource($tag);
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $fields = $request->validate([
            'title' => 'required|max:255'
        ]);

        $tag->update($fields);
        
        return new TagResource($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return ['message' => 'The tag has been deleted.'];
    }
}
