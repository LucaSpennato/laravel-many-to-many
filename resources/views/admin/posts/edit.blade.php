@extends('layouts.app')

@section('title', 'New Post')

@section('content')
    
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.posts.update', $post->slug) }}" method="post">
                        @csrf
                        @method('put')
                        @include('admin.posts.includes.form')
                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection