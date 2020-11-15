<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create([
            'user_id' => auth()->user()->id,
        ] + $request->all());

        if ($request->file('file')) {
            $post->image = $request->file('file')->store('posts', 'public');
            $post->save();
        }
        return back()->with('status', 'Creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        return view('post.edit', ['post' => Post::find($post)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $post)
    {

        Post::find($post)->update($request->all());

        if ($request->file('file')) {
            $post_update = Post::find($post);
            Storage::disk('public')->delete($post_update->image);
            $post_update->image = $request->file('file')->store('posts', 'public');
            $post_update->save();
        }
        return back()->with('status', 'Actualizado con exito !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $post_delete_image = Post::find($post);
        Storage::disk('public')->delete($post_delete_image->image);
        Post::find($post)->delete();

        return back()->with('status', 'Eliminado con exito...');
    }
}
