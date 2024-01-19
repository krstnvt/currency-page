<?php

namespace Services;

use App\Services\CurrencyService;
use App\Repository\CurrencyExchangeRepository;
use PHPUnit\Framework\TestCase;

class CurrencyServiceTest extends TestCase
{
    public function testGetAllCurrencies(): void
    {
        $currencyRepository = $this->createMock(CurrencyExchangeRepository::class);
        $currencyService = new CurrencyService($currencyRepository);

        $currencyData = $currencyService->getAllCurrencyRateData();

        $this->assertIsArray($currencyData);
        //$this->assertNotEmpty($currencyData);
    }
}
