<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
</head>
<body>
<h1>Edit Post</h1>
<form action="{{ route('admin.posts.update', $post) }}" method="post">
    @csrf
    {{ method_field('PUT') }}
    <div>
        <label for="title">Title: </label>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
        @error('title')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="body">Body: </label>
        <textarea name="body" id="body">{{ old('body', $post->body) }}</textarea>
        @error('body')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <input type="submit">
    </div>
</form>
<div>
    <a href="{{ route('admin.posts.index') }}">Back</a>
</div>
</body>
</html>
