import React, { Component, lazy, Suspense } from 'react';

const Word = lazy(() => import('../components/Word'));
const Translation = lazy(() => import('../components/Translation'));

const sleep = (milliseconds) => {
	return new Promise(resolve => setTimeout(resolve, milliseconds))
};
class Search extends Component {

	constructor(props) {
		super(props);
		this.state = {
			results: [] // For caching search results
		};
	}

	/**
	 * When component is mounted check our url for a search query
	 * This is needed for when someone directly accesses a search url
	 * instead of manually searching using the search field
	 */
	componentDidMount() {
		if(this.props.match.params.query === undefined) return;
		if (this.props.search !== this.props.match.params.query){
			this.props.onSearch(this.props.match.params.query);
		}

		// Give backend time to load
		// This is a hotfix and not a very nice one...
		sleep(2000).then(() => {
			this.props.onSearch(this.props.match.params.query);
		})
	}

	/**
	 * When the search value is updated, update the results array and url
	 * @param prevProps
	 * @param prevState
	 * @param snapshot
	 */
	componentDidUpdate(prevProps, prevState, snapshot) {
		if (prevProps.search !== this.props.search){
			this.props.history.push('/search/'+this.props.search);
			this.getSearchResults()
		}
	}


	/** Get search results */
	getSearchResults() {
		const {dictionary, translations} = this.props;
		let search = this.props.search;

		function applySearch(entry, exact){
			if(entry.word !== undefined) {
				if (exact)
					return entry.word.toLowerCase() === search.toLowerCase()
						|| entry.translation.toLowerCase() === search.toLowerCase();
				else
					return entry.word.toLowerCase().includes(search.toLowerCase())
						|| entry.translation.toLowerCase().includes(search.toLowerCase());
			} else {
				if (exact)
					return entry.trigedasleng.toLowerCase() === search.toLowerCase()
						|| entry.translation.toLowerCase() === search.toLowerCase();
				else
					return entry.trigedasleng.toLowerCase().includes(search.toLowerCase())
						|| entry.translation.toLowerCase().includes(search.toLowerCase())
			}
		}

		let results = [];

		results['words'] = dictionary.filter(function (entry) {
			return applySearch(entry, search.length < 3)
		});

		results['translations'] = translations.filter(function (entry) {
			return applySearch(entry, search.length < 3)
		});

		// Update cache and return
		this.setState({results: results} );
		this.render();
	}

	/** Render list of words */
	renderWords() {
		return this.state.results['words'].map(word => {
			return (
				<React.Fragment key={word.id}>
					<Word word={word} />
				</React.Fragment>
			);
		})
	}

	/** Render list of translations */
	renderTranslations() {
		return this.state.results['translations'].map(translation => {
			return (
				<React.Fragment key={translation.id}>
					<Translation translation={translation} />
				</React.Fragment>
			);
		})
	}

	hasResults(){
		return (this.state.results['words'] !== undefined && this.state.results['words'].length !== 0)
			 || (this.state.results['translations'] !== undefined && this.state.results['translations'].length !== 0);
	}

	/** Render page */
	render() {
		return (
			<React.Fragment>
				<div className="content">
					<div id="inner">
						{this.props.search.length < 2 ? <h2>Minimum requirement for search is atleast 2 characters</h2> :
							!this.hasResults() ? <h2>Your search "{this.props.search}" did not match any words or translations</h2> :
							<React.Fragment>
								{this.state.results['words'].length > 0 ?
									<React.Fragment>
									<h2>Words matching your search</h2>
									<div className="dictionary">
										<Suspense fallback={<h3>Receving data from the ark...</h3>} >
											{ this.renderWords() }
										</Suspense>
									</div>
									</React.Fragment>
								: "" }
								{this.state.results['translations'].length > 0 ?
									<React.Fragment>
									<h2>Translations matching your search</h2>
									<div className="translations">
										{ this.props.isLoading ? "Loading" :
											<Suspense fallback={<h3>Receving data from the ark...</h3>} >
												{ this.renderTranslations() }
											</Suspense>
										}
									</div>
									</React.Fragment>
								: "" }
							</React.Fragment>
							}
					</div>
				</div>
			</React.Fragment>
		)
	}

}
export default Search

