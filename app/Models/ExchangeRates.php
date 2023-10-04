<?php

namespace App\Models;

class ExchangeRates
{
    const CURRENCY_CODES_TO_EXCHANGE = ['USD', 'GBP', 'JPY', 'EUR', 'RUB'];

    public int $id;
    public string $base_currency;
    public string $rates;
    public string $date;

    public function __construct(string $baseCurrency, string $rates, string $date)
    {
        $this->base_currency = $baseCurrency;
        $this->rates = $rates;
        $this->date = $date;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBaseCurrency(): string
    {
        return $this->base_currency;
    }

    public function getRates(): string
    {
        return $this->rates;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}