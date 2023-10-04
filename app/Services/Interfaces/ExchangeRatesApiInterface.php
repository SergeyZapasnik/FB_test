<?php

namespace App\Services\Interfaces;

use stdClass;

interface ExchangeRatesApiInterface
{
    public function getExchangeRates(): ?stdClass;
}
