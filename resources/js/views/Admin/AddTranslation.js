import React, { Component } from 'react';

class AddTranslation extends Component {

	constructor(props) {
		super(props);
		this.state = {
			isLoggedIn: false,
			isAdmin: false,
			user: {},
			wordInfo: [],
		}
	}

	/* fetch API */
	fetchWordInfo() {
		let word = this.props.match.params.word;
		let api = '/api/legacy/lookup?query=' + word;

		// fetch
		fetch(api)
			.then(response => {
				return response.json();
			})
			.then(data => {
				// Fetched wordInfo is stored in the state
				this.setState({ wordInfo: data });
			});
	}

	render() {
		return (
			<div className="content">
				<div id="inner">
					<div id="admin-form">
						<h1>Add new translation</h1>
						<form name="form" method="post" action="">
							<strong>Trigedasleng</strong><br/>
							<input type="text" name="trig" placeholder="Enter Trigedasleng" required /><br/>
							<strong>Translation</strong><br/>
							<input type="text" name="translation" placeholder="Enter Translation" required /><br/>
							<strong>Etymology</strong><br/>
							<input type="text" name="etymology" placeholder="Enter Etymology" /><br/>
							<strong>Leipzig</strong><br/>
							<input type="text" name="leipzig" placeholder="Enter Leipzig" /><br/>
							<strong>Episode (blank if 'other')</strong><br/>
							<input type="text" name="episode" placeholder="0602 => Season 6 Episode 2" /><br/>
							<strong>Speaker</strong><br/>
							<input type="text" name="speaker" placeholder="Octavia?" /><br/>
							<strong>Audio</strong><br/>
							<input type="text" name="audio" placeholder="audio/s2/<clipname>.mp3" /><br/>
							<strong>Source?</strong><br/>
							<input type="text" name="source" placeholder="Enter URL" /><br/>
							<p><input name="submit" type="submit" value="Submit" /></p>
						</form>
						{/*	TODO: Show Status HERE!! */}
					</div>
				</div>
			</div>
		)
	}
}
export default AddTranslation
