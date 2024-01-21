import React from 'react';
import moment, {Moment} from 'moment';
import {CurrencyExchange} from "../entities/CurrencyExchange";

export class CurrencyTableRows extends React.Component<
    { currentItems: CurrencyExchange[] },
    {}
> {
    constructor(props: any) {
        super(props);
    }

    render() {
        return (
            <tbody>
            {this.props.currentItems.map((currency) => (
                <tr key={currency.id}>
                    <td>{moment(Object.values(currency.updated_at)[0]).format('Y-MM-DD')}</td>
                    <td>{currency.rate.toFixed(4)}</td>
                </tr>
            ))}
            </tbody>
        );
    }
}
