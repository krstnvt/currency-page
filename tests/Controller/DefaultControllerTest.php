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
        $currencyRepository = $this->createMock(CurrencyExchangeRepository::class);
        $currencyService = new CurrencyService($currencyRepository);
        $controller = new DefaultController($currencyService);
        $response = $controller->getCurrencies();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
        $this->assertEquals('*', $response->headers->get('Access-Control-Allow-Origin'));

        $content = $response->getContent();
        $this->assertJson($content);

        $expectedCurrenciesData = $currencyService->getAllCurrencyRateData();
        $decodedContent = json_decode($content, true);

        $this->assertEquals($expectedCurrenciesData, $decodedContent);
    }
}
