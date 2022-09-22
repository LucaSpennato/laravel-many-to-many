<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Author</th>
            <th scope="col">Title</th>
            <th scope="col">Date</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        
        <tbody>
        @forelse ($posts as $post)
        
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>
                    <a href="{{ route('admin.posts.show', $post->slug) }}">
                        {{ $post->author }}
                    </a>
                </td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->post_date }}</td>
                @if (request()->routeIs('admin.posts.index'))
                    <td>
                        <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-primary">Edit</a>

                        <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="post" class="d-inline">
                            @csrf 
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                @endif
            </tr>
        @empty
        <h5>
            Non ci sono post.
        </h5>
        @endforelse
        </tbody>
</table>