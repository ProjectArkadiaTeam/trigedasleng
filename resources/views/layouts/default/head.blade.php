<div id="header">
    <div class="title">
        <h2 id="smalltitle">The Unofficial</h2>
        <h1 id="largetitle">Trigedasleng Dictionary</h1>
    </div>
    <div class="menu">
        <div class="menu-head" onclick="">Menu</div>
        <ul class="dropdown">
            <a href="{{ route('home') }}"><li>Home</li></a>
            <a href="{{ route('dictionary.lookup') }}"><li>Canon Dictionary</li></a>
            <a href="{{ route('dictionary.lookup', ['canon']) }}"><li>Canon Dictionary</li></a>
            <a href="{{ route('dictionary.lookup', ['slakgedasleng']) }}"><li>Slakkru Dictionary</li></a>
            <a href="{{ route('dictionary.lookup', ['noncanon']) }}"><li>Noncanon Dictionary</li></a>
            <a href="{{ route('grammar') }}"><li>Grammar</li></a>
            <a href="{{ route('translations') }}"><li>Translations</li></a>
        </ul>
    </div>
    <div class="search">
        <form action="{{ route('search') }}" method="get" autocomplete="off">
            <input type="text" placeholder="SEARCH" name="q">
        </form>
        <div class="result"></div>
    </div>
    @if(!session('username'))
        <div id="login-signup">
            <ul>
                <li id="login">
                    <a id="login-trigger" href="#">
                        Log in <span>▼</span>
                    </a>
                    <div id="login-content">
                        <form>
                            <input type="hidden" id="_login" value="{{ csrf_token() }}">
                            <fieldset id="inputs">
                                <input id="username" type="username" name="Username" placeholder="Email" required>
                                <input id="password" type="password" name="Password" placeholder="Password" required>
                            </fieldset>
                            <fieldset id="actions">
                                <input type="submit" id="loginbtn" value="Login">
                                <label><input type="checkbox" checked="checked"> Keep me signed in</label>
                            </fieldset>
                        </form>
                    </div>
                </li>
                <li id="signup">
                    <a href="signup">Sign up</a>
                </li>
            </ul>
        </div>
    @else
        <div id="login-signup">
            <ul>
                <li id="signup">
                    <input type="hidden" id="_logout" value="{{ csrf_token() }}">
                    <a href="logout" onclick="signOut()">Log Out</a>
                </li>
            </ul>
            <ul>
                <li>
                    <div style="height:40px;">
                        <a href="{{ route('profile') }}"><i class="far fa-user-circle fa-2x fa-align-center" style="line-height:40px;cursor:pointer;"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    @endif
</div>
