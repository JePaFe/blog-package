<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Post</title>
</head>
<body>
@if (session('status'))
    <p>{{ session('status') }}</p>
@endif
<h1>{{ $post->title }}</h1>
<div style="white-space: pre-wrap;">{{ $post->body }}</div>
<div>
    <a href="{{ route('admin.posts.edit', $post) }}">Edit Post</a>
    <a href="{{ route('admin.posts.index') }}">Back</a>
</div>
</body>
</html>
