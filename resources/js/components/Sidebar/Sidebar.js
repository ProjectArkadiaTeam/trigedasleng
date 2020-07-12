import React, {Component} from 'react';
import {Link, NavLink, withRouter} from 'react-router-dom';
class Sidebar extends Component {

  constructor(props) {
    super(props);
      this.state = {
        user: props.userData,
        isLoggedIn: props.userIsLoggedIn,
        isAdmin: props.userIsAdmin
      };
  }

  render() {
    return (
      <div id="wrapper" className="d-none d-md-block toggled">
          <div id="sidebar-wrapper">
              <ul className="sidebar-nav">
                <li><NavLink exact activeClassName="activeLink" to="/">Home</NavLink></li>
                <li><NavLink exact activeClassName="activeLink" to="/dictionary">Dictionary</NavLink></li>
                <li><NavLink exact activeClassName="activeLink" to="/dictionary/canon">Canon Dictionary</NavLink></li>
                <li><NavLink exact activeClassName="activeLink" to="/dictionary/slakgedasleng">Slakkru Dictionary</NavLink></li>
                <li><NavLink exact activeClassName="activeLink" to="/dictionary/noncanon">Noncanon Dictionary</NavLink></li>
                <li><NavLink exact activeClassName="activeLink" to="/translations">Translations</NavLink></li>
                <li><NavLink exact activeClassName="activeLink" to="/grammar">Grammar</NavLink></li>
                <li><NavLink exact activeClassName="activeLink" to="/sources">Sources</NavLink></li>
              </ul>
          </div>
      </div>
    )
  }
}
export default withRouter(Sidebar)
