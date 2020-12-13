import React, { Suspense, lazy, Component } from 'react';
import {Route, Switch} from 'react-router-dom';

// Everything is lazy loaded to allow for code splitting and faster initial load times
const Home = lazy(() => import('./views/Home' /* webpackChunkName: "js/Home" */));
const Login = lazy(() => import('./views/Login/Login' /* webpackChunkName: "js/Login" */));
const Grammar = lazy(() => import('./views/Grammar' /* webpackChunkName: "js/Grammar" */));
const Sources = lazy(() => import('./views/Sources' /* webpackChunkName: "js/Sources" */));
const Register = lazy(() => import('./views/Register/Register' /* webpackChunkName: "js/Register" */));
const NotFound = lazy(() => import('./views/Errors/NotFound' /* webpackChunkName: "js/NotFound" */));
const WordView = lazy(() => import('./views/WordView' /* webpackChunkName: "js/WordView" */));
const Dictionary = lazy(() => import('./views/Dictionary/Dictionary' /* webpackChunkName: "js/Dictionary" */));
const Translations = lazy(() => import('./views/Translations/Translations' /* webpackChunkName: "js/Translations" */));

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
import Translation from "./components/Translation";

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
			search: ""
		}
	}

	updateSearch = (e) => {
		e.preventDefault();
		this.setState({search: e.target.value})
	};

	render(){
		return(
			<React.Fragment>
				<PWAPrompt/>
				{console.log(this.state.isLoggedIn)}
				<Header userData={this.state.userData} userIsLoggedIn={this.state.isLoggedIn} onSearch={this.updateSearch}/>
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
								<Translations {...props} search={this.state.search} />
							)}
						/>
						<Route exact path='/grammar' component={Grammar}/>
						<Route exact path='/sources' component={Sources}/>
						<Route
							exact path='/dictionary'
						   	render={(props) => (
								<Dictionary {...props} search={this.state.search} />
						   	)}
						/>
						<Route
							path='/dictionary/:dictionary'
							render={(props) => (
								<Dictionary {...props} search={this.state.search} />
							)}
						/>
						<Route exact path='/word' component={WordView}/>
						<Route path='/word/:word' component={WordView}/>
						<Route component={NotFound} />
					</Switch>
				</Suspense>
				<Footer/>
			</React.Fragment>
		);
	}
}

export default Main;
