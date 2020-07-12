import React, {Component} from 'react';
import { Table } from 'react-bootstrap';
class Translation extends Component {

  constructor(props) {
    super(props);
      this.state = {
        translation: props.translation
      };
  }

  render() {
      const translation = this.props.translation;
      return (
        <div className="translations entry unflagged">
          <Table striped size="sm" className="gloss">
            <tbody>
            <tr className="tgs_text">
              <td colSpan="10"><a href="#">{ translation.trigedasleng }</a></td>
            </tr>
            <tr className="tgs" style={{display: "table-row"}}>
              { translation.trigedasleng.split(' ').map((word , index) => <td key={index}>{word}</td>) }
            </tr>
            <tr className="ety" style={{display: "table-row"}}>
              { translation.etymology.split(' ').map((word , index) => <td key={index}>{word}</td>) }
            </tr>
            <tr className="leipzig" style={{display: "table-row"}}>
              { translation.leipzig.split(' ').map((word , index) => <td key={index}>{word}</td>) }
            </tr>
            <tr className="en_text">
              <td colSpan="10">{ translation.translation }</td>
            </tr>
            </tbody>
          </Table>
          <audio controls preload="none">
            <source src={ translation.audio } type="audio/mpeg" />
          </audio>
        </div>
    );
  }
}
export default Translation
