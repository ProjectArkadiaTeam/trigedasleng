@extends('layouts.default.app')

@section('title', 'Profile')

@section('content')
    <div id="inner">
        <h1>Username</h1>
        <h3>{{ $user->username }}</h3>
        <h1>Email</h1>
        <h3>{{ $user->email }}</h3>
        <h1>Group</h1>
        <h3>{{ $user->group->name }}</h3>
    </div>
@endsection
