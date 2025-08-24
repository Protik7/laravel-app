<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'user', 'tags')->paginate(10);

        return PostResource::collection($posts);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $fields = $request->validate([
    //         'title' => 'required|max:255',
    //         'body' => 'required'
    //     ]);

    //     $post = $request->user()->posts()->create($fields);

    //     return new PostResource($post);
    // }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->views_count = $post->views_count + 1;

        $post->update();

        $post->load('category', 'user', 'tags');

        return new PostResource($post);
    }

    public function popular_posts()
    {
        $posts = Post::where('views_count', '>', 2)->get();

        return PostResource::collection($posts->load('category', 'user', 'tags'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Post $post)
    // {
    //     Gate::authorize('modify', $post);
        
    //     $fields = $request->validate([
    //         'title' => 'required|max:255',
    //         'body' => 'required'
    //     ]);

    //     $post->update($fields);

    //     return $post;
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Post $post)
    // {
    //     Gate::authorize('modify', $post);
        
    //     $post->delete();

    //     return ['message' => 'The post has been deleted.'];
    // }
}
