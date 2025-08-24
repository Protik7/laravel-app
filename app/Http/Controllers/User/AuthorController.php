<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::whereHas('role', function ($query) {
            $query->where('name', 'Author');
        })->get();

        return UserResource::collection($authors);
    }

    public function show(User $user)
    {
         $user->loadCount('posts');

        return new UserResource($user->load('role'));
    }

    public function posts(User $user)
    {
        $posts = $user->posts()->with(['category', 'tags'])->paginate(10);

        return PostResource::collection($posts);
    }
}
