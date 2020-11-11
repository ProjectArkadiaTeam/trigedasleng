import React, {Component} from 'react';
import {Link} from 'react-router-dom';

function Word(props) {
	const word = props.word;
	return (
		<div className="entry">
			<h3><b><Link to={"/word/" + word.word}>{word.word}</Link></b></h3>
			<p className="definition">{word.translation}</p>
			<p className="etymology">{word.etymology}</p>
			{
				word.filter.includes('noncanon') ?
					<i className="noncanon-warning">!!Not a canon word</i>
					: ''
			}
		</div>
	);
}
export default Word
