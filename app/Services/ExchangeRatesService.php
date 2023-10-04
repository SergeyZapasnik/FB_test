<?php

namespace App\Services;

use App\Repositories\ExchangeRatesRepository;
use InvalidArgumentException;

class ExchangeRatesService
{
    public function __construct(
        private ExchangeRatesRepository $exchangeRatesRepository,
    )
    {}

    /**
     * Converts an amount from one currency to another, considering the base currency.
     *
     * @param float $amount           The amount to convert.
     * @param string $fromCurrencyCode The code of the source currency.
     * @param string $toCurrencyCode   The code of the target currency.
     *
     * @return float                  The converted amount.
     *
     * @throws InvalidArgumentException If invalid currency codes are provided.
     */
    public function convert(float $amount, string $fromCurrencyCode, string $toCurrencyCode): float
    {
        if ($fromCurrencyCode === $toCurrencyCode) {
            return $amount;
        } else {
            $exchangeRates = $this->exchangeRatesRepository->getExchangeRates();
            $fromRate = json_decode($exchangeRates['rates'])->$fromCurrencyCode;
            $toRate = json_decode($exchangeRates['rates'])->$toCurrencyCode;

            // Perform the currency conversion
            $amountAsFloat = bcmul($amount, $fromRate, 10); // Multiply by fromRate

            return round(bcdiv($amountAsFloat, $toRate, 10), 3);
        }
    }


    /**
     * Validate input data for currency conversion.
     *
     * @param mixed $amount       The amount to convert.
     * @param mixed $fromCurrency The source currency code.
     * @param mixed $toCurrency   The target currency code.
     *
     * @return array An array containing validation results:
     *               - 'error'   : Indicates if there are validation errors (true/false).
     *               - 'message' : A message describing the validation result.
     */
    public function validateConversionInput(mixed $amount, mixed $fromCurrency, mixed $toCurrency): array
    {
        $validationResult = ['error' => false, 'message' => ''];

        // Check if required fields are present
        if (empty($amount) || empty($fromCurrency) || empty($toCurrency)) {
            $validationResult['error'] = true;
            $validationResult['message'] = 'Missing required fields';
        }

        // Validate the 'amount' field
        if (!is_numeric($amount) || $amount <= 0) {
            $validationResult['error'] = true;
            $validationResult['message'] = 'Invalid "amount" value';
        }

        // Additional validation for 'fromCurrency' and 'toCurrency'

        return $validationResult;
    }
}