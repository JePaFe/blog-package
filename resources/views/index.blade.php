<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
</head>
<body>
<h1>Blog</h1>
@foreach($posts as $post)
    <h2><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h2>
    <div style="white-space: pre-wrap;">{{ Str::limit($post->body) }}</div>
@endforeach
{{ $posts->links() }}
</body>
</html>
