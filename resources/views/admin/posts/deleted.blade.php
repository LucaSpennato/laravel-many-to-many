@extends('layouts.app')

@section('title', 'Deleted posts')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.posts.includes.table')
        </div>
    </div>

@endsection