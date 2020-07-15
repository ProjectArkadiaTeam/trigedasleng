import React, { Component, lazy, Suspense } from 'react';;
import { useParams } from "react-router-dom";

const Word = lazy(() => import('../../components/Word' /* webpackChunkName: "js/word" */))

// Apple devices running an iOS version earlier than 10
// does not support fetch, so we use a workaround
import 'whatwg-fetch';

// Define search function outside class so we can reach it from the Header
export function searchDict(query) {
	if (this !== undefined)
		this.setState({search: query})
}

class Dictionary extends Component {
	constructor(props) {
		super(props);
		this.state = {
			isLoggedIn: false,
			isAdmin: false,
			search: "",
			user: {},
			dictionary: [],
		}
		searchDict = searchDict.bind(this)
	}

	/* On first load */
	componentDidMount() {
		this.fetchDictionary();
	}

	/* Live switch dictionaries */
	componentDidUpdate(prevProps, prevState, snapshot) {
		window.scrollTo(0, 0)
		if (prevProps !== this.props) {
			this.render()
		}
	}

	/* Fetch API */
	fetchDictionary() {
		if (this.state.dictionary.length === 0) {

			// fetch
			fetch("/api/legacy/dictionary")
				.then(response => {
					return response.json();
				})
				.then(words => {
					// Fetched dictionary is stored in the state
					const sorted = words.sort((a, b) => a.word.toLowerCase() > b.word.toLowerCase() ? 1 : -1);
					this.setState({ dictionary: sorted });
				});
		}
	}



	/* Get filtered dictionary */
	getDictionary() {
		function applySearch(entry){
			return entry.word.toLowerCase().includes(search.toLowerCase())
				|| entry.translation.toLowerCase().includes(search.toLowerCase())
		}
		let dict = this.props.match.params.dictionary;
		let search = this.state.search;

		// dict will be undefined if no dictionary is given
		if (dict == null)
			return this.state.dictionary.filter(function (entry) {
				return applySearch(entry)
			}
		);

		// Filter based on dictionary type
		return this.state.dictionary.filter(function (entry) {
			return (dict === entry.filter.split(' ').find(val => val === dict)
			&& applySearch(entry))
		});
	}

	/* Render list of words */
	renderWords() {
		let lastChar = null;
		return this.getDictionary().map(word => {

			// Add section headers using the first letter
			// This is really ugly, if someone has a better idea please implement it!!!!
			const curChar = word.word.charAt(0).toUpperCase();
			const charDivider = curChar !== lastChar ? <a key="0" href={'#' + curChar}><h2 id={curChar}>{curChar}</h2></a> : '';
			lastChar = curChar;

			return (
				<React.Fragment key={word.id}>
					{charDivider}
					<Word word={word} />
				</React.Fragment>
			);
		})
	}

	/* Get headername for dictionary */
	DictionaryName() {
		let { dictionary } = useParams();
		return (<h1 style={{ textTransform: 'capitalize' }}>{dictionary} Dictionary</h1>);
	}

	/* Render page */
	render() {
		return (
			<div className="content dictionary">
				<this.DictionaryName/>
				<Suspense fallback={<h3>Receving data from the ark...</h3>} >
					{ this.renderWords() }
				</Suspense>
			</div>
		)
	}

}
export default Dictionary

