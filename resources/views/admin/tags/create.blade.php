@extends('layouts.app')

@section('title', 'New Tag')

@section('content')
    
    <main>
        <div class="container">
            <div class="row">
                <form action="{{ route('admin.tags.store') }}" method="post">
                    @csrf
                    @method('post')
                    @include('admin.tags.includes.form')
                </form>
            </div>
        </div>
    </main>

@endsection