<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{Post, Comment, Like};
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

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content'   => 'required'
        ]);

        Comment::create([
            'post_id'   => $post->id,
            'user_id'   => auth()->id(),
            'content'   => $validated['content']
        ]);

        return redirect('user-dashboard')->with('status', 'Berhasil melakukan komentar..');
    }

    public function storeLike(Request $request, Post $post)
    {
        $like = Like::where('post_id', $post->id)->where('user_id', auth()->id())->first();

        if ( !$like ) {
            Like::create([
                'post_id'   => $post->id,
                'user_id'   => auth()->id(),
            ]);
        } else{
            $like->delete();
        }
        return redirect('user-dashboard')->with('status', 'Berhasil perubahan Like..');
    }
}
