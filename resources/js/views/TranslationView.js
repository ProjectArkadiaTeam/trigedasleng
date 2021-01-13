import React, { Component, Suspense, lazy } from 'react';
import Translation from '../components/Translation';

// Apple devices running an iOS version earlier than 10
// does not support fetch, so we use a workaround
import 'whatwg-fetch';
import {Link} from "react-router-dom";

class TranslationView extends Component {

	constructor(props) {
		super(props);
		this.state = {
			isLoggedIn: false,
			isAdmin: false,
			user: {},
			info: [],
		}
	}

	/* fetch API */
	getTranslationInfo() {
		let id = this.props.match.params.id;
		return this.props.translations.find(e => e.id === id)
	}

	render() {
		return (
			<div className="content">
				<div id="inner">
					{!this.props.isLoading && this.getTranslationInfo() !== undefined ?
						<React.Fragment>
							<Suspense fallback={<div>Loading...</div>}>
								<Translation translation={this.state.info}/>

								<h3>Source:</h3>
								{/* Only show source if there is one */}
								{this.state.info.source != null ?
									<a href={this.state.info.source.url}>{this.state.info.source.title}</a>
									: <p>None</p>}
							</Suspense>
						</React.Fragment>
						: <div>Loading...</div>}
				</div>
			</div>
		)
	}
}
export default TranslationView
