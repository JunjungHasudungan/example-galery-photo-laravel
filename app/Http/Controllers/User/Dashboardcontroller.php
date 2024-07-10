<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class Dashboardcontroller extends Controller
{
    public function index()
    {
        $posts = Post::with(['photo', 'comments', 'likes'])->get();
        return view('user.dashboard', [
            'pageTitle' => 'Dashboard',
            'posts'     => $posts
        ]);
    }
}
