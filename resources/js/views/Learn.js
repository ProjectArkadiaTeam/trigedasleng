import React from 'react';
import {Component} from "react";
import Word from "../components/Word";
import {Row, Col} from "react-bootstrap";

class Card extends React.Component {

	constructor() {
		super();
		this.state = {
			showAnswer: false
		}
	}

	render() {
		const content = this.state.showAnswer ? this.props.backContent : this.props.frontContent;
		const iconClass = this.state.showAnswer ? 'reply' : 'share';
		const cardClass = this.state.showAnswer ? 'back' : '';
		const contentClass = this.state.showAnswer ? 'back' : 'front';
		const actionClass = this.state.showAnswer ? 'active' : '';

		return (
			<div
				className={`card ${cardClass}`}
				onClick={() => this.setState({showAnswer: !this.state.showAnswer})}
			>
				<div
					className='card-flip-card'
					onClick={ () => {
						this.setState({showAnswer: !this.state.showAnswer});
					}}
				>

					<span className={`fa fa-${iconClass}`}/>
				</div>
				<div className={`card-content-${contentClass}`}>
					{content}
				</div>
				{this.state.showAnswer ?
				<div className={`card-actions ${actionClass}`}>
					<div
						className='card-next-button'
						onClick={() => {
							this.props.showNextCard();
							this.setState({showAnswer: false});
						}}
					>
						Next
					</div>
				</div> : ""}
			</div>
		);
	}
}

class CardContainer extends React.Component {
	constructor(props) {
		super(props);
		this.boundShowNextCard = this.showNextCard.bind(this);
		this.state = {
			cardNumber: undefined,
		}
	}

	componentDidMount() {
		if (this.state.cardNumber === undefined && this.props.dictionary.length > 0){
			this.showNextCard();
		}
	}

	componentDidUpdate(prevProps, prevState, snapshot) {
		if (this.state.cardNumber === undefined && this.props.dictionary.length > 0){
			this.showNextCard();
		}
	}

	showNextCard() {
		this.setState({
			cardNumber: Math.floor(Math.random() * this.props.dictionary.length),
		})
	}

	generateCard() {
		const {dictionary} = this.props;
		if(this.state.cardNumber === undefined) return "Loading";
		const randomWord = dictionary[this.state.cardNumber];
		return (
			<Card
				frontContent={randomWord.word}
				backContent={<Word word={randomWord}/>}
				showNextCard={this.boundShowNextCard}
			/>
		);
	}
	render() {
		return (
			<>
			{this.generateCard()}
			</>
		);
	}
}

class Learn extends Component {
	constructor(props) {
		super(props);
	}

	componentDidUpdate(prevProps, prevState, snapshot) {
		if (prevProps !== this.props) {
			this.render()
		}
	}

	generateCardContainers() {
		const groups = [
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
		return groups.map(group => {
			let words = this.props.dictionary.filter(entry => {
				return (group === "all" || entry.translation.split(":")[0] === group) && entry.filter === "canon"
			});
			return (
				<Col xs={12} sm={12} md={12} lg={6} key={group}>
					<h3>{group.toUpperCase()}</h3>
					<CardContainer dictionary={words}/>
				</Col>
			)
		})

	}

	render() {
		return (
			<div className="content">
				<div id="inner">
					{/*<CardContainer dictionary={this.props.dictionary}/>*/}
					<Row>
						{this.generateCardContainers()}
					</Row>
				</div>
			</div>
		);
	}
}

export default Learn