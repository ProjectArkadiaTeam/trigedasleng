import React, {Component} from 'react';
import {NavLink, withRouter} from 'react-router-dom';
class Sidebar extends Component {

	constructor(props) {
		super(props);
		this.state = {
			user: props.userData,
			isLoggedIn: props.userIsLoggedIn,
			isAdmin: props.userIsAdmin
		};
	}

	fetchUserInfo(access_token) {
		const config = {
			headers: { Authorization: `Bearer ${access_token}` }
		};

		axios.get(
			'http://localhost:8000/api/v1/auth/me',
			config
		).then((response) => {
			console.log(response.data.group.admin);
			this.setState({isAdmin: (response.data.group.admin === 1)})
		}).catch(console.log);
	}

	// check if user is authenticated and storing authentication data as states if true
	UNSAFE_componentWillMount() {
		let state = localStorage["appState"];
		if (state) {
			let AppState = JSON.parse(state);
			this.setState({ isLoggedIn: AppState.isLoggedIn, user: AppState.user })

			if (AppState.isLoggedIn)
				this.fetchUserInfo(AppState.user.access_token);
		}

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
						{ this.state.isAdmin ?
							<>
								<div className="line"/>
								<li><NavLink exact activeClassName="activeLink" to="/admin/addword">Add Word</NavLink></li>
								<li><NavLink exact activeClassName="activeLink" to="/admin/addtranslation">Add Translation</NavLink></li>
								<div className="line"/>
							</> : ""
						}
					</ul>
				</div>
			</div>
		)
	}
}
export default withRouter(Sidebar)
