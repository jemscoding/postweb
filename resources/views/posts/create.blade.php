@extends('layouts.app')
@section('post_contents')
<form action="{{ route('posts.store') }}" enctype = "multipart/form-data" method="POST">
    @csrf
    <label for="title">Title:</label>
    <input type="text" name="post_title" id="post_title" required><br><br>

    <label for="content">Content:</label>
    <textarea name="post_content" id="post_content" required></textarea><br><br>

    <label for="category_id">Category:</label>
    <select name="category_id" id="category_id" required>
        <option value="">Select a category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name}}</option>
        @endforeach
    </select><br><br>

    <label for="tags">Tags:</label><br>
    @foreach ($tags as $tag)
        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
        <label for="tag-{{ $tag->id }}">{{ $tag->tag_name }}</label><br>
    @endforeach<br><br>

    <button type="submit">Create Post</button>
    <button type = "submit"><a href = "{{ route('posts.index') }}">Back </a></button>
</form>
