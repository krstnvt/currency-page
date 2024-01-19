import React from 'react';
import {CurrencyExchange} from "../entities/CurrencyExchange";

export class SelectCurrency extends React.Component<
    {
        currencies: CurrencyExchange[];
        onChange: (e: React.ChangeEvent<HTMLSelectElement>) => void;
        selectedCurrency: string;
    },
    {}
> {
    constructor(props: any) {
        super(props);
    }

    render() {
        const {currencies, onChange, selectedCurrency} = this.props;
        return (
            <select className="select-dropdown" onChange={onChange} value={selectedCurrency}>
                {Array.from(new Set(currencies.map((currency) => currency.target_currency))).map((uniqueCurrency) => (
                    <option key={uniqueCurrency} value={uniqueCurrency}>
                        EUR to {uniqueCurrency}
                    </option>
                ))}
            </select>
        )
    }
}
