<?php

namespace JePaFe\Blog\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use JePaFe\Blog\Models\Post;
use Illuminate\Http\Request;
use JePaFe\Blog\Http\Requests;
use function GuzzleHttp\Psr7\str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(config('blog.posts_per_page'));

        return view('blog::index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('blog::show', compact('post'));
    }
}
