import React, {Component} from 'react';
import {Link, withRouter} from 'react-router-dom';
import {Navbar, Nav, Form, FormControl} from 'react-bootstrap';

import {searchDict} from './../../views/Dictionary/Dictionary';
import {searchTranslations} from '../../views/Translations/Translations';

class Header extends Component {

	/**
	 * Constructor
	 * @param props
	 */
	constructor(props) {
		super(props);
		this.logOut = this.logOut.bind(this);
	}

	/**
	 * Logout the user
	 */
	logOut() {
		const config = {
			headers: { Authorization: `Bearer ${this.state.user.access_token}` }
		};

		axios.get(
			'/api/v1/auth/logout',
			config
		);

		let appState = {
			isLoggedIn: false,
			user: {}
		};
		localStorage["appState"] = JSON.stringify(appState);
		this.setState(appState);
		this.props.history.push('/login');
		window.location.reload();
	}

	/**
	 * check if user is authenticated and storing authentication data as states if true
	 * @constructor
	 */
	UNSAFE_componentWillMount() {
		let state = localStorage["appState"];
		if (state) {
			let AppState = JSON.parse(state);
			this.setState({ isLoggedIn: AppState.isLoggedIn, user: AppState.user });
		}
	}

	/**
	 * Render the header
	 * @returns {*}
	 */
	render() {
		const {location, onSearch} = this.props;
		return (
			<Navbar collapseOnSelect bg="dark" variant="dark" expand="md" fixed="top">
				<Navbar.Brand href="/">Trigedasleng Dictionary</Navbar.Brand>
				<Navbar.Toggle aria-controls="basic-navbar-nav"/>
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
					{
						this.state.isLoggedIn ?
							<Nav className="">
								<Nav.Link onClick={() => this.logOut()} className="navbar-right">Logout</Nav.Link>
							</Nav> :
							<Nav className="">
								<Nav.Link href="/login" className="navbar-right">Login</Nav.Link>
								<Nav.Link href="/register" className="navbar-right">Signup</Nav.Link>
							</Nav>


					}
					<Form className="form-inline my-2">
						<FormControl className="mr-md-2"
									 type="search"
									 placeholder="Search"
									 aria-label="Search"
									 onChange={(e) => {
										 onSearch(e);
									 	//searchDict(e.target.value);
									 	//searchTranslations(e.target.value);
									 }}/>
					</Form>
				</Navbar.Collapse>
			</Navbar>
		)
	}
}

export default withRouter(Header)
