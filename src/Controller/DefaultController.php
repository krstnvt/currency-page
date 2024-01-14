<?php

namespace App\Controller;

use App\Integrations\CurrencyService;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $entityManager;
    private $service;

    public function __construct(
        EntityManagerInterface $entityManager,
        CurrencyService $service,
    )
    {
        $this->entityManager = $entityManager;
        $this->service = $service;
    }
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            //'currencies' => $currencies
        ]);
    }

    #[Route('/api/test', name: 'test')]
    public function test(): Response
    {
        $data = $this->service->requestCurrencyData();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'currencies' => $data
        ]);
    }
}
