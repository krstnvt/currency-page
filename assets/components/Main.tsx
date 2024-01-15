import React from 'react'
import {CurrencyExchange} from "../entities/CurrencyExchange";
import axios from "axios";
import {CurrencyTable} from "./CurrencyTable";
import '../styles/main.css';

export class Main extends React.Component<{}, {currencies: CurrencyExchange[]}> {
    constructor(props: any) {
        super(props);
        this.state = {
            currencies: [],
        }
    }

    componentDidMount() {
        axios.get('https://localhost:8000/api/currencies')
            .then(res => {
                this.setState({currencies: res.data})
            })
    }

    render() {
        return (
            <div>
                <CurrencyTable currencies={this.state.currencies}/>
            </div>
        )
    }

}