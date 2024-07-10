<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Post $post)
    {
        $post = Post::where('id', $post->id)->with(['photo'])->get();
        
        return view('user.comments.create', [
            'pageTitle'     => 'Koment',
            'post'          => $post
        ]);
    }
}
