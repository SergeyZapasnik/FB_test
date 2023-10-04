<?php

namespace App\Services;

use App\Models\ExchangeRates;
use App\Services\Interfaces\ExchangeRatesApiInterface;
use Config\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

class ExchangeRatesApi implements ExchangeRatesApiInterface
{
    private const API_URL = 'https://data.fixer.io/api/latest';

    public function __construct(
        private Config $config,
    )
    {}

    /**
     * Fetches the latest exchange rates from the API.
     *
     * @return stdClass|null The API response as a stdClass object or null if an error occurs.
     */
    public function getExchangeRates(): ?stdClass
    {
        try {
            $response = (new Client())->request('GET', self::API_URL, [
                'query' => [
                    'access_key' => $this->config->get('FIXER_ACCESS_API_KEY'),
                    'base' => $this->config->get('BASE_CURRENCY'),
                    'symbols' => implode(",", ExchangeRates::CURRENCY_CODES_TO_EXCHANGE),
                ]
            ]);

//            return json_decode($response->getBody(), false);
//            Access Restricted - Your current Subscription Plan does not support HTTPS Encryption.
//            105	The current subscription plan does not support this API endpoint.
//            Parse the sample response as JSON and return it for testing purposes.

            $response = '{
            "success":true,
            "timestamp":1696340103,
            "base":"USD",
            "date":"2023-10-03",
            "rates":{
                "USD":1,
                "GBP":1.660069,
                "JPY":1.433085,
                "EUR":4.62594,
                "RUB":18.608522
                }
            }';
            return json_decode($response, false);
        } catch (GuzzleException $e) {
            // Error handling here
            return null;
        }

    }
}