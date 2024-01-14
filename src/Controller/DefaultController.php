<?php

namespace App\Controller;

use App\Integrations\CurrencyService;
use App\Repository\CurrencyExchangeRepository;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\throwException;

class DefaultController extends AbstractController
{
    private $entityManager;
    private $repository;
    private $currencyService;

    public function __construct(
        EntityManagerInterface $entityManager,
        CurrencyService $currencyService
    )
    {
        $this->entityManager = $entityManager;
        $this->currencyService = $currencyService;
    }
    #[Route('/', name: 'home')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
//        $currencies = $this->repository->findByTargetCurrency('USD');
//
//        $pagination = $paginator->paginate(
//            $currencies,
//            $request->query->getInt('page', 1),
//            6
//        );
//
//        return $this->render('default/index.html.twig', [
//            'controller_name' => 'DefaultController',
//            'currencies' => $currencies,
//            'target' => $this->repository->getAllTargetCurrencies(),
//            'pagination' => $pagination,
//            'min' => $this->service->getMinRate('USD'),
//            'max' => $this->service->getMaxRate('USD'),
//            'average' => $this->service->getAverageRate('USD')
//        ]);
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/api/currencies', name:'currencies')]
    public function getCurrencies(): Response {
        $currencies = $this->currencyService->getAllCurrencies();
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setContent(json_encode($currencies));
        return $response;
    }


//    #[Route('/{targetCurrency}', name: 'rates')]
//    public function test(Request $request, PaginatorInterface $paginator, $targetCurrency): Response
//    {
//        $currencies = $this->repository->findByTargetCurrency($targetCurrency);
//
//        if (!$currencies) {
//            echo 'Sorry, we don\'t have exchange data for this currency';
//        }
//
//        $pagination = $paginator->paginate(
//            $currencies,
//            $request->query->getInt('page', 1),
//            6
//        );
//
//        return $this->render('default/rates.html.twig', [
//            'controller_name' => 'DefaultController',
//            'currencies' => $currencies,
//            'pagination' => $pagination,
//            'target' => $this->repository->getAllTargetCurrencies(),
//            'min' => $this->service->getMinRate($targetCurrency),
//            'max' => $this->service->getMaxRate($targetCurrency),
//            'average' => $this->service->getAverageRate($targetCurrency)
//        ]);
//    }
}
