import React from 'react';
import { Table } from 'react-bootstrap';
import slugify from "slugify";

function Translation(props) {
	const translation = props.translation;
	return (
		<div className="translations entry unflagged">
			<Table striped size="sm" className="gloss">
				<tbody>
				<tr className="tgs_text">
					<td colSpan="10"><a href={`/translation/${translation.id}/${slugify(translation.trigedasleng, {lower: true, strict: true})}`}>{ translation.trigedasleng }</a></td>
				</tr>
				<tr className="tgs" style={{display: "table-row"}}>
					{ translation.trigedasleng.split(' ').map((word , index) => <td key={index}>{word}</td>) }
				</tr>
				{translation.etymology !== "" ?
					<tr className="ety" style={{display: "table-row"}}>
						{ translation.etymology.split(' ').map((word , index) => <td key={index}>{word}</td>) }
					</tr> : ''}
				{translation.etymology !== "" ?
					<tr className="leipzig" style={{display: "table-row"}}>
						{ translation.leipzig.split(' ').map((word , index) => <td key={index}>{word}</td>) }
					</tr> : ''}
				<tr className="en_text">
					<td colSpan="10">{ translation.translation }</td>
				</tr>
				</tbody>
			</Table>
			{translation.audio !== "" ?
				<audio controls preload="none">
					<source src={ '/' + translation.audio } type="audio/mpeg" />
				</audio> : ''}
		</div>
	);
}
export default Translation
