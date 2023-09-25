<?php

namespace Currency;

interface CurrencyRepositoryInterface
{
    public function getAllCurrencies(): array;

    public function getCurrencyByCode(string $code): ?Currency;

    public function addCurrency(Currency $currency): bool;

    public function updateCurrency(Currency $currency): bool;

    public function deleteCurrency(string $code): bool;
}
