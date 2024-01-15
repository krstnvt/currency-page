import React from 'react';
import {CurrencyExchange} from '../entities/CurrencyExchange';
import moment from 'moment';
import SelectCurrency from "./SelectCurrency";
import CurrencyTableRows from "./CurrencyTableRows";
import Pagination from "./Pagination";

export class CurrencyTable extends React.Component<
    { currencies: CurrencyExchange[] },
    { target_currency: string; currentPage: number; itemsPerPage: number }
> {
    constructor(props: any) {
        super(props);

        this.state = {
            target_currency: 'USD',
            currentPage: 1,
            itemsPerPage: 5,
        };
    }

    render() {
        const {currencies} = this.props;
        const {target_currency, currentPage, itemsPerPage} = this.state;
        let uniqueDates = Array.from(new Set(this.props.currencies
            .map(currency => Object.values(currency.created_at)[0])));
        const filteredCurrencies = currencies
            .filter((currency) => currency.target_currency === target_currency);

        const indexOfLastItem = currentPage * itemsPerPage;
        const indexOfFirstItem = indexOfLastItem - itemsPerPage;
        const currentItems = filteredCurrencies.slice(indexOfFirstItem, indexOfLastItem);

        const pageNumbers = [];
        for (let i = 1; i <= Math.ceil(filteredCurrencies.length / itemsPerPage); i++) {
            pageNumbers.push(i);
        }

        return (
            <div>
                <SelectCurrency
                    currencies={currencies}
                    onChange={(e: React.ChangeEvent<HTMLSelectElement>) =>
                        this.setState({target_currency: e.target.value, currentPage: 1})}
                    selectedCurrency={this.state.target_currency}/>

                <h1>1 EUR to {this.state.target_currency} Exchange Rate</h1>
                <p>Last updated: {moment(Object.values(uniqueDates)[0]).format('Y-MM-DD')}</p>

                <table className="table-container">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>EUR to {this.state.target_currency}</th>
                    </tr>
                    </thead>
                    <CurrencyTableRows currentItems={currentItems}/>
                </table>

                <Pagination
                    pageNumbers={pageNumbers}
                    currentPage={currentPage}
                    onClick={(number) => this.setState({currentPage: number})}/>

                <p>
                    Minimum: {Math.min(...currentItems.map((currency) => currency.rate))} {this.state.target_currency},
                    Maximum: {Math.max(...currentItems.map((currency) => currency.rate))} {this.state.target_currency},
                    Average: {(currentItems.reduce((a, b) => a + b.rate, 0) / currentItems.length).toFixed(4)}{' '}
                    {this.state.target_currency}
                </p>
            </div>
        );
    }
}
