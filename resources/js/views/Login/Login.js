import React, {Component} from 'react';
import LoginContainer from './LoginContainer';
import Header from '../../components/Header/Header';
import Footer from '../../components/Footer/Footer';
import {withRouter} from "react-router-dom";
import Sidebar from '../../components/Sidebar/Sidebar';
class Login extends Component {
  constructor(props) {
    super(props);
    this.state = {
      redirect: props.location,
    };
  }
  render() {
    return (
      <div>
        <Header userData={this.state.user} userIsLoggedIn={this.state.isLoggedIn}/>
        <Sidebar/>
        <div className="content">
            <LoginContainer redirect={this.state.redirect} />
        </div>
        <Footer/>
      </div>
    )
  } 
}
export default withRouter(Login)