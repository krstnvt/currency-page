import React from 'react'
import {CurrencyExchange} from "../entities/CurrencyExchange";
import axios from "axios";
import moment from 'moment';

export class CurrencyTable extends React.Component<{ currencies: CurrencyExchange[] }, { target_currency: string }> {
    constructor(props: any) {
        super(props);

        this.state = {
            target_currency: "EUR",
        }
    }

    render() {
        return (
            <div>
                <select
                    className="select-container"
                    onChange={e => this.setState({ target_currency: e.target.value })}
                >
                    {Array.from(new Set(this.props.currencies.map(currency => currency.target_currency))).map(uniqueCurrency => (
                        <option key={uniqueCurrency} value={uniqueCurrency}>
                            EUR to {uniqueCurrency}
                        </option>
                    ))}
                </select>

                <h1>1 EUR to {this.state.target_currency} Exchange Rate</h1>

                <p>Last updated: </p>

                <table className="table-container">
                    <tr>
                        <th>Date</th>
                        <th>Rate</th>
                    </tr>

                    {
                        Array.from(this.props.currencies.values())
                            .filter(currency => currency.target_currency === this.state.target_currency)
                            .map(currency => {
                                const formattedDate = moment(currency.updated_at).format('Y-MM-DD');
                                return (
                                    <tr>
                                        <td>{formattedDate}</td>
                                        <td>{currency.rate}</td>
                                    </tr>
                                );
                            })}
                </table>
                <p>Minimum: , Maximum: , Average: </p>
            </div>


        )
    }

}