import React, {Component} from 'react';
import {withRouter} from "react-router-dom";

function NotFound() {
	return (
		<div>
			<div className="content">
				<h1 style={{display: 'flex', justifyContent: 'center'}}>Page not found!</h1>
				<h3 style={{display: 'flex', justifyContent: 'center'}}>The page you requested does not exist.</h3>
			</div>
		</div>
	)
}

export default withRouter(NotFound)

