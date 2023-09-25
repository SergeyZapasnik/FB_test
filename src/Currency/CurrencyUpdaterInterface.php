<?php

namespace Currency;

interface CurrencyUpdaterInterface
{
    public function updateCurrencies(): bool;
}