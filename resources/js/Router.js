import React, { Suspense, lazy, Component } from 'react';
import {Route, Switch, withRouter} from 'react-router-dom';

// Everything is lazy loaded to allow for code splitting and faster initial load times
const Home            = lazy(() => import('./views/Home'                      /* webpackChunkName: "js/Home" */));
const Login           = lazy(() => import('./views/Login/Login'               /* webpackChunkName: "js/Login" */));
const Grammar         = lazy(() => import('./views/Grammar'                   /* webpackChunkName: "js/Grammar" */));
const Sources         = lazy(() => import('./views/Sources'                   /* webpackChunkName: "js/Sources" */));
const Register        = lazy(() => import('./views/Register/Register'         /* webpackChunkName: "js/Register" */));
const NotFound        = lazy(() => import('./views/Errors/NotFound'           /* webpackChunkName: "js/NotFound" */));
const WordView        = lazy(() => import('./views/WordView'                  /* webpackChunkName: "js/WordView" */));
const TranslationView = lazy(() => import('./views/TranslationView'           /* webpackChunkName: "js/TranslationView" */));
const Dictionary      = lazy(() => import('./views/Dictionary/Dictionary'     /* webpackChunkName: "js/Dictionary" */));
const Translations    = lazy(() => import('./views/Translations/Translations' /* webpackChunkName: "js/Translations" */));
const Search          = lazy(() => import('./views/Search'                    /* webpackChunkName: "js/Search" */));

// Load Static elements normally as they are required
import Header from './components/Header/Header';
import Footer from './components/Footer/Footer';
import Sidebar from './components/Sidebar/Sidebar';

// iOS PWA Prompt
import PWAPrompt from 'react-ios-pwa-prompt';

// User is LoggedIn
import PrivateRoute from './PrivateRoute'
import AddTranslation from "./views/Admin/AddTranslation";
import AddWord from "./views/Admin/AddWord";
import Learn from "./views/Learn";

let state = localStorage["appState"];
let AppState = JSON.parse(state);

const Auth = {
	isLoggedIn: AppState.isLoggedIn,
	isAdmin: AppState.isAdmin,
	user: AppState
};

class Main extends Component {
	constructor(props) {
		super(props);
		this.state = {
			// Auth
			isLoggedIn: Auth.isLoggedIn !== undefined ? Auth.isLoggedIn : false,
			isAdmin: Auth.isAdmin !== undefined ? Auth.isAdmin : false,
			user: Auth.user !== undefined ? Auth.user : {},

			// Search
			search: "",

			// Data
			dictionary: [],
			translations: [],
			isLoading: false,
		}
	}

	/**
	 * Fetch translation data from the API endpoint.
	 * Translation data is saved when switching between
	 * dictionaries, so we dont have to fetch them everytime
	 **/
	fetchTranslations() {
		// If we already have translation data cached skip
		if (this.state.translations.length === 0 || this.state.translations.length === undefined) {
			// fetch using the API
			// TODO: Once the new api is in switch to that
			fetch("/api/legacy/translations")
				.then(response => {
					return response.json();
				})
				.then(translations => {
					// Fetched dictionary is stored in the state
					this.setState({ translations: translations, isLoading: false });
				});
		}
	}

	/** Fetch API */
	fetchDictionary() {
		if (this.state.dictionary.length === 0 || this.state.dictionary.length === undefined) {
			// fetch
			fetch("/api/legacy/dictionary")
				.then(response => {
					return response.json();
				})
				.then(words => {
					// Fetched dictionary is stored in the state
					const sorted = words.sort((a, b) => a.word.toLowerCase() > b.word.toLowerCase() ? 1 : -1);
					this.setState({ dictionary: sorted });
				});
		}
	}

	updateSearch = (query) => {
		this.setState({search: query})
	};

	/** On first load */
	componentDidMount() {
		this.fetchDictionary();
		this.fetchTranslations();
	}

	render(){
		return(
			<React.Fragment>
				<PWAPrompt/>
				<Header
					userData={this.state.userData}
					userIsLoggedIn={this.state.isLoggedIn}
					onSearch={this.updateSearch}
					dictionary={this.state.dictionary}
					translations={this.state.translations}
				/>
				<Sidebar/>
				<Suspense fallback={<div>Loading...</div>}>
					<Switch>
						<PrivateRoute exact path='/admin/addtranslation' component={AddTranslation}/>
						<PrivateRoute exact path='/admin/addword' component={AddWord}/>
						<Route exact path='/' component={Home}/>
						<Route exact path='/login' component={Login}/>
						<Route exact path='/register' component={Register}/>
						<Route
							exact path='/translations'
							render={(props) => (
								<Translations {...props}
									search={this.state.search}
									translations={this.state.translations}
									isLoading={this.state.isLoading}
								/>
							)}
						/>
						<Route path='/translation/:id'
						   render={(props) => (
							   <TranslationView {...props} isLoading={this.state.isLoading} translations={this.state.translations}/>
						   )}/>
						<Route exact path='/grammar' component={Grammar}/>
						<Route exact path='/sources' component={Sources}/>
						<Route
							exact path='/dictionary'
						   	render={(props) => (
								<Dictionary {...props} search={this.state.search} dictionary={this.state.dictionary} />
						   	)}
						/>
						<Route
							path='/dictionary/:dictionary'
							render={(props) => (
								<Dictionary {...props} search={this.state.search} dictionary={this.state.dictionary} />
							)}
						/>
						<Route exact path='/word' component={WordView}/>
						<Route path='/word/:word' component={WordView}/>
						<Route
							exact path='/search'
							render={(props) => (
								<Search {...props}
										search = {this.state.search}
										dictionary = {this.state.dictionary}
										translations = {this.state.translations}
										onSearch={this.updateSearch}
										isLoading={this.state.isLoading} />
							)}
						/>
						<Route
							path='/search/:query'
							render={(props) => (
								this.state.dictionary.length > 0 && this.state.translations ? <Search {...props}
										search = {this.state.search}
										dictionary = {this.state.dictionary}
										translations = {this.state.translations}
										onSearch={this.updateSearch}
										isLoading={this.state.isLoading} /> : "Loading"
							)}
						/>
						<Route
							exact path='/learn'
							render={(props) => (
								<Learn {...props} dictionary={this.state.dictionary} />
							)}
						/>
						<Route component={NotFound} />
					</Switch>
				</Suspense>
				<Footer/>
			</React.Fragment>
		);
	}
}

export default withRouter(Main);
