import React from 'react';

interface PaginationProps {
    pageNumbers: number[];
    currentPage: number;
    onClick: (pageNumber: number) => void;
}

const Pagination: React.FC<PaginationProps> = ({pageNumbers, currentPage, onClick}) => (
    <ul className="pagination">
        {pageNumbers.map((number) => (
            <li key={number} className={number === currentPage ? 'active' : ''}>
                <a onClick={() => onClick(number)}>{number}</a>
            </li>
        ))}
    </ul>
);

export default Pagination;