<?php

namespace App\Integrations;

use App\Entity\CurrencyExchange;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CurrencyService
{
    private $httpClient;
    private $entityManager;

    public function __construct(
        HttpClientInterface $httpClient,
        EntityManagerInterface $entityManager
    ) {
        $this->httpClient = $httpClient;
        $this->entityManager = $entityManager;
    }

    public function fetchData(): array
    {
        $response = $this->httpClient->request('GET', $_ENV['CURRENCY_API_URL']);
        $data = $response->toArray();

        $currency = new CurrencyExchange();
        $currency->setBaseCurrency($data['base']);
        $currency->setTargetCurrency($data['rates'][0]);
        $currency->setRate($data['rates'][1]);
        $currency->setUpdatedAt($data['lastUpdate']);

        return $data;
    }
}