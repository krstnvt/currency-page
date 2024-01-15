import React from 'react';
import moment, {Moment} from 'moment';
import {CurrencyExchange} from "../entities/CurrencyExchange";

interface CurrencyTableRowsProps {
    currentItems: CurrencyExchange[];
}

const CurrencyTableRows: React.FC<CurrencyTableRowsProps> = ({currentItems}) => (
    <tbody>
    {currentItems.map((currency) => (
        <tr key={currency.id}>
            <td>{moment(Object.values(currency.updated_at)[0]).format('Y-MM-DD')}</td>
            <td>{currency.rate}</td>
        </tr>
    ))}
    </tbody>
);

export default CurrencyTableRows;