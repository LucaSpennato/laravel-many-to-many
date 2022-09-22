@extends('layouts.app')

@section('title', 'New Post')

@section('content')
    
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.posts.store') }}" method="post">
                        @csrf
                        @method('post')
                        @include('admin.posts.includes.form')
                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection