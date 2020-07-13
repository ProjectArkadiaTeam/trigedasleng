import React, { Component } from 'react'
import Header from '../components/Header/Header';
import Footer from '../components/Footer/Footer';
import Sidebar from '../components/Sidebar/Sidebar.js';
import { Link } from 'react-router-dom';
import PWAPrompt from 'react-ios-pwa-prompt';

class Home extends Component {
	constructor() {
		super();
		this.state = {
			isLoggedIn: false,
			isAdmin: false,
			user: {}
		}
	}
	// check if user is authenticated and storing authentication data as states if true
	componentWillMount() {
		let state = localStorage["appState"];
		if (state) {
			let AppState = JSON.parse(state);
			this.setState({ isLoggedIn: AppState.isLoggedIn, user: AppState.user });
		}
	}

	render() {
		return (
			<>
                <PWAPrompt />
				<Sidebar />
				<Header userData={this.state.user} userIsLoggedIn={this.state.isLoggedIn} />
				<div className="content">
					<div id="inner">
						<div className="row">
							<div className="col-lg col-md-12 column">
								<h3>Recently Added</h3>
								<ul>
									{/* @foreach($recentWordList as $recentWord)
                                <li><a href="{{ route('word.lookup', [$recentWord->word]) }}">{{ $recentWord->word }}</a></li>
                        @endforeach */}
								</ul>
							</div>
							<div className="col-lg-6 col-md-12 column">
								<div className="daily">
									<h3>About this website</h3>
									<p>This website is an attempt at recreating what was Trigedasleng.info after it went dark in december 2018.</p>
								</div>
								<div className="daily">
									<h3>Random Word</h3>
									{/*<Word word={}/>*/}
								</div> */}
                <div className="daily">
									<h3>Random Translation</h3>
									{/* <div className="translations entry unflagged">
                            <table class="gloss">
                                    <tbody>
                                    <tr class="tgs_text">
                                            <td colspan="10"><a href="#">{{ $randomTranslation->trigedasleng }}</a></td>
                                    </tr>
                                    <tr class="tgs" style="display: table-row;">
                                            @foreach(explode(' ', $randomTranslation->trigedasleng) as $word)
                                                    <td>{{ $word }}</td>
                                            @endforeach
                                    </tr>
                                    <tr class="ety" style="display: table-row;">
                                            @foreach(explode(' ', $randomTranslation->etymology) as $word)
                                                    <td>{{ $word }}</td>
                                            @endforeach
                                    </tr>
                                    <tr class="leipzig" style="display: table-row;">
                                            @foreach(explode(' ', $randomTranslation->leipzig) as $word)
                                                    <td>{{ $word }}</td>
                                            @endforeach
                                    </tr>
                                    <tr class="en_text">
                                            <td colspan="10">{{ $randomTranslation->translation }}</td>
                                    </tr>
                                    </tbody>
                            </table>
                            @if($randomTranslation->audio !== '')
                                    <audio controls="" preload="none">
                                            <source src="{{ $randomTranslation->audio }}" type="audio/mpeg">
                                    </audio>
                            @endif
                    </div> */}
								</div>
							</div>
							<div className="col-lg col-md-12 column">
								<h3>Resources:</h3>
								<ul id="resources">
									<li><Link to="https://en.wikipedia.org/wiki/Trigedasleng">Trigedasleng on Wikipedia</Link></li>
									<li><Link to="https://dedalvs.tumblr.com/tagged/Trigedasleng">Dedalvs Tumblr</Link></li>
									<li><Link to="http://dedalvs.com/work/the-100/trigedasleng_master_dialogue.pdf">Transcripts of Trig lines in the show</Link></li>
									<li><Link to="http://www.memrise.com/course/957902/trigedasleng/">Memrise course</Link></li>
									<li><Link to="https://www.youtube.com/watch?v=JCoxlcHn7SQ&list=PLrk1St_BRZTFrhOYsz2KRS_fZ9ZzTavrq">Slakkru's Learn Trigedasleng videos </Link></li>
									<li><Link to="http://slakgedakru.tumblr.com/">Slakgedakru</Link></li>
									<li><Link to="https://discord.gg/MFnCpEB">Slakgedakru Discord Server</Link></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<Footer />
			</>
		)
	}
}
export default Home
