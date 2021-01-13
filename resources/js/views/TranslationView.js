import React, { Component, Suspense, lazy } from 'react';
import Translation from '../components/Translation';
import slugify from "slugify";


// Apple devices running an iOS version earlier than 10
// does not support fetch, so we use a workaround
import 'whatwg-fetch';
import {Link} from "react-router-dom";

class TranslationView extends Component {

	constructor(props) {
		super(props);
		this.state = {
			info: undefined,
		}
	}

	/* fetch API */
	getTranslationInfo() {
		let id = this.props.match.params.id;
		return this.props.translations.find(e => e.id ===  parseInt(id));
	}

	render() {
		let data = this.getTranslationInfo();
		window.history.replaceState(null, null, `/translation/${data.id}/${slugify(data.trigedasleng, {lower: true, strict: true})}`);
		return (
			<div className="content">
				<div id="inner">
					{!this.props.isLoading && data !== undefined ?
						<React.Fragment>
							<Suspense fallback={<div>Loading...</div>}>
								<h1>{data.trigedasleng}</h1>
								<Translation translation={data}/>

								<h3>Source:</h3>
								{/* Only show source if there is one */}
								{data.source != null ?
									<a href={data.source.url}>{data.source.title}</a>
									: <p>None</p>}
							</Suspense>
						</React.Fragment>
						: <div>Loading...</div>}
				</div>
			</div>
		)
	}
}
export default TranslationView
