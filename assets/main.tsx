import React from "react";
import ReactDOM from "react-dom";
import { BrowserRouter } from "react-router-dom";
import axios from "axios";

class App extends React.Component {

    state = {
        currencies: []
    }
    componentDidMount() {
        axios.get('http://localhost:8000/api/currencies').then(res => {
            const currencies = res.data
            this.setState({currencies})
        })
    }

    render() {
        return <h1> TEST </h1>
    }
}



ReactDOM.render(
        <React.StrictMode>
            <BrowserRouter>
                <App />
            </BrowserRouter>
        </React.StrictMode>,
    document.getElementById("root")
);
