@extends('layouts.app')
@section('post_contents')
<!DOCTYPE html>
<html lang="en">
<head>
@vite(['resources/js/app.js','resources/css/app.css'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
    <thead>
    <tr>
        <th>Category</th>
        <th>Title</th>
        <th>Content</th>
        <th>Tag</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <tr>
     @foreach($posts as $post)
        <td>{{$post->category->category_name}}</td>
        <td>{{$post->post_title}}</td>
        <td>{{$post->post_content}}</td>
        <td>{{$post->tags->pluck('tag_name')->implode('tag_name')}}</td>
        <td><a href="{{route('posts.show', $post)}}">Read more</a></td>
    </tr> 
    @endforeach
     </tbody>
    </table>
        <a href="{{route('posts.create', $post)}}">Create New Post</a>

</body>
</html>
<script src = ".node_modules/preline/dist/preline.js"></script>
