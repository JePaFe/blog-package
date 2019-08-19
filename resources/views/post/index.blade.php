<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
</head>
<body>
@if (session('status'))
    <p>{{ session('status') }}</p>
@endif
<a href="{{ route('admin.posts.create') }}">Create Post</a>
<table class="table table-bordered" id="data-table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Actions</th>
    </tr>
    </thead>
</table>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(function () {
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.posts.index') !!}',
            columns: [
                {data: 'id'},
                {data: 'title'},
                {data: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'desc']],
        });

        document.addEventListener('click', function (event) {
            if (!event.target.classList.contains('destroy')) return;

            event.preventDefault(event)

            if (confirm('Are you sure?')) {
                fetch(event.target.href, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-Token': '{!! csrf_token() !!}'
                    }
                }).then(() => window.location.href = "/admin/posts")
            }
        }, false);
    });
</script>
</body>
</html>
