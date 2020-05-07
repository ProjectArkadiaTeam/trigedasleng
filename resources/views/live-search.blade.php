@if($words->isEmpty() && $translations->isEmpty())
    No matches found for {{ $keyword }}
@else
    @php($count = 0)

    @if($words->isNotEmpty())
        @foreach($words as $word)
            @if($count <= 10)
                <p>{{ $word->word }}</p>
                @php($count++)
            @endif
        @endforeach
    @endif

    @if($translations->isNotEmpty())
        @foreach($translations as $translation)
            @if($count <= 10)
                <p>{{ $translation->trigedasleng }}</p>
                @php($count++)
            @endif
        @endforeach
    @endif
@endif
