import React, { Component } from 'react'
import {Link} from "react-router-dom";
import Translation from "../components/Translation";
import Word from "../components/Word";

class Home extends Component {
	constructor(props) {
		super(props);
		this.state = {
			recent: [],
			random: []
		}
	}

	fetchRecentList() {
		// If we already have data cached skip
		if (this.state.recent.length === 0) {
			// fetch using the API
			// TODO: Once the new api is in switch to that
			fetch("/api/legacy/recent?limit=10")
				.then(response => {
					return response.json();
				})
				.then(recent => {
					// Fetched data is stored in the state
					this.setState({ recent: recent });
				});
		}
	}

	fetchRandom() {
		// If we already have data cached skip
		if (this.state.recent.length === 0) {
			// fetch using the API
			// TODO: Once the new api is in switch to that
			fetch("/api/legacy/random")
				.then(response => {
					return response.json();
				})
				.then(random => {
					// Fetched data is stored in the state
					this.setState({ random: random });
				});
		}
	}

	componentDidMount() {
		this.fetchRecentList();
		this.fetchRandom();
	}

	render() {
		return (
			<div className="content">
				<div id="inner">
					<div className="row" style={{minHeight: "100%",	padding: "20px 0 20px 0"}}>
						<div className="col-lg col-md-12 column">
							<h3>Recently Added</h3>
							<ul>
								{ this.state.recent.map((recent, index) =>
									<li key={index}><Link to={"/word/" + recent.word}>{recent.word}</Link></li>
								)
								}
							</ul>
						</div>
						<div className="col-lg-6 col-md-12 column">
							<div className="daily">
								<h3>About this website</h3>
								<p>Welcome to the Unofficial Trigedasleng Dictionary.</p>
								<p>
									Trigedasleng is a constructed language (conlang) developed by David J. Peterson for
									use on the CW show The 100. The Woods Clan (Trigedakru/Trikru) and Sand Nomads (Sanskavakru)
									have been heard using this language, but other groups of grounders (that is, earth-born
									people not born inside Mt. Weather) may also speak the language. Some of the Sky People
									(Skaikru; those from the Ark) began to learn Trigedasleng after repeated contact with the Trigedakru.
								</p>
							</div>
							<div className="daily">
								<h3>Random Word</h3>
								{ this.state.random.word !== undefined ? <Word word={this.state.random.word}/> : '' }
							</div>
							<div className="daily" style={{overflow: "auto"}}>
								<h3>Random Translation</h3>
								{ this.state.random.translation !== undefined ? <Translation translation={this.state.random.translation}/> : '' }
							</div>
						</div>
						<div className="col-lg col-md-12 column">
							<h3>Resources:</h3>
							<ul id="resources">
								<li><a href="//en.wikipedia.org/wiki/Trigedasleng" target="_blank">Trigedasleng on Wikipedia</a></li>
								<li><a href="//dedalvs.tumblr.com/tagged/Trigedasleng"  target="_blank">Dedalvs Tumblr</a></li>
								<li><a href="//dedalvs.com/work/the-100/trigedasleng_master_dialogue.pdf" target="_blank">Transcripts of Trig lines in the show</a></li>
								<li><a href="//www.memrise.com/course/957902/trigedasleng/"  target="_blank">Memrise course</a></li>
								<li><a href="//www.youtube.com/watch?v=JCoxlcHn7SQ&list=PLrk1St_BRZTFrhOYsz2KRS_fZ9ZzTavrq" target="_blank">Slakkru's Learn Trigedasleng videos </a></li>
								<li><a href="//slakgedakru.tumblr.com/"  target="_blank">Slakgedakru</a></li>
								<li><a href="//discord.gg/MFnCpEB" target="_blank">Slakgedakru Discord Server</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		)
	}
}
export default Home
