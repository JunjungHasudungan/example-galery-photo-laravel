<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Post, Photo};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
class PostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'pageTitle' => 'Galeri Poto',
            'posts'     => Post::with('photo')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.posts.create',[
            'pageTitle' => 'Tambah Post'
        ]);
    }

    public function cancel()
    {
        return redirect('admin-galeri-photo');
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
            'photos' => 'required',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'title.required'            => 'Judul Album Galeri Photo wajib diisi..',
            'description.required'      => 'Keterangan Album Galeri Photo wajib diisi..',
            'photos.required'            => 'Photo Album Galeri Photo wajib diisi..',
        ]);

        $post = Post::create([
            'title'         => $validated['title'],
            'description'   => $validated['description'],
            'category'      => $validated['category'],
            'user_id'       => Auth::user()->id
        ]);


        if ($validated['photos']) {
            foreach ($request->file('photos') as $file) {
                // Pastikan ada file yang diupload
                if ($file->isValid()) {
                    $path = $file->store('photos', 'public'); // Menyimpan file dan mendapatkan path
                    
                    // Menyimpan informasi file ke database
                    Photo::create([
                        'post_id' => $post->id,
                        'path' => $path
                    ]);
                }
            }
        }

    return redirect('admin-galeri-photo')->with('status', 'Berhasil ditambahkan..');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idPost)
    {

        $post = Post::findOrFail($idPost);

        $album = Post::where('id', $post->id)->with('photo')->first();
        return view('admin.posts.show',[
            'pageTitle' =>'Show list album',
            'album'     => $album
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
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

        $post->update([
            'title'             => $validated['title'],
            'description'       => $validated['description'],
            'category'          => $validated['category'],
            'user_id'           => Auth::user()->id
        ]);

        if ($validated['photo']) {

            Storage::disk('public')->delete($post->photo->path);

            $path = $validated['photo']->store('photos', 'public');

            $photo = Photo::where('post_id', $post->id)->first();

            $photo->update([
                'path'  => $path
            ]);

        }

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
