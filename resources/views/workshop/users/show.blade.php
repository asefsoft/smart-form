@extends('app')

@section('content')
    <h2>User Info</h2>
    <article>
        <ul>
            <li>Name: {{$user->name}}</li>
            <li>Email: {{$user->email}}</li>
            <li>Joined at: {{$user->created_at}}</li>
        </ul>
    </article>

    <hr>

    <a href="{{ route('users_path') }}">
    <button class="btn btn-primary">Back</button>
    </a>
@stop