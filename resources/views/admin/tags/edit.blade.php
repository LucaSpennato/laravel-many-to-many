@extends('layouts.app')

@section('title', 'Edit post')

@section('content')
    
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.tags.update', $tag->id) }}" method="post">
                        @csrf
                        @method('put')
                        @include('admin.tags.includes.form')
                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection