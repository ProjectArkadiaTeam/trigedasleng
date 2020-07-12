import React, {Component} from 'react';
import RegisterContainer from './RegisterContainer';
import Header from '../../components/Header/Header';
import Footer from '../../components/Footer/Footer';
import {withRouter} from "react-router-dom";
import Sidebar from '../../components/Sidebar/Sidebar';
class Register extends Component {
  constructor(props) {
    super(props);
    this.state = {
      redirect: props.location,
    }
  }
  render() {
    return (
        <div>
        <Header userData={this.state.user} userIsLoggedIn={this.state.isLoggedIn}/>
        <Sidebar/>
        <div className="content">
            <RegisterContainer redirect={this.state.redirect} />
        </div>
        <Footer/>
      </div>
    )
  }
}
export default withRouter(Register)