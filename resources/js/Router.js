import React, { Suspense, lazy } from 'react';
import {BrowserRouter, Link, Route, Switch} from 'react-router-dom';

const Home = lazy(() => import('./views/Home'));
const Login = lazy(() => import('./views/Login/Login'));
const Grammar = lazy(() => import('./views/Grammar'));
const Register = lazy(() => import('./views/Register/Register'));
const NotFound = lazy(() => import('./views/Errors/NotFound'));
const WordView = lazy(() => import('./views/WordView'));
const Dictionary = lazy(() => import('./views/Dictionary/Dictionary'));
const Translations = lazy(() => import('./views/Translations'));


// User is LoggedIn
import PrivateRoute from './PrivateRoute'

const Main = props => (
<Suspense fallback={<div>Loading...</div>}>
    <Switch>
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
);
export default Main;
