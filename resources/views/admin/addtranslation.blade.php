@extends('layouts.default.app')

@section('title', "Add Translation")

@section('content')
    <div id="inner">
        <div id="admin-form">
            <h1>Add new translation</h1>
            <form name="form" method="post" action="">
                @csrf
                <strong>Trigedasleng</strong><br>
                <input type="text" name="trig" placeholder="Enter Trigedasleng" required /><br>
                <strong>Translation</strong><br>
                <input type="text" name="translation" placeholder="Enter Translation" required /><br>
                <strong>Etymology</strong><br>
                <input type="text" name="etymology" placeholder="Enter Etymology" /><br>
                <strong>Leipzig</strong><br>
                <input type="text" name="leipzig" placeholder="Enter Leipzig" /><br>
                <strong>Episode (blank if 'other')</strong><br>
                <input type="text" name="episode" placeholder="0602 => Season 6 Episode 2" /><br>
                <strong>Speaker</strong><br>
                <input type="text" name="speaker" placeholder="Octavia?" /><br>
                <strong>Audio</strong><br>
                <input type="text" name="audio" placeholder="audio/s2/<clipname>.mp3" /><br>
                <strong>Source?</strong><br>
                <input type="text" name="source" placeholder="Enter URL" /><br>
                <p><input name="submit" type="submit" value="Submit" /></p>
            </form>
            @isset($status)
                <p style="color:#FF0000;">{{ $status }}</p>
            @endisset
        </div>
    </div>
@endsection
