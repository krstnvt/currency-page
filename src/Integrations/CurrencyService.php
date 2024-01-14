<?php

namespace App\Integrations;

use App\Repository\CurrencyExchangeRepository;

class CurrencyService
{
    private $currencyRepository;
    public function __construct(
        CurrencyExchangeRepository $currencyRepository,
    ) {
        $this->currencyRepository = $currencyRepository;
    }
    public function getMinRate(string $targetCurrency): float
    {
        $rates = $this->getRates($targetCurrency);

        return min($rates);
    }

    public function getMaxRate(string $targetCurrency): float
    {
        $rates = $this->getRates($targetCurrency);

        return max($rates);
    }

    public function getAverageRate(string $targetCurrency): float
    {
        $rates = $this->getRates($targetCurrency);

        return count($rates) > 0 ? array_sum($rates) / count($rates) : 0;
    }

    public function getRates(string $targetCurrency): array
    {
        $currencies = $this->currencyRepository->findByTargetCurrency($targetCurrency);
        return array_map(function ($currency) {
            return $currency->getRate();
        }, $currencies);
    }

    public function getAllCurrencies(): array {
        return $this->currencyRepository->getAll();
    }
}