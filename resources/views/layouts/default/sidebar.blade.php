<div class="sidenav">
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('dictionary.lookup') }}">Dictionary</a>
    <a href="{{ route('dictionary.lookup', ['canon']) }}">Canon Dictionary</a>
    <a href="{{ route('dictionary.lookup', ['slakgedasleng']) }}">Slakkru Dictionary</a>
    <a href="{{ route('dictionary.lookup', ['noncanon']) }}">Noncanon Dictionary</a>
    <a href="{{ route('translations') }}">Translations</a>
    <a href="{{ route('grammar') }}">Grammar</a>
    <a href="{{ route('sources') }}">Sources</a>
    @if(session('admin') && (int) session('admin') === 1)
        <div class="line"></div>
        <a href="{{ route('admin.word.add') }}">New Word</a>
        <a href="{{ route('admin.translation.add') }}">New Translation</a>
        <div class="line"></div>
    @endif
</div>a
