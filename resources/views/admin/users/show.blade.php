@extends('layouts.app')

@section('title', '| User: ' . $user->name)

@section('content')

    <main>
        <div class="container">
            <div class="row">
                @if (session('session-change'))
                    <div class="col-12 alert {{ session('class') }}">
                        {{ session('session-change') }}
                    </div>
                @endif
                <div class="col-12">
                    <div class="card m-auto mt-5 p-1" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-subtitle m-2">
                                User id:
                                {{ $user->id }}
                            </h5>
                            <h5 class="card-subtitle m-2">
                                User name
                                Name: {{ $user->name }}
                            </h5>
                            <h5 class="card-title m-2">
                                Title:
                                {{ $user->email }}
                            </h5>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" class="delete-form"
                                data-name="{{ $user->name }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger d-block m-auto">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                    @forelse ($posts as $post)
                    <div class="card col-3 mt-5 p-1 mx-2">
                        <img src="{{ $post->post_image }}" class="card-img-top" alt="{{ $post->title }}'s image">
                        <div class="card-body">
                            <h5 class="card-subtitle">
                                Author id:
                                Id:{{ $post->user_id }}
                            </h5>
                            <h5 class="card-subtitle">
                                Author name:
                                Name: {{ $post->user->name }}
                            </h5>
                            <h5 class="card-title">
                                Title:
                                {{ $post->title }}
                            </h5>
    
                            <p class="card-subtitle">
                                Published:
                                {{ $post->post_date }}
                            </p>
    
                            {{-- <p class="card-text">
                                Content:
                                {{ $post->post_content }}
                            </p> --}}
                            <p class="card-text">
                                Slug
                                {{ $post->slug }}
                            </p>
                            <div class="d-flex">
                                <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-primary m-auto">Show</a>
                            </div>
                        </div>
                    </div>
                    @empty
                       <h5>
                        Non ci sono post
                        </h5> 
                    @endforelse
                
            </div>
        </div>
    </main>

@endsection
