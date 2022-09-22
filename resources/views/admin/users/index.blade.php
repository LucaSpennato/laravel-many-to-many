@extends('layouts.app')

@section('title', '| Users')

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
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        @forelse ($users as $user)
                        
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>
                                    <a href="{{ route('admin.users.show', $user->id) }}">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->userDetails->phone }}</td>
                                <td>
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-success">User info</a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" class="d-inline delete-form"
                                        data-name="{{ $user->name }}">
                                        @csrf 
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <h5>
                            Non ci sono utenti.
                        </h5>
                        @endforelse
                        </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection