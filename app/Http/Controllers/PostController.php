<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdatePostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('postCheck', ['only' => ['update', 'delete']]);
    // }

    public function index()
    {
        $posts = Post::with('user', 'comments')->paginate(4);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post = Post::where('id', $post->id)->with('user', 'comments')->first();
        return view('posts.show', compact('post'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(CreateUpdatePostRequest $request){
        Post::create([
            'title' => $request->title,
            'body'=> $request->body,
            'user_id' => auth()->user()->id
        ]);

        return redirect(route('posts.index'))->with(['success'=> 'post created successfully']);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(CreateUpdatePostRequest $request, Post $post){
        if ($post->user_id != auth()->user()->id && !auth()->user()->is_admin){
            return redirect(route('posts.index'))->with(['error' => 'you don\'t have been authorized']);
        }

        $post->update([
            'title' => $request->title,
            'body'=> $request->body
        ]);

        return redirect(route('posts.index'))->with(['success'=> 'post updated successfully']);
    }

    public function destroy(Post $post){
        if ($post->user_id != auth()->user()->id && !auth()->user()->is_admin){
            return redirect(route('posts.index'))->with(['error' => 'you don\'t have been authorized']);
        }
        
        $post->delete();
        return redirect(route('posts.index'))->with(['success'=> 'post deleted successfully']);
    }
}
