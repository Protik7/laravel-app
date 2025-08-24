<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'user')->paginate(10);

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required',
            'tags' => 'array|nullable|exists:tags,id',
            'image' => 'nullable|url',
        ]);

        $post = $request->user()->posts()->create([
            'title' => $fields['title'],
            'body' => $fields['body'],
            'category_id' => $fields['category_id'],
            'image' => $fields['image'],
        ]);

        if (!empty($fields['tags'])) {
            $post->tags()->attach($fields['tags']);
        }

        $post->load('user', 'category', 'tags');

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('category', 'user', 'tags');

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('modify', $post);

        $fields = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required',
            'tags' => 'array|exists:tags,id'
        ]);

        $post->update([
            'title' => $fields['title'],
            'body' => $fields['body'],
            'category_id' => $fields['category_id']
        ]);

        $post->tags()->sync($fields['tags']);

        $post->load('category', 'user', 'tags');

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('modify', $post);

        $post->delete();

        return ['message' => 'The post has been deleted.'];
    }
}
