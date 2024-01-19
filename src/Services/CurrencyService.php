<?php

namespace App\Services;

use App\Repository\CurrencyExchangeRepository;

class CurrencyService
{
    private CurrencyExchangeRepository $currencyRepository;

    public function __construct(
        CurrencyExchangeRepository $currencyRepository,
    )
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function getAllCurrencyRateData(): array
    {
        return $this->currencyRepository->getAllCurrencyRateData();
    }
}