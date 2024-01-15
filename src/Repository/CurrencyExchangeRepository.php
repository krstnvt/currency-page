<?php

namespace App\Repository;

use App\Entity\CurrencyExchange;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CurrencyExchange>
 *
 * @method CurrencyExchange|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrencyExchange|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrencyExchange[]    findAll()
 * @method CurrencyExchange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyExchangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrencyExchange::class);
    }

    public function findByTargetCurrency($targetCurrency): array
    {
        return $this->createQueryBuilder('currency')
            ->andWhere('currency.target_currency = :targetCurrency')
            ->setParameter('targetCurrency', $targetCurrency)
            ->orderBy('currency.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function getAllTargetCurrencies(): array
    {
        return $this->createQueryBuilder('currency')
            ->select('DISTINCT currency.target_currency')
            ->orderBy('currency.target_currency', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function getAllCurrencyRateData(): array
    {
        return $this->createQueryBuilder('currency')
            ->select(
                'currency.base_currency',
                'currency.target_currency',
                'currency.rate',
                'currency.updated_at',
                'currency.created_at',
                'currency.id'
            )
            ->orderBy('currency.created_at', 'DESC')
            ->getQuery()
            ->getResult();
    }
}

