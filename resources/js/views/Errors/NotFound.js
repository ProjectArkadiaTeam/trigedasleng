import React, {Component} from 'react';
import Header from '../../components/Header/Header';
import Footer from '../../components/Footer/Footer';
import {withRouter} from "react-router-dom";
import Sidebar from '../../components/Sidebar/Sidebar';
class NotFound extends Component {
  constructor() {
    super();
    this.state = {
      isLoggedIn: false,
      isAdmin: false,
      user: {}
    }
  }
  // check if user is authenticated and storing authentication data as states if true
  componentWillMount() {
    let state = localStorage["appState"];
    if (state) {
      let AppState = JSON.parse(state);
      this.setState({ isLoggedIn: AppState.isLoggedIn, user: AppState.user });
    }
  }

  render() {
    return (
      <div>
        <Header userData={this.state.user} userIsLoggedIn={this.state.isLoggedIn}/>
        <Sidebar/>
        <div className="content">
          <h1 style={{display: 'flex', justifyContent: 'center'}}>Page not found!</h1>
          <h3 style={{display: 'flex', justifyContent: 'center'}}>The page you requested does not exist.</h3>
        </div>
        <Footer/>
      </div>
    )
  }
}
export default withRouter(NotFound)

