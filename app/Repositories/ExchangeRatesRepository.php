<?php

namespace App\Repositories;

use App\Models\ExchangeRates;
use App\Repositories\Interfaces\ExchangeRatesRepositoryInterface;
use Config\Db;
use Exception;
use InvalidArgumentException;
use RuntimeException;
use stdClass;

class ExchangeRatesRepository implements ExchangeRatesRepositoryInterface
{
    public function __construct(
        private Db $db
    )
    {}

    /**
     * Validate the exchange rates data in the given stdClass object.
     *
     * @param stdClass $exchangeRatesStd The stdClass object representing exchange rates data.
     *
     * @throws InvalidArgumentException If the data is not valid.
     */
    private function validateExchangeRates(stdClass $exchangeRatesStd): void
    {
        // Check if the required properties exist in the stdClass object
        if (!property_exists($exchangeRatesStd, 'base') ||
            !property_exists($exchangeRatesStd, 'rates') ||
            !property_exists($exchangeRatesStd, 'date')) {
            throw new InvalidArgumentException('Invalid exchange rates data: Missing required properties.');
        }

        // Validate currency codes in the 'rates' property
        foreach ($exchangeRatesStd->rates as $currencyCode => $exchangeRate) {
            if (!in_array($currencyCode, ExchangeRates::CURRENCY_CODES_TO_EXCHANGE)) {
                throw new InvalidArgumentException('Invalid exchange rates data: Invalid currency code.');
            }
            // Validate exchange rate values (e.g., positive numbers)
            if (!is_numeric($exchangeRate) || $exchangeRate <= 0) {
                throw new InvalidArgumentException('Invalid exchange rates data: Invalid exchange rate value.');
            }
        }

        // Validate the 'base' property (e.g., it should be a non-empty string)
        if (!is_string($exchangeRatesStd->base) || empty($exchangeRatesStd->base)) {
            throw new InvalidArgumentException('Invalid exchange rates data: Invalid base currency.');
        }

        // Validate the 'rates' property (e.g., it should be an object or array)
        if (!is_object($exchangeRatesStd->rates) && !is_array($exchangeRatesStd->rates)) {
            throw new InvalidArgumentException('Invalid exchange rates data: Invalid rates data format.');
        }

        // Validate the 'date' property (e.g., it should be a valid date format)
        if (!strtotime($exchangeRatesStd->date)) {
            throw new InvalidArgumentException('Invalid exchange rates data: Invalid date format.');
        }
    }

    /**
     * Get exchange rates data from the database.
     *
     * @return mixed The exchange rates data from the database.
     */
    public function getExchangeRates(): mixed
    {
        return $this->db->query("SELECT * FROM exchange_rates name LIMIT 1");
    }

    /**
     * Inserts or updates exchange rates data in the database based on the provided stdClass object.
     *
     * @param stdClass $exchangeRatesStd The stdClass object representing exchange rates data.
     *
     * @throws InvalidArgumentException If the provided data is invalid or if there's a database error.
     */
    public function insertOrUpdateExchangeRates(stdClass $exchangeRatesStd): void
    {
        $this->validateExchangeRates($exchangeRatesStd);

        $existingRecord = $this->db->query("SELECT id FROM exchange_rates name LIMIT 1", []);

        $exchangeRates = new ExchangeRates(
            $exchangeRatesStd->base,
            json_encode($exchangeRatesStd->rates),
            $exchangeRatesStd->date,
        );

        if ($existingRecord) {
            $this->update($existingRecord['id'], $exchangeRates);
        } else {
            $this->insert($exchangeRates);
        }
    }

    /**
     * Inserts a new exchange rates record into the database.
     *
     * @param ExchangeRates $exchangeRates The ExchangeRates object to insert.
     *
     * @throws RuntimeException If there's a database error during insertion.
     */
    public function insert(ExchangeRates $exchangeRates): void
    {
        try {
            // Insert the ExchangeRates object into the 'exchange_rates' table
            $this->db->insert("exchange_rates", (array) $exchangeRates);
        } catch (Exception $e) {
            // Handle any database insertion errors here
            throw new RuntimeException('Error inserting exchange rates data: ' . $e->getMessage());
        }
    }

    /**
     * Updates an existing exchange rates record in the database.
     *
     * @param int           $id            The ID of the record to update.
     * @param ExchangeRates $exchangeRates The ExchangeRates object containing updated data.
     *
     * @throws RuntimeException If there's a database error during the update.
     */
    public function update(int $id, ExchangeRates $exchangeRates): void
    {
        try {
            $this->db->update('exchange_rates',
                [
                    'base_currency' => $exchangeRates->getBaseCurrency(),
                    'rates' => $exchangeRates->getRates(),
                    'date' => $exchangeRates->getDate(),
                ],
                'id = :id',
                [
                    ':id' => $id,
                    ':base_currency' => $exchangeRates->getBaseCurrency(),
                    ':rates' => $exchangeRates->getRates(),
                    ':date' => $exchangeRates->getDate()
                ]
            );
        } catch (Exception $e) {
            // Handle any database update errors here
            throw new RuntimeException('Error updating exchange rates data: ' . $e->getMessage());
        }
    }
}