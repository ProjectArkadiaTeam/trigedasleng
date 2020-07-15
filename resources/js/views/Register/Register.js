import React, {Component} from 'react';
import RegisterContainer from './RegisterContainer';
import {withRouter} from "react-router-dom";

class Register extends Component {
	constructor(props) {
		super(props);
		this.state = {
			redirect: props.location,
		}
	}
	render() {
		return (
			<div className="content">
				<RegisterContainer redirect={this.state.redirect} />
			</div>
		)
	}
}
export default withRouter(Register)