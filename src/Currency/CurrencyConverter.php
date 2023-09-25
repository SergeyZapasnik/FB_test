<?php

namespace Currency;

class CurrencyConverter
{
    private $currenciesRepository;

    public function __construct(CurrencyRepositoryInterface $currenciesRepository)
    {
        $this->currenciesRepository = $currenciesRepository;
    }

    public function convert(float $amount, string $fromCurrencyCode, string $toCurrencyCode): float
    {
        // Retrieve currency exchange rates from the repository
        $fromCurrency = $this->currenciesRepository->getCurrencyByCode($fromCurrencyCode);
        $toCurrency = $this->currenciesRepository->getCurrencyByCode($toCurrencyCode);

        if (!$fromCurrency || !$toCurrency) {
            throw new \InvalidArgumentException('Invalid currency codes');
        }

        // Perform the currency conversion
        $conversionRate = 1.0; // Default to 1:1 if rates are not available (// TODO fetch rates from repository)
        $convertedAmount = $amount * $conversionRate;

        return $convertedAmount;
    }
}