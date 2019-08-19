<?php

namespace JePaFe\Blog\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use JePaFe\Blog\Models\Post;
use Illuminate\Http\Request;
use JePaFe\Blog\Http\Requests;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Post::query())
                ->addColumn('action', 'blog::post._action')
                ->make(true);
        }
        return view('blog::post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog::post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\Post $request)
    {
        $request->merge(['slug' => Str::slug($request->get('title'))]);

        $request->validate([
            'slug' => 'unique:posts',
        ]);

        $post = Post::create($request->all());

        return redirect($post->path())->with('status', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('blog::post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('blog::post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Post $request, Post $post)
    {
        $request->merge(['slug' => Str::slug($request->get('title'))]);

        $request->validate([
            'slug' => 'unique:posts,slug,' . $post->id,
        ]);

        $post->update($request->all());

        return redirect($post->path())->with('status', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', 'Post deleted successfully.');
    }
}
