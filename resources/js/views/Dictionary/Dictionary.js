import React, { Component, lazy, Suspense } from 'react';
import Header from '../../components/Header/Header';
import Footer from '../../components/Footer/Footer';
import { useParams } from "react-router-dom";
import Sidebar from '../../components/Sidebar/Sidebar';
// import Word from '../../components/Word';

const Word = lazy(() => import('../../components/Word'))

// Apple devices running an iOS version earlier than 10
// does not support fetch, so we use a workaround
import 'whatwg-fetch';

class Dictionary extends Component {
    constructor() {
        super();
        this.state = {
            isLoggedIn: false,
            isAdmin: false,
            user: {},
            dictionary: [],
        }
    }

    /* On first load */
    componentDidMount() {
        this.fetchDictionary();
    }

    /* Live switch dictionaries */
    componentDidUpdate(prevProps) {
        window.scrollTo(0, 0)
        if (prevProps !== this.props) {
            this.render()
        }
    }

    /* fetch API */
    fetchDictionary() {
        if (this.state.dictionary.length == 0) {

            // fetch
            fetch("/api/legacy/dictionary")
                .then(response => {
                    return response.json();
                })
                .then(words => {
                    // Fetched dictionary is stored in the state
                    const sorted = words.sort((a, b) => a.word.toLowerCase() > b.word.toLowerCase() ? 1 : -1);
                    this.setState({ dictionary: sorted });
                });
        }
    }

    /* Get filtered dictionary */
    getDictionary() {
        let dict = this.props.match.params.dictionary;
        // dict will be undefined if no dictionary is given
        if (dict == null) return this.state.dictionary;
        return this.state.dictionary.filter(function (entry) {
            return dict == entry.filter.split(' ').find(val => val == dict)
        });
    }

    /* Render list of words */
    renderWords() {
        let lastChar = null;
        return this.getDictionary().map(word => {

            // Add section headers using the first letter
            // This is really ugly, if someone has a better idea please implement it!!!!
            const curChar = word.word.charAt(0).toUpperCase();
            const charDivider = curChar != lastChar ? <a key="0" href={'#' + curChar}><h2 id={curChar}>{curChar}</h2></a> : '';
            lastChar = curChar;

            return (
                <React.Fragment key={word.id}>
                    {charDivider}
                    <Word word={word} />
                </React.Fragment>
            );
        })
    }

    /* Get headername for dictionary */
    DictionaryName() {
        let { dictionary } = useParams();
        return (<h1 style={{ textTransform: 'capitalize' }}>{dictionary} Dictionary</h1>);
    }

    /* Render page */
    render() {
        return (
            <>
                <Sidebar/>
                <Header userData={this.state.user} userIsLoggedIn={this.state.isLoggedIn} />
                <div className="content dictionary">
                    <this.DictionaryName/>
                    <Suspense fallback={<h3>Receving data from the ark...</h3>} >
                    { this.renderWords() }
                    </Suspense>
                </div>
                <Footer />
            </>
        )
    }

}
export default Dictionary

