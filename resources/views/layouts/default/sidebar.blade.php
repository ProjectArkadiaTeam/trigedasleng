<div class="sidenav">
    <a href="./">Home</a>
    <a href="./dictionary?filter=canon">Canon Dictionary</a>
    <a href="./dictionary?filter=slakgedasleng">Slakkru Dictionary</a>
    <a href="./dictionary?filter=noncanon">Noncanon Dictionary</a>
    <a href="./translations">Translations</a>
    <a href="./grammar">Grammar</a>
    <a href="./sources">Sources</a>
    @if(session('admin') && session('admin') === '1')
        <div class="line"></div>
        <a href="./admin?action=addword">New Word</a>
        <a href="./admin?action=addtranslation">New Translation</a>
        <div class="line"></div>
    @endif
</div>
