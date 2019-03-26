<div id="header">
    <div class="title">
        <h2 id="smalltitle">The Unofficial</h2>
        <h1 id="largetitle">Trigedasleng Dictionary</h1>
    </div>
    <div class="menu">
        <div class="menu-head" onclick="">Menu</div>
        <ul class="dropdown">
            <a href="./"><li>Home</li></a>
            <a href="./dictionary?filter=canon"><li>Canon Dictionary</li></a>
            <a href="./dictionary?filter=slakgedasleng"><li>Slakkru Dictionary</li></a>
            <a href="./dictionary?filter=noncanon"><li>Noncanon Dictionary</li></a>
            <a href="./grammar"><li>Grammar</li></a>
            <a href="./translations"><li>Translations</li></a>

        </ul>
    </div>
    <div class="search">
        <form action="search" method="get">
            <input type="text" placeholder="SEARCH" name="q">
        </form>
    </div>

    <?php if (!isset($_SESSION["username"])):?>
    <div id="login-signup">
        <ul>
        <li id="login">
            <a id="login-trigger" href="#">
                Log in <span>▼</span>
            </a>
            <div id="login-content">
                <form>
                <fieldset id="inputs">
                    <input id="username" type="username" name="Username" placeholder="Username" required>
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
    <?php else : ?>
    <div id="login-signup">
        <ul>
            <li id="signup">
                <a href="logout" onclick="signOut()">Log Out</a>
            </li>
        </ul>
    </div>
    <?php endif;?>
</div>