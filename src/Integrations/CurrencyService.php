<?php

namespace App\Integrations;

use App\Entity\CurrencyExchange;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CurrencyService
{
    private $httpClient;
    private $entityManager;
    public const ALLOWED_RATES = [
        'USD',
        'GBP',
        'AUD'
    ];

    public function __construct(
        HttpClientInterface $httpClient,
        EntityManagerInterface $entityManager
    ) {
        $this->httpClient = $httpClient;
        $this->entityManager = $entityManager;
    }

    public function requestCurrencyData(): array
    {
        $response = $this->httpClient->request('GET', $_ENV['CURRENCY_API_URL']);
        $responseData = $response->toArray();

        foreach ($responseData['rates'] as $targetCurrency => $rate) {
            if (in_array($targetCurrency, self::ALLOWED_RATES)) {
                $currencyExchange = new CurrencyExchange();

                $currencyExchange->setBaseCurrency($responseData['base']);
                $currencyExchange->setTargetCurrency($targetCurrency);
                $currencyExchange->setRate($rate);

                $updatedAt = new \DateTimeImmutable('@' . $responseData['lastUpdate']);
                $updatedAt->format('Y-m-d');

                $currencyExchange->setUpdatedAt($updatedAt);

                $this->entityManager->persist($currencyExchange);
            }
        }

        $this->entityManager->flush();

        return $responseData;
    }
}