import React from 'react';
import {CurrencyExchange} from "../entities/CurrencyExchange";

interface SelectCurrencyProps {
    currencies: CurrencyExchange[];
    onChange: (e: React.ChangeEvent<HTMLSelectElement>) => void;
    selectedCurrency: string;
}

const SelectCurrency: React.FC<SelectCurrencyProps> = ({currencies, onChange, selectedCurrency}) => (
    <select className="select-dropdown" onChange={onChange} value={selectedCurrency}>
        {Array.from(new Set(currencies.map((currency) => currency.target_currency))).map((uniqueCurrency) => (
            <option key={uniqueCurrency} value={uniqueCurrency}>
                EUR to {uniqueCurrency}
            </option>
        ))}
    </select>
);

export default SelectCurrency;