<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //getting all the post data with a category data to display to index.blade.php file of post
        $posts = Post::with(['category'])->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all(); //call out all Category data
        $tags = Tag::all(); //call out all Category data
        return view('posts.create', compact('categories','tags')); 
        //creating an array value for two foreign datas in compact
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Request validation of post data
        $request->validate([
            'post_title' => 'required',
            'post_content' => 'required',
            'post_slug' => 'required',
            'is_published' => 'required',
            'category_id' => 'required'
        ]);

        $post = Post::create([$request->all()]);
        // Now you can attach the tags to the newly created post
        if ($request->has('tags')) {
            $post->tags()->attach($request->tags); // Use the $post instance
        }
        
        // Redirecting to the post index.blade.php file with a notification text
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //loads the data of the category to show to show.blade.php file
        $post->load(['category']);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
