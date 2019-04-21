@extends('app')

@section('content')
    <ul>
        @foreach($users as $user)
            <li>
                 {!! link_to_route('user_info_path',$user->name,[$user->id]) !!} - {{ $user->email }}
            </li>
        @endforeach
    </ul>

    {!! $users->render() !!}
@stop
