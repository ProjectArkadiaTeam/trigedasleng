@extends('layouts.default.app')

@section('title', "{$word->word} - Edit")

@section('content')
    <div id="inner">
        <div id="admin-form">
            <h1>Edit {{ $word->word }}</h1>
            <form name="form" method="post" action="{{ route('word.edit.submit', [$word->word]) }}">
                @csrf
                <input type="hidden" name="action" value="editword" />
                <input type="hidden" name="id" value="{{ $word->id }}" />
                <strong>Word</strong><br>
                <input type="text" name="trig" placeholder="Enter Word (in trig)" value="{{ $word->word }}" required /><br>
                <strong>Translation</strong><br>
                <input type="text" name="translation" placeholder="Enter Translation" value="{{ $word->translation }}" required /><br>
                <strong>Etymology</strong><br>
                <input type="text" name="etymology" placeholder="Enter Etymology" value="{{ $word->etymology }}"/><br>
                <strong>Dictionary</strong><br>
                <input type="text" name="dictionary" placeholder="Enter Dictionaries" value="{{ $word->filter }}"/><br>
                <strong>Source? (use #id from <a href="{{ route('sources') }}">Sources</a>)</strong><br>
                <input type="text" name="source" placeholder="Enter #ID" value="@isset($citation){{ $citation->id }}@endisset" /><br>
                <p><input name="submit" type="submit" value="Submit" /></p>
            </form>
            @isset($status)
                <p style="color:#FF0000;">{{ $status }}</p>
            @endisset
        </div>
    </div>
@endsection
