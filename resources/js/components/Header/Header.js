import React, {Component} from 'react';
import {Link, withRouter} from 'react-router-dom';
import {Navbar, Nav, Form, FormControl} from 'react-bootstrap';
import Autosuggest from 'react-autosuggest';

class Header extends Component {

	/**
	 * Constructor
	 * @param props
	 */
	constructor(props) {
		super(props);
		this.logOut = this.logOut.bind(this);

		this.state = {
			value: '',
			suggestions: [],
			navExpanded: false
		};

		this.setNavExpanded = this.setNavExpanded.bind(this);
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

	// https://developer.mozilla.org/en/docs/Web/JavaScript/Guide/Regular_Expressions#Using_Special_Characters
	escapeRegexCharacters(str) {
		return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
	}

	getSuggestions(value) {
		const escapedValue = this.escapeRegexCharacters(value.trim());

		if (escapedValue === '') {
			return [];
		}

		const regex = new RegExp('^' + escapedValue, 'i');

		let data = [
			{
				'title': 'words',
				'results' : this.props.dictionary,
			},
			{
				'title' : 'translations',
				'results' : this.props.translations,
			}
		];

		return data
			.map(section => {
				return {
					title: section.title,
					results: section.results.filter(result => regex.test(result.word) || regex.test(result.trigedasleng)).slice(0,5)
				};
			})
			.filter(section => section.results.length > 0)
	}

	getSuggestionValue(suggestion) {
		if (suggestion.word !== undefined)
			return suggestion.word;
		else
			return suggestion.trigedasleng;
	}

	renderSuggestion(suggestion) {
		return (
			<span>{suggestion.word}{suggestion.trigedasleng}</span>
		);
	}

	renderSectionTitle(section) {
		return (
			<strong>{section.title}</strong>
		);
	}

	getSectionSuggestions(section) {
		return section.results;
	}

	onSuggestionsFetchRequested = ({ value }) => {
		this.setState({
			suggestions: this.getSuggestions(value)
		});
	};

	onSuggestionsClearRequested = () => {
		this.setState({
			suggestions: []
		});
	};

	onChange = (event, { newValue, method }) => {
		const {location, onSearch} = this.props;
		this.setState({
			value: newValue
		});

		if(newValue.length < 3)
			newValue = "";

		onSearch(newValue);
	};

	handleSubmit = (e) => {
		e.preventDefault();
		this.closeNav();
		this.props.history.push('/search/'+this.state.value)
	};

	setNavExpanded(expanded) {
		this.setState({ navExpanded: expanded });
	};

	closeNav() {
		this.setState({ navExpanded: false });
	};

	/**
	 * Render the header
	 * @returns {*}
	 */
	render() {
		const {location, onSearch} = this.props;
		const { value, suggestions } = this.state;
		const inputProps = {
			placeholder: "Search",
			value,
			onChange: this.onChange
		};

		return (
			<Navbar collapseOnSelect onToggle={this.setNavExpanded} expanded={this.state.navExpanded} bg="dark" variant="dark" expand="md" fixed="top">
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
					<Form className="form-inline my-2" onSubmit={this.handleSubmit}>
						<Autosuggest
							multiSection={true}
							suggestions={suggestions}
							onSuggestionsFetchRequested={this.onSuggestionsFetchRequested}
							onSuggestionsClearRequested={this.onSuggestionsClearRequested}
							getSuggestionValue={this.getSuggestionValue}
							renderSuggestion={this.renderSuggestion}
							renderSectionTitle={this.renderSectionTitle}
							getSectionSuggestions={this.getSectionSuggestions}
							inputProps={inputProps} />
						);
					</Form>
				</Navbar.Collapse>
			</Navbar>
		)
	}
}

export default withRouter(Header)
