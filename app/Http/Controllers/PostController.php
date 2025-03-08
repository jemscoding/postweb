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
        $tags = Tag::all(); //call out all Tags data
        return view('posts.create', compact('categories','tags')); 
        //creating an array value for two foreign datas in compact
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Request validation of post data
        $validatedData = $request->validate([
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'post_title' => 'required|max:255',
            'post_content' => 'required',
            'post_slug' => 'required|unique:posts',
            'is_published' => 'sometimes|boolean ',
            'category_id' => 'required'
        ]);
        $validatedData['post_image'] = $request->file('post_image');

        // Generate a unique name for the image
        $imageName = time() . '.' . $validatedData['post_image']->getClientOriginalExtension();

        // Move the file to the 'public/uploads' directory
        $validatedData['post_image']->move(public_path('uploads'), $imageName);

        // Store the image path in the database (if needed)
        $imagePath = 'uploads/' . $imageName;
        // Moving the file to the validated data image path
        $validatedData['post_image'] = $imagePath;
        $validatedData['is_published'] = $request->has('is_published') ? true :false;
        $posts = Post::create($validatedData);
       
        // Now you can attach the tags to the newly created post
        if ($request->has('tags')) {
            $posts->tags()->attach($request->tags); // Use the $post instance
        }
        $posts->save();
       
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
