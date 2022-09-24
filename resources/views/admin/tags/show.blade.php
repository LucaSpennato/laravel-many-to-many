@extends('layouts.app')

@section('title', '| Tag: ' . $tag->name)

@section('content')

    <main>
        <div class="container">
            <div class="row">
                @if (session('status-change'))
                    <div class="col-12 alert {{ session('class') }}">
                        {{ session('status-change') }}
                    </div>
                @endif

                <div class="card m-auto mt-5 p-1" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-title fs-1 text-center text-success">
                            {{ $tag->name }}
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-primary">Edit</a>

                            <form action="{{ route('admin.posts.destroy', $tag->id) }}" method="post" class="delete-form"
                                data-name="{{ $tag->name }}">
                                @csrf 
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger d-block m-auto">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row col-10 m-auto justify-content-center">
                {{-- ? ho passato il dato dal controller usando la relazione, volendo qua si puù usare $tag->posts --}}
                @forelse ($posts as $post)
                    @include('admin.tags.includes.post', compact('post'))
                @empty
                    <h2>
                        Non ci sono post in questo tag.
                    </h2>
                @endforelse
            </div>
        </div>
    </main>

@endsection
