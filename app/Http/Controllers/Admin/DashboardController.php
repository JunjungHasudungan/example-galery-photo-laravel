<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Post, Comment};
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public 
        $post_comment_makanan, 
        $post_comment_pendidikan,
        $post_comment_travelling,
        $post_comment_eleketronik,
        $post_like_makanan,
        $post_like_pendidikan,
        $post_like_travelling,
        $post_like_elektronik;

    public function index()
    {
        $listPost = null;
        $post_comment = null;
        $post_comment_makanan = 0;
        $post_comment_pendidikan = 0;
        $post_comment_travelling = 0;
        $post_comment_eleketronik = 0;

        $post_like = null;
        $post_like_makanan = 0;
        $post_like_pendidikan = 0;
        $post_like_travelling = 0;
        $post_like_elektronik = 0;

        $postCountsByCategory = DB::table('posts')
            ->select('category', DB::raw('count(*) as total_comment'))
            ->join('comments', 'posts.id', '=', 'comments.post_id')
            ->groupBy('category')
            ->get();

        $postCountLikeByCategory = DB::table('posts')
            ->select('category', DB::raw('count(*) as total_like'))
            ->join('likes', 'posts.id', '=', 'likes.post_id')
            ->groupBy('category')
            ->get();

        // posts-comments
        foreach ($postCountsByCategory as $post) {
            if ($post->category == 'makanan') {
                $post_comment_makanan = $post->total_comment;
            }

            if ($post->category == 'pendidikan') {
                $post_comment_pendidikan = $post->total_comment;
            }

            if ($post->category == 'travelling') {
                $post_comment_travelling = $post->total_comment;
            }

            if ($post->category == 'elektronik') {
                $post_comment_eleketronik = $post->total_comment;
            }
        }
        $post_comments = [$post_comment_makanan, $post_comment_pendidikan, $post_comment_travelling, $post_comment_eleketronik];
        $post_comment_amount = array_sum($post_comments);


        // posts-likes
        foreach ($postCountLikeByCategory as $post) {
            if ($post->category == 'makanan') {
                $post_like_makanan =  $post->total_like;
            }

            if ($post->category == 'pendidikan') {
                $post_like_pendidikan =  $post->total_like;
            }

            if ($post->category == 'travelling') {
                $post_like_travelling =  $post->total_like;
            }

            if ($post->category == 'elektronik') {
                $post_like_elektronik =  $post->total_like;
            }
        }

        $post_likes = [$post_like_makanan, $post_like_pendidikan, $post_like_travelling, $post_like_elektronik];
        $post_like_amount = array_sum($post_likes);

        return view('admin.dashboard', [
            'pageTitle'                 => 'Dashboard',
            'post_comment_amount'       => $post_comment_amount,
            'post_comment_makanan'      => $post_comment_makanan,
            'post_comment_pendidikan'   => $post_comment_pendidikan,
            'post_comment_travelling'   => $post_comment_travelling,
            'post_comment_eleketronik'  => $post_comment_eleketronik,
            'post_like_amount'          => $post_like_amount,
            'post_like_makanan'         => $post_like_makanan,
            'post_like_pendidikan'      => $post_like_pendidikan,
            'post_like_travelling'      => $post_like_travelling,
            'post_like_elektronik'      => $post_like_elektronik

            // 'postCountsByCategory'  => $postCountsByCategory
        ]);
    }
}
