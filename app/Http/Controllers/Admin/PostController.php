<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Post, Photo};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index', [
            'pageTitle' => 'Galeri Poto',
            'posts'     => Post::with('photo')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create',[
            'pageTitle' => 'Tambah Post'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'description'   => 'required|min:3',
            'category'  => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = Post::create([
            'title'         => $validated['title'],
            'description'   => $validated['description'],
            'category'      => $validated['category'],
            'user_id'       => auth()->id()
        ]);

        if($validated['photo']){
            $path = $validated['photo']->store('photos', 'public');
            Photo::create([
                'post_id'   => $post->id,
                'path'      => $path
            ]);
        }

    return redirect('admin-galeri-photo')->with('status', 'Berhasil ditambahkan..');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $postId)
    {
        $post = Post::where('id', $postId)->with('photo')->first();

        return view('admin.posts.edit', [
            'pageTitle' => 'Edit Post',
            'post'  => $post
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $validated = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'description'   => 'required|min:3',
            'category'  => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        dd($validated);
        $post->update([
            'title'             => $validated['title'],
            'description'       => $validated['description'],
            'category'          => $validated['category'],
            'user_id'           => auth()->id()
        ]);

        return redirect('admin-galeri-photo')->with('status', 'Berhasil diupdate...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('admin-galeri-photo')->with('status', 'Berhasil dihapus...');
    }
}
