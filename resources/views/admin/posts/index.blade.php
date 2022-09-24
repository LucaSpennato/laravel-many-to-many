@extends('layouts.app')

@section('title', '| Posts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                @if (session('status-change'))
                    <div class="alert {{ session('class') }}">
                        {{ session('status-change') }}
                    </div>
                @endif

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
                                        {{ $post->user->name }}
                                    </a>
                                </td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->post_date }}</td>
                                <td>
                                    <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-success">View</a>
                                    <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-primary">Edit</a>

                                    <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="post" class="d-inline delete-form"
                                        data-name="{{ $post->name }}">
                                        @csrf 
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <h5>
                            Non ci sono post.
                        </h5>
                        @endforelse
                        </tbody>
                </table>

            </div>
            <div class="col-10 m-auto d-flex justify-content-center mt-3">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection