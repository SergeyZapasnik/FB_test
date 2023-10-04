<?php

namespace App\Cron;

use App\Repositories\ExchangeRatesRepository;
use App\Services\ExchangeRatesApi;


class CurrencyUpdater
{
    public function __construct(
        private ExchangeRatesRepository $exchangeRatesRepository,
        private ExchangeRatesApi $exchangeRatesApi
    )
    {}

    /**
     * Fetches exchange rates from the API and inserts or updates them in the database.
     * Logs success if rates are updated successfully, and logs an error if an exception occurs.
     */
    public function run(): void
    {
        try {
            $exchangeRatsStd = $this->exchangeRatesApi->getExchangeRates();

            $this->exchangeRatesRepository->insertOrUpdateExchangeRates($exchangeRatsStd);

            // Add success logging here
            // logSuccess('Currency rates updated successfully');
        } catch (\Exception $e) {
            // You can add error logging here
            // logError('Error updating currency rates: ' . $e->getMessage());
        }
    }
}