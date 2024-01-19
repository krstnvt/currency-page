<?php

namespace App\Controller;

use App\Integrations\CurrencyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private CurrencyService $currencyService;

    public function __construct(
        CurrencyService $currencyService
    )
    {
        $this->currencyService = $currencyService;
    }
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/api/currencies', name:'currencies')]
    public function getCurrencies(): Response {
        $currencies = $this->currencyService->getAllCurrencyRateData();

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setContent(json_encode($currencies));

        return $response;
    }
}
