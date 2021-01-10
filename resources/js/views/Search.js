import React, { Component, lazy, Suspense } from 'react';

const Word = lazy(() => import('../components/Word'));
const Translation = lazy(() => import('../components/Translation'));

// Apple devices running an iOS version earlier than 10
// does not support fetch, so we use a workaround
import 'whatwg-fetch';

class Search extends Component {
	constructor(props) {
		super(props);
		this.state = {};
	}

	componentDidMount() {
		if (this.props.search !== this.props.match.params.query){
			this.props.onSearch(this.props.match.params.query);
		}
	}

	componentDidUpdate(prevProps, prevState, snapshot) {
		if (prevProps.search !== this.props.search){
			this.props.history.push('/search/'+this.props.search)
		}
	}

	/** Get search results */
	getSearchResults() {
		const {dictionary, translations} = this.props;
		let search = this.props.search;

		function applySearch(entry){
			if(entry.word !== undefined) {
				return entry.word.toLowerCase().includes(search.toLowerCase())
					|| entry.translation.toLowerCase().includes(search.toLowerCase())
			} else {
				return entry.trigedasleng.toLowerCase().includes(search.toLowerCase())
					|| entry.translation.toLowerCase().includes(search.toLowerCase())
			}
		}

		let results = [];
		if (search.length < 3){
			results['words'] = [];
			results['translations'] = [];
			return results;
		}

		results['words'] = dictionary.filter(function (entry) {
			return applySearch(entry)
		});

		results['translations'] = translations.filter(function (entry) {
			return applySearch(entry)
		});

		return results;
	}

	/** Render list of words */
	renderWords() {
		return this.getSearchResults()['words'].map(word => {
			return (
				<React.Fragment key={word.id}>
					<Word word={word} />
				</React.Fragment>
			);
		})
	}

	/** Render list of translations */
	renderTranslations() {
		return this.getSearchResults()['translations'].map(translation => {
			return (
				<React.Fragment key={translation.id}>
					<Translation translation={translation} />
				</React.Fragment>
			);
		})
	}

	/** Render page */
	render() {
		return (
			<React.Fragment>
				<div className="content">
					<div id="inner">
						{this.props.search.length < 3 ? <h2>Minimum requirement for search is atleast 3 characters</h2> :
							<React.Fragment>
								<h2>Words matching your search</h2>
								<div className="dictionary">
									<Suspense fallback={<h3>Receving data from the ark...</h3>} >
										{ this.renderWords() }
									</Suspense>
								</div>
								<h2>Translations matching your search</h2>
								<div className="translations">
									{ this.props.isLoading ? "Loading" :
										<Suspense fallback={<h3>Receving data from the ark...</h3>} >
											{ this.renderTranslations() }
										</Suspense>
									}
								</div>
							</React.Fragment>
							}
					</div>
				</div>
			</React.Fragment>
		)
	}

}
export default Search

