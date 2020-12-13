import React, { Component, lazy, Suspense } from 'react';
import { Row, Col, Button } from 'react-bootstrap/esm/index';
import InfiniteScroll from 'react-infinite-scroller';

// Lazy load translation component, since we have to wait for fetch anyway
const Translation = lazy(() => import('../../components/Translation' /* webpackChunkName: "js/Translation" */))

// Get season and episodelist, kept in different file to avoid bloat
import {seasonList, episodeList} from "./data";

/**
 * Apple devices running an iOS version earlier than 10
 * does not support fetch, so we use a workaround.
 * TODO: Do old devices support axios?
 */
import 'whatwg-fetch';

class Translations extends Component {
	constructor(props) {
		super(props);
		this.state = {
            translations: [],
            isLoading: true,
            selectedSeason: null,
            episodesLoaded: 2,
        };
		this.renderSeason = this.renderSeason.bind(this);
	}

	/**
	 * React Lifecycle method.
	 * Fetches translations after the component is mounted(rendered)
	 *
	 * See:
	 * https://reactjs.org/docs/state-and-lifecycle.html#adding-lifecycle-methods-to-a-class
	 */
	componentDidMount() {
		this.fetchTranslations();
	}

	/**
	 * Fetch translation data from the API endpoint.
	 * Translation data is saved when switching between
	 * dictionaries, so we dont have to fetch them everytime
	 **/
	fetchTranslations() {
		// If we already have translation data cached skip
		if (this.state.translations.length === 0) {

			// fetch using the API
			// TODO: Once the new api is in switch to that
			fetch("/api/legacy/translations")
				.then(response => {
					return response.json();
				})
				.then(translations => {
					// Fetched dictionary is stored in the state
					this.setState({ translations: translations, isLoading: false });
				});
		}
	}

    /**
	 * Get the selected seasons offset in the episodelist
	 * Ex. getSeasonOffset("03") returns 16, as there is 0 episodes in S1 and 16 in S2
	 */
    getSeasonOffset(season){

        // "other" will always be last and only contains "1 episode"
        if(season === "other") return Object.keys(episodeList).length - 1;

        // Itterate over the episode count of each season that comes
		// before this one.
		// TODO: This is really slow....
        let offset = 0;
		let seasonListKeys = Object.keys(seasonList);
		for (let index = 0; index < seasonListKeys.indexOf(season); index++) {
            offset += this.getEpisodeCount(seasonListKeys[index]);
        }
        return offset;
    }

    /**
	 * How many episodes is in the selected season
	 */
    getEpisodeCount(season){
    	// If no season is selected return length of the entire list
    	if(season === null) return Object.keys(episodeList).length;

    	// 'other' always has a length of 1
        if(season === 'other') return 1;

        // Itterate over episodeList to get count of episodes
        let count = 0;
        Object.keys(episodeList).forEach(key => {
        	// first 2 chars in episode key defines season, last 2 episode number
            if(key.substring(0,2) === season)
                count++;
        });

        return count;
    }

	/**
	 *  Get translations for selected episode
	 *  TODO: This is slow...
	 */
	getEpisode(key) {
		return this.state.translations.filter(function (entry) {
			return entry.episode === key;
		});
	}

	/** Render list of translations */
	renderTranslations(key) {
		// If search is not none we filter the translations
		let search = this.props.search.toLowerCase();
		let translations = this.getEpisode(key);
		if (search !== "") {
			translations = this.getEpisode(key).filter(translation => {
				return (translation.trigedasleng.toLowerCase().includes(search)
					|| translation.translation.toLowerCase().includes(search))
			});
		}

		// Map translations into DOM elements
		let list = translations.map(translation => {
			return (
                <React.Fragment key={translation.id}>
                    <Suspense fallback={<h3>Receving data from the ark...</h3>} >
                        <Translation translation={translation} />
                    </Suspense>
                    <div className="line" />
                </React.Fragment>
			);
		});

		// If there is no translations for the episode return nothing
		if(translations.length === 0) return '';

		return (
			<React.Fragment>
				<h2>{episodeList[key]}</h2>
				{ list }
			</React.Fragment>
		)
	}

	/** Load next 2 episodes */
    loadMoreEpisodes(){
		this.setState((state) => ({
			episodesLoaded: state.episodesLoaded + 2
		}));
    }

    /** Update state to load selected season */
    renderSeason(season){
        this.setState({selectedSeason: season, episodesLoaded: 0})
    }

    /** Renders the season select select buttons */
    seasonSelect(){
        return (
            <Row xs={2} sm={2} md={2} lg={3} xl={4} className="justify-content-md-center">
                {
                    Object.keys(seasonList).map(key => {
                        return (<Col key={key} md={6}><Col md={12} variant="dark" as={Button} onClick={() => this.renderSeason(key)}>{seasonList[key]}</Col></Col>)
                    })
                }
            </Row>
        )
    }

    /** Render the episode select buttons */
    episodeSelect(){
    	// If no season is selected, we dont need episode buttons
        if(this.state.selectedSeason == null) return ('');
        return (
            <React.Fragment>
				<h2>By Episode:</h2>
				<Row xs={4} sm={4} md={6} lg={6} xl={6} className="justify-content-md-center">
					{
						Object.keys(episodeList).slice(
							this.getSeasonOffset(this.state.selectedSeason),
							this.getSeasonOffset(this.state.selectedSeason) + this.getEpisodeCount(this.state.selectedSeason)
						).map(key => {
							return (
								<Col key={key} md={6}>
									<Col md={12} as={Button} onClick={() => this.renderSeason(key)}>
										{episodeList[key].substring(0,5)}
									</Col>
								</Col>
							)
						})
					}
				</Row>
            </React.Fragment>
        )
    }

    /** Can we load more episodes? */
    canLoadMoreEpisodes(){
        let loaded = this.state.episodesLoaded;
        let maxLoad = this.getEpisodeCount(this.state.selectedSeason)
        return loaded < maxLoad;
    }

	/** Render page */
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
						{this.state.isLoading ? <div className="loader" key={0}>Loading ...</div> :
						<InfiniteScroll
							pageStart={0}
							loadMore={this.loadMoreEpisodes.bind(this)}
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
										{this.renderTranslations(key)}
									</React.Fragment>
								)
							})}
						</InfiniteScroll>}
					</div>
				</div>
			</div>
		)
	}
}
export default Translations

