<?php

namespace Controller;

use App\Controller\DefaultController;
use App\Services\CurrencyService;
use App\Repository\CurrencyExchangeRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends TestCase
{
    public function testGetAllCurrencyData(): void
    {
        $currencyServiceMock = $this->createMock(CurrencyService::class);

        $expectedCurrencies = [
            [
                'base_currency' => 'EUR',
                'target_currency' => 'USD',
                'rate' => 0.8582,
                'updated_at' => '2024-01-21 00:00:00',
                'created_at' => '2024-01-21 00:00:00',
                'id' => 1
            ],
            [
                'base_currency' => 'EUR',
                'target_currency' => 'GBP',
                'rate' => 1.2345,
                'updated_at' => '2024-01-21 00:00:00',
                'created_at' => '2024-01-21 00:00:00',
                'id' => 2
            ],
            [
                'base_currency' => 'EUR',
                'target_currency' => 'AUD',
                'rate' => 1.0101,
                'updated_at' => '2024-01-21 00:00:00',
                'created_at' => '2024-01-21 00:00:00',
                'id' => 3
            ]];

        $currencyServiceMock->method('getAllCurrencyRateData')->willReturn([$expectedCurrencies]);

        $controller = new DefaultController($currencyServiceMock);
        $response = $controller->getCurrencies();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
        $this->assertEquals('*', $response->headers->get('Access-Control-Allow-Origin'));
        $this->assertJson($response->getContent());

        $decodedContent = json_decode($response->getContent(), true);

        $this->assertEquals($currencyServiceMock->getAllCurrencyRateData(), $decodedContent);
    }
}
