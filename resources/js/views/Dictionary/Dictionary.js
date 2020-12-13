import React, { Component, lazy, Suspense } from 'react';;
import {Button, Col, DropdownButton, Dropdown, Row} from "react-bootstrap";
import { useParams } from "react-router-dom";
import { isMobile, MobileView } from "react-device-detect";

const Word = lazy(() => import('../../components/Word' /* webpackChunkName: "js/word" */))

// Apple devices running an iOS version earlier than 10
// does not support fetch, so we use a workaround
import 'whatwg-fetch';

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
			classFilter: "all",
			showFilterButtons: !isMobile,
		};
	}


	/** On first load */
	componentDidMount() {
		//searchDict = searchDict.bind(this)
		//this.fetchDictionary();
	}

	componentWillUnmount() {
		// fix Warning: Can't perform a React state update on an unmounted component
		this.setState = (state,callback)=>{
			return;
		};
	}

	/** Live switch dictionaries */
	componentDidUpdate(prevProps, prevState, snapshot) {
		window.scrollTo(0, 0)
		if (prevProps !== this.props) {
			this.render()
		}
	}

	/** Get filtered dictionary */
	getDictionary() {
		const {dictionary} = this.props;

		if (dictionary.length === undefined)
			return [];

		let dict = this.props.match.params.dictionary;
		let search = this.props.search;
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
			return dictionary.filter(function (entry) {
				return applySearch(entry) && applyClassFilter(entry)
			}
		);

		// Filter based on dictionary type
		return dictionary.filter(function (entry) {
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
								<Col key={wordClass} xl={1} lg={2} md={3}><Col md={12} variant="dark" as={Button} onClick={() => this.renderWordClass(wordClass)}>{wordClass}</Col></Col>
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

