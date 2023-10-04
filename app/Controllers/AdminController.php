<?php

namespace App\Controllers;

use App\Repositories\ExchangeRatesRepository;

class AdminController
{
    public function __construct(
        private ExchangeRatesRepository $exchangeRatesRepository,
    )
    {}
    public function index(): void
    {
        $exchangeRates = $this->exchangeRatesRepository->getExchangeRates();

        include '../templates/admin.php';
    }
}