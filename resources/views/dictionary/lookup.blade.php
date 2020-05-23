@extends('layouts.default.app')

@section('title', isset($dictionary) ? ucfirst($dictionary) . " Dictionary" : 'Dictionary')

@section('above-content')
    <!--Char selector to quick jump to section-->
    <div class="alphabet-selector">
        @foreach(range('A', 'Z') as $char)
            <a href="#{{ $char }}" id="abc">{{ $char }}</a>
        @endforeach
    </div>
@endsection
@section('content-class', 'dictionary')
@section('content-style', 'margin-top: 120px;')
@section('content')
    @isset($words)
        <h1>@isset($dictionary){{ ucfirst($dictionary) }}@endisset Dictionary</h1>
        @php($currentChar = null)

        @foreach($words as $word)
            @if(strtolower($word->word[0]) !== $currentChar)
                @php($currentChar = strtolower($word->word[0]))
                <a href="#{{ strtoupper($currentChar) }}"><h2 id="{{ strtoupper($currentChar) }}">{{ strtoupper($currentChar) }}</h2></a>
            @endif
            <div class="entry">
                <h3><b><a href="{{ route('word.lookup',[$word->word]) }}">{{ strtolower($word->word) }}</a></b></h3>
                <p class="definition">{{ $word->translation }}</p>
                <p class="etymology">{{ $word->etymology }}</p>
                @if(stripos($word->filter, 'noncanon') !== false)
                    @if($dictionary == ucfirst($dictionary))
                        <i class="noncanon-warning">!!Not a canon word</i>
                    @endif
                @endif
            </div>
        @endforeach
        <!--Fix for header link overshooting -->
        <script>
            (function($, window) {
                var adjustAnchor = function() {

                    var $anchor = $(':target'),
                        fixedElementHeight = 120;

                    if ($anchor.length > 0) {
                        $('html, body')
                        .stop()
                        .animate({
                            scrollTop: $anchor.offset().top - fixedElementHeight
                        }, 0);
                    }
                };

                $(window).on('hashchange load', function() {
                    adjustAnchor();
                });

            })(jQuery, window);
        </script>
    @else
        <h1>@isset($dictionary){{ ucfirst($dictionary) }}@endisset Dictionary does not exist.</h1>
    @endisset
@endsection
