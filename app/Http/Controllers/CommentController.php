<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with( 'post')->paginate(20);
        return view('comments.index', compact('comments'));
    }
}
