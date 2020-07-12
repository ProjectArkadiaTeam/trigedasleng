import React, {Component} from 'react';
import {Link, withRouter} from 'react-router-dom';
class Header extends Component {

  constructor(props) {
    super(props);
      this.state = {
        user: props.userData,
        isLoggedIn: props.userIsLoggedIn
      };
      this.logOut = this.logOut.bind(this);
  }

  logOut() {
    let appState = {
      isLoggedIn: false,
      user: {}
    };
    localStorage["appState"] = JSON.stringify(appState);
    this.setState(appState);
    this.props.history.push('/login');
  }

  render() {
    const aStyle = {
      cursor: 'pointer'
    };
    
    return (
        <div id="header">
            <div className="title">
                <h2 id="smalltitle">The Unofficial</h2>
                <h1 id="largetitle">Trigedasleng Dictionary</h1>
            </div>
            <div className="menu">
                <div className="menu-head" onClick="">Menu</div>
                <ul className="dropdown">
                    <Link to="{{ route('home') }}"><li>Home</li></Link>
                    <Link to="{{ route('dictionary.lookup') }}"><li>Dictionary</li></Link>
                    <Link to="{{ route('dictionary.lookup', ['canon']) }}"><li>Canon Dictionary</li></Link>
                    <Link to="{{ route('dictionary.lookup', ['slakgedasleng']) }}"><li>Slakkru Dictionary</li></Link>
                    <Link to="{{ route('dictionary.lookup', ['noncanon']) }}"><li>Noncanon Dictionary</li></Link>
                    <Link to="{{ route('grammar') }}"><li>Grammar</li></Link>
                    <Link to="{{ route('translations') }}"><li>Translations</li></Link>
                </ul>
            </div>
            <div className="search">
                <form action="{{ route('search') }}" method="get" autoComplete="off">
                    <input type="text" placeholder="SEARCH" name="q" />
                </form>
                <div className="result"></div>
            </div>
            {!this.state.isLoggedIn ?
                <div id="login-signup">
                    <ul>
                        <li id="login">
                            <a id="login-trigger" href="#">
                                Log in <span>▼</span>
                            </a>
                            <div id="login-content">
                                <form>
                                    <input type="hidden" id="_login" value="{{ csrf_token() }}" />
                                    <fieldset id="inputs">
                                        <input id="username" type="username" name="Username" placeholder="Username" required />
                                        <input id="password" type="password" name="Password" placeholder="Password" required />
                                    </fieldset>
                                    <fieldset id="actions">
                                        <input type="submit" id="loginbtn" value="Login" />
                                        <label><input type="checkbox" checked="checked" /> Keep me signed in</label>
                                    </fieldset>
                                </form>
                            </div>
                        </li>
                        <li id="signup">
                            <a href="signup">Sign up</a>
                        </li>
                    </ul>
                </div>
            : ""}
            {this.state.isLoggedIn ? 
                <div id="login-signup">
                    <ul>
                        <li id="signup">
                            <input type="hidden" id="_logout" value="{{ csrf_token() }}" />
                            <a href="logout" onClick="signOut()">Log Out</a>
                        </li>
                    </ul>
                </div>
            : ""}
        </div>
    )
  }
}
export default withRouter(Header)