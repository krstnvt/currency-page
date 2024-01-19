import React from 'react'
import {CurrencyExchange} from "../entities/CurrencyExchange";
import axios from "axios";
import {CurrencyTable} from "./CurrencyTable";
import '../styles/main.css';

export class Main extends React.Component<{}, {currencies: CurrencyExchange[]}> {
    private interval: NodeJS.Timeout | undefined;
    constructor(props: any) {
        super(props);
        this.state = {
            currencies: [],
        }
    }

    componentDidMount() {
        this.getCurrencies();
        this.interval = setInterval(() => {
            this.getCurrencies();
        },24 * 60 * 60 * 1000);
    }

    private getCurrencies() {
        axios.get('http://localhost:8000/api/currencies')
            .then(res => {
                this.setState({currencies: res.data})
            })
    }

    componentWillUnmount() {
        clearInterval(this.interval);
    }

    render() {
        return (
            <div>
                <CurrencyTable currencies={this.state.currencies}/>
            </div>
        )
    }
}
