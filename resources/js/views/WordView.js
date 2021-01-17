import React, { Component, Suspense, lazy } from 'react';
import Translation from '../components/Translation';

import {Link} from "react-router-dom";

class WordView extends Component {

	constructor(props) {
		super(props);
		this.state = {
			isLoggedIn: false,
			isAdmin: false,
			user: {},
			wordInfo: [],
		}
	}

	/* On first load */
	componentDidMount() {
		this.fetchWordInfo();
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
					{this.state.wordInfo.length !== 0 ?
						<React.Fragment>
							<Suspense fallback={<div>Loading...</div>}>
								<h1><b><Link to={"/word/" + this.state.wordInfo.word[0].word}>{this.state.wordInfo.word[0].word}</Link></b></h1>
								<p><strong>Pronounciation:</strong> coming soon!</p>
								{
									this.state.wordInfo.word.map((word, index) =>
										<React.Fragment>
											<h3>{"Etymology " + (this.state.wordInfo.word.length > 1 ? (index + 1) : "")}</h3>
											<p className="definition" style={{marginBottom: "0px"}}>{word.translation}</p>
											<p className="etymology" >{word.etymology}</p>
											{
												word.filter.includes('noncanon') ?
													<i className="noncanon-warning">!!Not a canon word</i>
													: ''
											}

											{/* Only show notes if there are some */}
											{
												this.state.wordInfo.word[0].note !== "" ?
												<>
													<p><strong>Notes:</strong></p>
													<p>{this.state.wordInfo.word[index].note}</p>
												</> : ''
											}
										</React.Fragment>
									)
								}

								{/* Only show examples if there are some */}
								{this.state.wordInfo.examples.length > 0 ?
								<>
									<h3>Examples:</h3>
									<div style={{overflow: "auto"}}>
										{this.state.wordInfo.examples.map(translation => {
											return (<Translation translation={translation} key={translation.id} />)
										})}
									</div>
								</> : ''}

								<h3>Source:</h3>
								{/* Only show source if there is one */}
								{this.state.wordInfo.source != null ?
								<a href={this.state.wordInfo.source.url}>{this.state.wordInfo.source.title}</a>
								: <p>None</p>}
							</Suspense>
						</React.Fragment>
						: <div>Loading...</div>}
				</div>
			</div>
		)
	}
}
export default WordView
