@extends('layouts.app')
@section('post_contents')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/js/app.js','resources/css/app.css'])
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-neutral-900">
    <!-- Form Container -->
    <div class="w-full max-w-lg p-6 bg-white dark:bg-neutral-900 border border-gray-300 rounded-lg shadow-md">
        <!-- Form -->
        <form action="{{ route('posts.store') }}" enctype="multipart/form-data" method="POST" 
              class="p-6 border border-gray-300 rounded-lg outline outline-2 outline-transparent focus-within:outline-blue-500 transition-all">
            @csrf

            <!-- Image Upload -->
             <input type = "file" name = "post_image" id = "post_image" accept="image/*"/>

            <!-- Title -->
            <div class="mb-4">
                <label for="post_title" class="block text-sm font-medium dark:text-white">Title</label>
                <input type="text" name="post_title" id="post_title" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                       placeholder="Enter post title">
            </div>

            <!-- Slug -->
            <div class="mb-4">
                <label for="post_slug" class="block text-sm font-medium dark:text-white">Slug</label>
                <input type="text" name="post_slug" id="post_slug" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                       placeholder="Enter post slug">
            </div>

            <!-- Category Selection -->
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium dark:text-white">Category</label>
                <select name="category_id" id="category_id" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="" hidden>Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tags Selection -->
            <div class="mb-4">
                <label class="block text-sm font-medium dark:text-white">Tags:</label>
                <div class="grid grid-cols-2 gap-2 mt-2">
                    @foreach ($tags as $tag)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}" 
                                   class="w-5 h-5 border-gray-300 rounded focus:ring-blue-500">
                            <span class="text-sm dark:text-white">{{ $tag->tag_name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

             <!-- Content -->
             <div class="mb-4">
                <label for="post_content" class="block text-sm font-medium dark:text-white">Content</label>
                <textarea name="post_content" id="post_content" 
                          class="w-full px-4 py-3 h-40 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                          placeholder="Write your post content here..."></textarea>
            </div>
               <!-- Published Checkbox -->
               <div class="mb-4">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="is_published" id="is_published" value="1" 
                           class="w-5 h-5 border-gray-300 rounded focus:ring-blue-500">
                    <span class="text-sm dark:text-white">Publish this post</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" 
                        class="w-full py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                    Create Post
                </button>
                <button type="submit" 
                        class="w-full mt-2 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                    <a href="{{ route('posts.index') }}">
                    Back</a>
                </button>
            </div>
        </form>
    </div>
</body>
</html>
@endsection
