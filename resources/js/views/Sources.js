import React, {Component} from 'react'

class Sources extends Component {
	constructor() {
		super();
		this.state = {
			isLoggedIn: false,
			isAdmin: false,
			user: {},
			sources: [],
		}
	}

	fetchSourceList() {
		// If we already have data cached skip
		if (this.state.sources.length === 0) {
			// fetch using the API
			// TODO: Once the new api is in switch to that
			fetch("/api/legacy/sources")
				.then(response => {
					return response.json();
				})
				.then(sources => {
					// Fetched data is stored in the state
					this.setState({ sources: sources });
				});
		}
	}

	componentDidMount() {
		this.fetchSourceList();
	}

	// check if user is authenticated and storing authentication data as states if true
	UNSAFE_componentWillMount() {
		let state = localStorage["appState"];
		if (state) {
			let AppState = JSON.parse(state);
			this.setState({ isLoggedIn: AppState.isLoggedIn, user: AppState.user });
		}
	}

	render() {
		return (
			<div className="content">
				<div id="inner">
					<h1>All Sources</h1>
					{ this.state.sources.map((source, index) =>
						<p className="entry" key={index}>
							{source.author} ({source.date}) <a href={source.url}>{source.title}</a>
						</p>
					)
					}
				</div>
			</div>
		)
	}
}

export default Sources
