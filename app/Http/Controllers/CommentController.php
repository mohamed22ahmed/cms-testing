<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with( 'post')->paginate(5);
        return view('comments.index', compact('comments'));
    }

    public function show(Comment $comment)
    {
        $comment = Comment::where('id', $comment->id)->with('post')->first();
        return view('comments.show', compact('comment'));
    }

    public function create(){
        $posts = Post::all();
        return view('comments.create', compact('posts'));
    }

    public function store(CreateUpdateCommentRequest $request){
        Comment::create([
            'comment'=> $request->comment,
            'post_id' => $request->post_id
        ]);

        return redirect(route('comments.index'))->with(['success'=> 'comment created successfully']);
    }

    public function edit(Comment $comment)
    {
        $posts = Post::all();
        return view('comments.edit', compact('comment', 'posts'));
    }

    public function update(CreateUpdateCommentRequest $request, Comment $comment){
        $comment->update([
            'comment' => $request->comment,
            'post_id'=> $request->post_id
        ]);

        return redirect(route('comments.index'))->with(['success'=> 'comment updated successfully']);
    }

    public function destroy(Comment $comment){
        $comment->delete();

        return redirect(route('comments.index'))->with(['success'=> 'comment deleted successfully']);
    }
}
