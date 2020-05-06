@extends('layouts.default.app')

@section('title', 'Sources')

@section('content')
    <div id="inner">
        <h1>All Sources</h1>
        @foreach($sources as $source)

            <p class="entry" id="2014-11-06-01">
                @if(session('admin') && (int) session('admin') === 1)<i>ID#{{ $source->id }}</i>@endif {{ $source->author }} ({{ $source->date }}) <a href="{{ $source->url }}">{{ $source->title }}</a>
            </p>
        @endforeach
    </div>
@endsection
