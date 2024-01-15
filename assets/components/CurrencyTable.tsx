import React from 'react';
import { CurrencyExchange } from '../entities/CurrencyExchange';
import moment from 'moment';

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
        const { currencies } = this.props;
        const { target_currency, currentPage, itemsPerPage } = this.state;

        let uniqueDates = Array.from(new Set(this.props.currencies.map(currency => Object.values(currency.created_at)[0])));

        const filteredCurrencies = currencies
            .filter((currency) => currency.target_currency === target_currency)
            .reverse();

        const indexOfLastItem = currentPage * itemsPerPage;
        const indexOfFirstItem = indexOfLastItem - itemsPerPage;
        const currentItems = filteredCurrencies.slice(indexOfFirstItem, indexOfLastItem);

        const renderTableRows = currentItems.map((currency) => (
            <tr key={currency.id}>
                <td>{moment(Object.values(currency.updated_at)[0]).format('Y-MM-DD')}</td>
                <td>{currency.rate}</td>
            </tr>
        ));

        const pageNumbers = [];
        for (let i = 1; i <= Math.ceil(filteredCurrencies.length / itemsPerPage); i++) {
            pageNumbers.push(i);
        }

        return (
            <div>
                <select
                    className="select-container"
                    onChange={(e) => this.setState({ target_currency: e.target.value, currentPage: 1 })}
                >
                    {Array.from(new Set(currencies.map((currency) => currency.target_currency))).map((uniqueCurrency) => (
                        <option key={uniqueCurrency} value={uniqueCurrency}>
                            EUR to {uniqueCurrency}
                        </option>
                    ))}
                </select>

                <h1>1 EUR to {this.state.target_currency} Exchange Rate</h1>

                <p>Last updated: {moment(Object.values(uniqueDates)[0]).format('Y-MM-DD')}</p>

                <table className="table-container">
                    <tbody>
                    <tr>
                        <th>Date</th>
                        <th>EUR to {this.state.target_currency}</th>
                    </tr>
                    </tbody>
                    {renderTableRows}
                </table>
                    <ul className="pagination">
                        {pageNumbers.map((number) => (
                            <li key={number} className={number === currentPage ? 'active' : ''}>
                                <a onClick={() => this.setState({ currentPage: number })}>{number}</a>
                            </li>
                        ))}
                    </ul>

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
