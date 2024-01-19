import React from 'react';

export class CurrencyTablePagination extends React.Component<
    {
        pageNumbers: number[];
        currentPage: number;
        onClick: (pageNumber: number) => void;
    },
    {}
> {
    constructor(props: any) {
        super(props);
    }

    render() {
        const {pageNumbers, currentPage, onClick} = this.props;
        return (
            <ul className="pagination">
                {pageNumbers.map((number) => (
                    <li key={number} className={number === currentPage ? 'active' : ''}>
                        <a onClick={() => onClick(number)}>{number}</a>
                    </li>
                ))}
            </ul>
        );
    }
}
