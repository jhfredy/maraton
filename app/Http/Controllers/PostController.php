<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class PostController extends Controller
{

    public function index():View
    {
        return view('posts.index');
    }

    public function postList():Collection
    {
        return Post::orderBy('id','DESC')->get();
    }


    public function store(Request $request)
    {
            $post = new Post();
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->save();
    }


    public function update(Request $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();
    }


    public function destroy(Post $post)
    {
        return $post->delete();
    }
}
