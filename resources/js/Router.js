import React, { Suspense, lazy } from 'react';
import {Route, Switch} from 'react-router-dom';

// Everything is lazy loaded to allow for code splitting and faster initial load times
const Home = lazy(() => import('./views/Home' /* webpackChunkName: "js/Home" */));
const Login = lazy(() => import('./views/Login/Login' /* webpackChunkName: "js/Login" */));
const Grammar = lazy(() => import('./views/Grammar' /* webpackChunkName: "js/Grammar" */));
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

const Main = props => (
	<React.Fragment>
		<PWAPrompt/>
		<Header userData={props.userData} userIsLoggedIn={props.isLoggedIn}/>
		<Sidebar/>
		<Suspense fallback={<div>Loading...</div>}>
			<Switch>
				<PrivateRoute exact path='/admin/addtranslation' component={AddTranslation}/>
				<PrivateRoute exact path='/admin/addword' component={AddWord}/>
				<Route exact path='/' component={Home}/>
				<Route exact path='/login' component={Login}/>
				<Route exact path='/register' component={Register}/>
				<Route exact path='/translations' component={Translations}/>
				<Route exact path='/grammar' component={Grammar}/>
				<Route exact path='/dictionary' component={Dictionary}/>
				<Route path='/dictionary/:dictionary' component={Dictionary}/>
				<Route exact path='/word' component={WordView}/>
				<Route path='/word/:word' component={WordView}/>
				<Route component={NotFound} />
			</Switch>
		</Suspense>
		<Footer/>
	</React.Fragment>
);
export default Main;
