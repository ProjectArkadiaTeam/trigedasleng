@extends('layouts.default.app')

@section('title', "{$translation->translation} - Edit")

@section('content')
    <div id="inner">
        <div id="admin-form">
            <h1>Editing id: {{ $translation->id }}</h1>
            <form name="form" method="post" action="{{ route('translation.edit.submit', [$translation->id]) }}">
                @csrf
                <input type="hidden" name="action" value="editword" />
                <input type="hidden" name="id" value="{{ $translation->id }}" />
                <strong>Sentence / Phrase</strong><br>
                <input type="text" name="trig" placeholder="Enter sentence (in trig)" value="{{ $translation->trigedasleng }}" required /><br>
                <strong>Translation</strong><br>
                <input type="text" name="translation" placeholder="Enter Translation" value="{{ $translation->translation }}" required /><br>
                <strong>Etymology</strong><br>
                <input type="text" name="etymology" placeholder="Enter Etymology" value="{{ $translation->etymology }}"/><br>
                <strong>Leipzig</strong><br>
                <input type="text" name="leipzig" placeholder="Enter Leipzig" value="{{ $translation->leipzig }}"/><br>
                <strong>Episode</strong><br>
                <input type="text" name="episode" placeholder="Enter Episode" value="{{ $translation->episode }}"/><br>
                <strong>Audio</strong><br>
                <input type="text" name="audio" placeholder="Enter Path to audio" value="{{ $translation->audio }}"/><br>
                <strong>Speaker</strong><br>
                <input type="text" name="speaker" placeholder="Enter Speaker" value="{{ $translation->speaker }}"/><br>
                <strong>Source? (use #id from <a href="{{ route('sources') }}">Sources</a>)</strong><br>
                <input type="text" name="source" placeholder="Enter #ID" value="@isset($source){{ $source->id }}@endisset" /><br>
                <p><input name="submit" type="submit" value="Submit" /></p>
            </form>
            @isset($status)
                <p style="color:#FF0000;">{{ $status }}</p>
            @endisset
        </div>
    </div>
@endsection
