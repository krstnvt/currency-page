<?php

namespace App\Entity;

use App\Repository\CurrencyExchangeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrencyExchangeRepository::class)]
class CurrencyExchange
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 3)]
    private string $base_currency;

    #[ORM\Column(length: 3)]
    private string $target_currency;

    #[ORM\Column]
    private float $rate;

    #[ORM\Column]
    private \DateTimeImmutable $updated_at;

    public function getId(): int
    {
        return $this->id;
    }

    public function getBaseCurrency(): string
    {
        return $this->base_currency;
    }

    public function setBaseCurrency(string $base_currency): static
    {
        $this->base_currency = $base_currency;

        return $this;
    }

    public function getTargetCurrency(): string
    {
        return $this->target_currency;
    }

    public function setTargetCurrency(string $target_currency): static
    {
        $this->target_currency = $target_currency;

        return $this;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function setRate(float $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
