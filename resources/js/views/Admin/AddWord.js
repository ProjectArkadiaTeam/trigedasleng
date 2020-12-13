import React, { Component } from 'react';

class AddWord extends Component {

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
						<h1>Add new word</h1>
						<form name="form" method="post" action="">
							<strong>Word</strong><br/>
							<input type="text" name="trig" placeholder="Enter Word (in trig)" required /><br/>
							<strong>Translation</strong><br/>
							<input type="text" name="translation" placeholder="Enter Translation" required /><br/>
							<strong>Classification</strong><br/>
							<select name="class">
								<option value="none">none</option>
								<option value="noun">noun</option>
								<option value="pronoun">pronoun</option>
								<option value="verb">verb</option>
								<option value="adjective">adjective</option>
								<option value="adverb">adverb</option>
								<option value="conjunction">conjunction</option>
								<option value="preposition">preposition</option>
								<option value="interjection">interjection</option>
							</select><br/>
							<strong>Etymology</strong><br/>
							<input type="text" name="etymology" placeholder="Enter Etymology" /><br/>
							<strong>Dictionary</strong><br/>
							<select name="dictionary">
								<option value="canon">Canon</option>
								<option value="slakgedasleng">Slakgedasleng</option>
								<option value="noncanon">Noncanon</option>
							</select><br/>
							<strong>Source?</strong><br/>
							<input type="text" name="source" placeholder="Enter URL" /><br/>
							<p><input name="submit" type="submit" value="Submit" /></p>
						</form>
						{/*	TODO: Show status here! */}
					</div>
				</div>
			</div>
		)
	}
}
export default AddWord
