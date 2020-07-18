import React, { Component, lazy, Suspense } from 'react';;
import {Button, Col, DropdownButton, Dropdown, Row} from "react-bootstrap";
import { useParams } from "react-router-dom";
import { isMobile, MobileView } from "react-device-detect";

const Word = lazy(() => import('../../components/Word' /* webpackChunkName: "js/word" */))

// Apple devices running an iOS version earlier than 10
// does not support fetch, so we use a workaround
import 'whatwg-fetch';

// Define search function outside class so we can reach it from the Header
export function searchDict(query) {
	if (this !== undefined)
		this.setState({search: query})
}

const wordClasses = [
	"all",
	"noun",
	"pronoun",
	"verb",
	"adverb",
	"adjective",
	"conjunction",
	"preposition",
	"interjection",
	"auxiliary"
	];

class Dictionary extends Component {
	constructor(props) {
		super(props);
		this.state = {
			isLoggedIn: false,
			isAdmin: false,
			user: {},
			search: "",
			classFilter: "all",
			showFilterButtons: !isMobile,
			dictionary: [],
		}
		searchDict = searchDict.bind(this)
	}

	/** On first load */
	componentDidMount() {
		this.fetchDictionary();
	}

	/** Live switch dictionaries */
	componentDidUpdate(prevProps, prevState, snapshot) {
		window.scrollTo(0, 0)
		if (prevProps !== this.props) {
			this.render()
		}
	}

	/** Fetch API */
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



	/** Get filtered dictionary */
	getDictionary() {
		let dict = this.props.match.params.dictionary;
		let search = this.state.search;
		let classFilter = this.state.classFilter;

		function applySearch(entry){
			return entry.word.toLowerCase().includes(search.toLowerCase())
				|| entry.translation.toLowerCase().includes(search.toLowerCase())
		}

		function applyClassFilter(entry){
			return classFilter === "all" || entry.translation.split(":")[0] === classFilter;
		}

		// dict will be undefined if no dictionary is given
		if (dict == null)
			return this.state.dictionary.filter(function (entry) {
				return applySearch(entry)
			}
		);

		// Filter based on dictionary type
		return this.state.dictionary.filter(function (entry) {
			return (dict === entry.filter.split(' ').find(val => val === dict)
			&& applySearch(entry) && applyClassFilter(entry))
		});
	}

	/** Update state to load selected season */
	renderWordClass(wordClass){
		this.setState({classFilter: wordClass})
		if(isMobile)
			this.setState({showFilterButtons: false})
	}

	/** Renders the word class select buttons */
	wordClassSelect(){
		return (
			<React.Fragment>
				<MobileView>
					<Row xs={1} className="justify-content-md-center">
						<Col key="showFilter" xl={1} lg={1} md={1}><Col md={12} as={Button} onClick={() => this.setState({showFilterButtons: !this.state.showFilterButtons})}>Filter</Col></Col>
					</Row>
				</MobileView>
				{this.state.showFilterButtons ?
				<Row xs={2} sm={2} className="justify-content-md-center">
					{
						wordClasses.map(wordClass => {
							return (
								<Col key={wordClass} xl={1} lg={2} md={3}><Col md={12} as={Button} onClick={() => this.renderWordClass(wordClass)}>{wordClass}</Col></Col>
							)
						})
					}
				</Row> : ''}
			</React.Fragment>
		)
	}

	/** Render list of words */
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

	/** Get headername for dictionary */
	DictionaryName() {
		let { dictionary } = useParams();
		return (<h1 style={{ textTransform: 'capitalize' }}>{dictionary} Dictionary</h1>);
	}

	/** Render page */
	render() {
		return (
			<div className="content dictionary">
				{this.wordClassSelect()}
				<this.DictionaryName/>
				<Suspense fallback={<h3>Receving data from the ark...</h3>} >
					{ this.renderWords() }
				</Suspense>
			</div>
		)
	}

}
export default Dictionary

