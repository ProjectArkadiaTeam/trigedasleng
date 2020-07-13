import React, { Component, Suspense, lazy } from 'react';
import Header from '../components/Header/Header';
import Footer from '../components/Footer/Footer';
import Sidebar from '../components/Sidebar/Sidebar';
import Translation from '../components/Translation';

const Word = lazy(() => import('../components/Word'))
// const Translation = lazy(() => import('../components/Translation'))

// Apple devices running an iOS version earlier than 10
// does not support fetch, so we use a workaround
import 'whatwg-fetch';

class WordView extends Component {

	constructor() {
		super();
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
		console.log(word)

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
			<>
				<Header />
				<Sidebar />
				<div className="content">
					<div id="inner">
						{this.state.wordInfo.length != 0 ?
							<React.Fragment>
								<Suspense fallback={<div>Loading...</div>}>
									<Word word={this.state.wordInfo.word} />

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

                                    {/* Only show notes if there are some */}
                                    {this.state.wordInfo.word.note != "" ? <>
									<strong>Notes:</strong>
									<p>{this.state.wordInfo.word.note}</p>
                                    </> : ''}

									<h3>Source:</h3>
									{/* Only show source if there is one */}
                                    {this.state.wordInfo.word.note != "" ?
                                    <a href={this.state.wordInfo.source.url}>{this.state.wordInfo.source.title}</a>
                                    : <p>None</p>}
								</Suspense>
							</React.Fragment>
							: <div>Loading...</div>}
					</div>
				</div>
				<Footer />
			</>
		)
	}
}
export default WordView
