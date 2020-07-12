import React, {Component} from 'react';
import {Link, withRouter} from 'react-router-dom';
import { Navbar, Nav, Form, FormControl, Button } from 'react-bootstrap';
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
    const { location } = this.props;
    return (
        <Navbar collapseOnSelect bg="dark" variant="dark" expand="md" fixed="top">
					<Navbar.Brand href="/">Trigedasleng Dictionary</Navbar.Brand>
					<Navbar.Toggle aria-controls="basic-navbar-nav" />
					<Navbar.Collapse id="basic-navbar-nav">
						<Nav className="mr-auto" activeKey={location.pathname}>
							<Nav.Link eventKey="1" as={Link} to="/" className="d-md-none">Home</Nav.Link>
							<Nav.Link eventKey="1" as={Link} to="/dictionary" className="d-md-none">Dictionary</Nav.Link>
							<Nav.Link eventKey="1" as={Link} to="/dictionary/canon" className="d-md-none">Canon Dictionary</Nav.Link>
							<Nav.Link eventKey="1" as={Link} to="/dictionary/slakgedasleng" className="d-md-none">Slakkru Dictionary</Nav.Link>
							<Nav.Link eventKey="1" as={Link} to="/dictionary/noncanon" className="d-md-none">Noncanon Dictionary</Nav.Link>
							<Nav.Link eventKey="1" as={Link} to="/grammar" className="d-md-none">Grammar</Nav.Link>
							<Nav.Link eventKey="1" as={Link} to="/translations" className="d-md-none">Translations</Nav.Link>
						</Nav>
						<Nav className="" >
							<Nav.Link href="/login" className="navbar-right">Login</Nav.Link>
							<Nav.Link href="/register" className="navbar-right">Signup</Nav.Link>
						</Nav>
						<Form className="form-inline my-2">
							<FormControl className="mr-md-2" type="search" placeholder="Search" aria-label="Search" />
						</Form>
					</Navbar.Collapse>
        </Navbar>
    )
  }
}
export default withRouter(Header)
