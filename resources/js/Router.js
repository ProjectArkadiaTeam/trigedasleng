import React from 'react';
import {BrowserRouter, Link, Route, Switch} from 'react-router-dom';

import Home from './components/Home';
import Login from './views/Login/Login';
import Register from './views/Register/Register';
import NotFound from './views/Errors/NotFound';
import Dictionary from './views/Dictionary/Dictionary';
import Translations from './views/Translations';
import Grammar from './views/Grammar';


// User is LoggedIn
import PrivateRoute from './PrivateRoute'

const Main = props => (
<Switch>
  <Route exact path='/' component={Home}/>
  <Route exact path='/login' component={Login}/>
  <Route exact path='/register' component={Register}/>
  <Route exact path='/translations' component={Translations}/>
  <Route exact path='/grammar' component={Grammar}/>
  <Route exact path='/dictionary' component={Dictionary}/>
  <Route path='/dictionary/:dictionary' component={Dictionary}/>
  <Route component={NotFound} />
    {/* <Route path='/dictionary/:dictionary' component={Dictionary} />
  <Route path='/word/:word' component={Word} /> */}
</Switch>
);
export default Main;
