<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'task_id' => ['required'],
            'content' => ['required'],
        ]);
        $comment = Comment::create($attributes);
        $comment->created_by = auth()->user()->id;
        $comment->save();
        return redirect()->route('tasks');
    }
}
