<?php

namespace App\Repositories\Interfaces;

use InvalidArgumentException;
use stdClass;

interface ExchangeRatesRepositoryInterface
{
    /**
     * Get exchange rates data from the database.
     *
     * @return mixed The exchange rates data from the database.
     */
    public function getExchangeRates(): mixed;

    /**
     * Inserts or updates exchange rates data in the database based on the provided stdClass object.
     *
     * @param stdClass $exchangeRatesStd The stdClass object representing exchange rates data.
     *
     * @throws InvalidArgumentException If the provided data is invalid or if there's a database error.
     */
    public function insertOrUpdateExchangeRates(stdClass $exchangeRatesStd): void;
}