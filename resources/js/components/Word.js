import React, {Component} from 'react';
import {Link, withRouter} from 'react-router-dom';
class Word extends Component {

  constructor(props) {
    super(props);
      this.state = {
				word: props.word
      };
  }

  render() {
      const word = this.props.word;
      return (
			<div className="entry">
				<h3><b><Link to={ "/word/" + word.word }>{ word.word }</Link></b></h3>
				<p className="definition">{ word.translation }</p>
				<p className="etymology">{ word.etymology }</p>
			</div>
    )
  }
}
export default Word
