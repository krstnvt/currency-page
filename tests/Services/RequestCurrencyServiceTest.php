<?php

namespace Services;

use App\Services\RequestCurrencyService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class RequestCurrencyServiceTest extends TestCase
{
    private HttpClientInterface|\PHPUnit\Framework\MockObject\MockObject $httpClientMock;
    private \PHPUnit\Framework\MockObject\MockObject|EntityManagerInterface $emMock;

    protected function setUp(): void
    {
        $this->httpClientMock = $this->createMock(HttpClientInterface::class);
        $this->emMock = $this->createMock(EntityManagerInterface::class);
    }

    public function testRequestCurrencyData(): void
    {
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->method('toArray')->willReturn([
            'base' => 'EUR',
            'rates' => [
                'USD' => 0.9999,
                'GBP' => 1.5624,
                'AUD' => 1.0334,
            ],
            'lastUpdate' => time(),
        ]);

        $this->httpClientMock->method('request')->willReturn($responseMock);
        $this->emMock->expects(
            $this->exactly(
                count(RequestCurrencyService::ALLOWED_RATES)))
            ->method('persist');

        $requestCurrencyService = new RequestCurrencyService(
            $this->httpClientMock,
            $this->emMock
        );

        $result = $requestCurrencyService->requestCurrencyData();

        $this->assertNotEmpty($result);
        $this->assertEquals($responseMock->toArray(), $result);
    }
}
