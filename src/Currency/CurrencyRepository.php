<?php

namespace Currency;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    private $currencies = []; // This is a simple in-memory storage for demonstration purposes

    public function getAllCurrencies(): array
    {
        return $this->currencies;
    }

    public function getCurrencyByCode(string $code): ?Currency
    {
        foreach ($this->currencies as $currency) {
            if ($currency->getCode() === $code) {
                return $currency;
            }
        }

        return null;
    }

    public function addCurrency(Currency $currency): bool
    {
        $this->currencies[] = $currency;
        return true; // Assuming successful addition
    }

    public function updateCurrency(Currency $currency): bool
    {
        // TODO Implement the update logic here, e.g., update the currency in the database
        return true; // Assuming successful update
    }

    public function deleteCurrency(string $code): bool
    {
        // TODO Implement the delete logic here, e.g., delete the currency from the database
        return true; // Assuming successful deletion
    }
}
