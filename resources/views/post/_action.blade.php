<a href="{{ route('admin.posts.show', $slug) }}">View</a>

<a href="{{ route('admin.posts.edit', $slug) }}">Edit</a>

<a href="{{ route('admin.posts.destroy', $slug) }}"
   onclick="event.preventDefault();
   document.getElementById('delete-form').submit();">
    Delete
</a>

<form id="delete-form" action="{{ route('admin.posts.destroy', $slug) }}" method="POST">
    @csrf
    {{ method_field('DELETE') }}
</form>
