@extends('layouts.app')

@section('title', '| Tags')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                {{-- ? print dei singoli count dalla quryt $dist in controller index --}}
                {{-- <ul>
                @foreach ($dist as $di)
                    <li>
                        {{ $di->id }} - posts: {{ $di->posts_count }}
                    </li> 
                @endforeach
                </ul> --}}
                @if (session('status-change'))
                    <div class="alert {{ session('class') }}">
                        {{ session('status-change') }}
                    </div>
                @endif
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">New Tag</a>
                    </li>
                </ul>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Posts</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        @forelse ($tags as $tag)
                        
                            <tr>
                                <th scope="row">{{ $tag->id }}</th>
                                <td>
                                    <a href="{{ route('admin.tags.show', $tag->id) }}">
                                        {{ $tag->name }}
                                    </a>
                                </td>
                                {{-- ? conteggia i post presenti nel tag usando la relazione tra tag e posts --}}
                                <td>{{ $tag->posts->count() }}</td>
                                <td>
                                    <a href="{{ route('admin.tags.show', $tag->id) }}" class="btn btn-success">Tag info</a>
                                    <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-primary">Edit Tag</a>

                                    <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="post" class="d-inline delete-form"
                                        data-name="{{ $tag->name }}">
                                        @csrf 
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <h5>
                            Non ci sono tags.
                        </h5>
                        @endforelse
                        </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection