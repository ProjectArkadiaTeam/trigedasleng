import React, { Component, lazy, Suspense } from 'react';
import { Row, Col, Button } from 'react-bootstrap';
import InfiniteScroll from 'react-infinite-scroller';

// Apple devices running an iOS version earlier than 10
// does not support fetch, so we use a workaround
import 'whatwg-fetch';

// import Translation from '../components/Translation';
const Translation = lazy(() => import('../components/Translation' /* webpackChunkName: "js/Translation" */))

const seasonList = {
    "01": "Season 1",
    "02": "Season 2",
    "03": "Season 3",
    "04": "Season 4",
    "05": "Season 5",
    "06": "Season 6",
    "07": "Season 7",
    "other": "Other"
}

const episodeList = {
    "0201": "S2E01: The 48",
    "0202": "S2E02: Inclement Weather",
    "0203": "S2E03: Reapercussions",
    "0204": "S2E04: Many happy returns",
    "0205": "S2E05: Human Trials",
    "0206": "S2E06: Fog of War",
    "0207": "S2E07: Long Into An Abyss",
    "0208": "S2E08: Spacewalker",
    "0209": "S2E09: Remember Me",
    "0210": "S2E10: Survival of the Fittest",
    "0211": "S2E11: Coup de Grace",
    "0212": "S2E12: Rubicon",
    "0213": "S2E13: Resurrection",
    "0214": "S2E14: Bodyguard of Lies",
    "0215": "S2E15: Blood Must Have Blood: Part 1",
    "0216": "S2E16: Blood Must Have Blood: Part 2",
    "0301": "S3E01: Wanheda: Part 1",
    "0302": "S3E02: Wanheda: Part 2",
    "0303": "S3E03: Ye Who Enter Here",
    "0304": "S3E04: Watch The Throne",
    "0305": "S3E05: Hakeldama",
    "0306": "S3E06: Bitter Harvest",
    "0307": "S3E07: Thirteen",
    "0308": "S3E08: Terms And Conditions",
    "0309": "S3E09: Stealing Fire",
    "0310": "S3E10: Fallen",
    "0311": "S3E11: Nevermore",
    "0312": "S3E12: Demons",
    "0313": "S3E13: Join or Die",
    "0314": "S3E14: Red Sky at Morning",
    "0315": "S3E15: Perverse Instantiation: Part 1",
    "0316": "S3E16: Perverse Instantiation: Part 2",
    "0401": "S4E01: Echoes",
    "0402": "S4E02: Heavy Lies the Crown",
    "0403": "S4E03: The Four Horsemen",
    "0404": "S4E04: A Lie Guarded",
    "0405": "S4E05: The Tinder Box",
    "0406": "S4E06: We Will Rise",
    "0407": "S4E07: Gimme Shelter",
    "0408": "S4E08: God Complex",
    "0409": "S4E09: DNR",
    "0410": "S4E10: Die all, Die Merrily",
    "0411": "S4E11: The Other Side",
    "0412": "S4E12: The Chosen",
    "0413": "S4E13: Praimfaya",
    "0501": "S5E01: Eden",
    "0502": "S5E02: Red Queen",
    "0503": "S5E03: Sleeping Giants",
    "0504": "S5E04: Pandora's Box",
    "0505": "S5E05: Shifting Sands",
    "0506": "S5E06: Exit Wounds",
    "0507": "S5E07: Acceptable Losses",
    "0508": "S5E08: How We Get to Peace",
    "0509": "S5E09: Sic Semper Tyrannis",
    "0510": "S5E10: The Warriors Will",
    "0511": "S5E11: The Dark Year",
    "0512": "S5E12: Damocles – Part One",
    "0513": "S5E13: Damocles – Part Two",
    "0601": "S6E01: Sanctum",
    "0602": "S6E02: Red Sun Rising",
    "0603": "S6E03: The Children of Gabriel",
    "0604": "S6E04: The Face Behind the Glass",
    "0605": "S6E05: The Gospel of Josephine",
    "0606": "S6E06: Memento Mori",
    "0607": "S6E07: Nevermind",
    "0608": "S6E08: The Old Man and the Anomaly",
    "0609": "S6E09: What You Take With You",
    "0610": "S6E10: Matryoshka",
    "0611": "S6E11: Ashes to Ashes",
    "0612": "S6E12: Adjustment Protocol",
    "0613": "S6E13: The Blood of Sanctum",
    "0701": "S7E01: From the Ashes",
    "0702": "S7E02: The Garden",
    "0703": "S7E03: False Gods",
    "0704": "S7E04: Hesperides",
    "0705": "S7E05: Welcome to Bardo",
    "0706": "S7E06: Nakara",
    "0707": "S7E07: The Queen's Gambit",
    "0708": "S7E08: Anaconda",
    "0709": "S7E09: The Flock",
    "0710": "S7E10: ",
    "0711": "S7E11: ",
    "0712": "S7E12: ",
    "0713": "S7E13: ",
    "0714": "S7E14: ",
    "0715": "S7E15: ",
    "0716": "S7E16: ",
    "other": "Other Translations"
}


class Translations extends Component {
	constructor() {
		super();
		this.state = {
			isLoggedIn: false,
			isAdmin: false,
			user: {},
            translations: [],
            isLoading: false,
            selectedSeason: null,
            episodesLoaded: 2,
        }

        this.renderSeason = this.renderSeason.bind(this);
	}

	/* On first load fetch all translations */
	componentDidMount() {
		this.fetchTranslations();
	}

	/* fetch API */
	fetchTranslations() {
		if (this.state.translations.length === 0) {

			// fetch
			fetch("/api/legacy/translations")
				.then(response => {
					return response.json();
				})
				.then(translations => {
					// Fetched dictionary is stored in the state
					// const sorted = translations.sort((a, b) => a.episode.toLowerCase() > b.episode.toLowerCase() ? 1 : -1);
					this.setState({ translations: translations });
				});
		}
	}

    /* Get index of current offset in episodeList */
    getSeasonOffset(season){
        let seasonListKeys = Object.keys(seasonList);
        if(season == "other") return Object.keys(episodeList).length - 1;

        let offset = 0;
        for (let index = 0; index < seasonListKeys.indexOf(season); index++) {
            offset += this.getEpisodeCount(seasonListKeys[index]);
        }
        return offset;
    }

    /* How many episodes do we need to render for a given season */
    getEpisodeCount(season){
        if(season == 'other') return 1;

        let count = 0;
        Object.keys(episodeList).forEach(key => {
            if(key.substring(0,2) == season)
                count++;
        });

        return count;
    }

	/* Get filtered dictionary */
	getEpisode(key) {
		return this.state.translations.filter(function (entry) {
			return entry.episode == key;
		});
	}

	/* Render list of translations */
	renderTranslations(key) {
		return this.getEpisode(key).map(translation => {
			return (
                <React.Fragment key={translation.id}>
                    <Suspense fallback={<h3>Receving data from the ark...</h3>} >
                        <Translation translation={translation} />
                    </Suspense>
                    <div className="line" />
                </React.Fragment>
			);
		})
	}

    loadFunc(page){
        let loaded = this.state.episodesLoaded + 1;
        this.setState({episodesLoaded: loaded});
    }

    /* Update state to load selected season */
    renderSeason(season){
        this.setState({selectedSeason: season, episodesLoaded: 0})
    }

    /* Renders the season select select buttons */
    seasonSelect(){
        return (
            <Row xs={2} sm={2} md={2} lg={3} xl={4} className="justify-content-md-center">
                {
                    Object.keys(seasonList).map(key => {
                        return (<Col key={key} md={6}><Col md={12} as={Button} onClick={() => this.renderSeason(key)}>{seasonList[key]}</Col></Col>)
                    })
                }
            </Row>
        )
    }

    /* Renders the episode select buttons */
    episodeSelect(){
        if(this.state.selectedSeason == null) return ('');
        return (
            <>
            <h2>By Episode:</h2>
            <Row xs={4} sm={4} md={6} lg={6} xl={6} className="justify-content-md-center">
                {
                    Object.keys(episodeList).slice(
                        this.getSeasonOffset(this.state.selectedSeason),
                        this.getSeasonOffset(this.state.selectedSeason) + this.getEpisodeCount(this.state.selectedSeason)
                    ).map(key => {
                        return (
                            <Col key={key} md={6}>
                                <Col
                                    md={12}
                                    as={Button}
                                    onClick={() => this.renderSeason(key)}
                                >
                                    {episodeList[key].substring(0,5)}
                                </Col>
                            </Col>
                        )
                    })
                }
            </Row>
            </>
        )
    }

    canLoadMoreEpisodes(){
        let loaded = this.state.episodesLoaded;
        let maxLoad = this.getEpisodeCount(this.state.selectedSeason)
        return loaded < maxLoad;
    }

	/* Render page */
	render() {
		return (
			<div className="content">
				<div id="inner">
					<h1>Translations by season:</h1>
					{this.seasonSelect() }
					{/* {this.episodeSelect() } */}
					<div className="translations">
						{this.state.selectedSeason != null ?
						<h1>{seasonList[this.state.selectedSeason]} Translations</h1> : <h1>All Translations</h1>}

						<InfiniteScroll
							pageStart={0}
							loadMore={this.loadFunc.bind(this)}
							hasMore={this.canLoadMoreEpisodes()}
							loader={<div className="loader" key={0}>Loading ...</div>}
							initialLoad={true}
							useWindow={true}
						>
							{Object.keys(episodeList).slice(
								this.state.selectedSeason == null ? 0 : this.getSeasonOffset(this.state.selectedSeason),
								this.getSeasonOffset(this.state.selectedSeason) + this.state.episodesLoaded)
							.map(key => {
								return (
									<React.Fragment key={key}>
										<h2>{episodeList[key]}</h2>
										{this.renderTranslations(key)}
									</React.Fragment>
								)
							})}
						</InfiniteScroll>
					</div>
				</div>
			</div>
		)
	}

}
export default Translations

