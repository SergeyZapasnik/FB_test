<?php

namespace App\Controllers;

use App\Repositories\ExchangeRatesRepository;
use App\Services\ExchangeRatesService;

class CurrencyController
{
    public function __construct(
        private ExchangeRatesRepository $exchangeRatesRepository,
        private ExchangeRatesService $exchangeRatesService
    )
    {}

    public function conversion(): void
    {
        $exchangeRates = $this->exchangeRatesRepository->getExchangeRates();

        require_once '../templates/conversion.php';
    }

    public function convert(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get data from the POST form
            $amount = $_POST['amount'];
            $fromCurrency = $_POST['fromCurrency'];
            $toCurrency = $_POST['toCurrency'];

            // Validate the input data
            $validationResult = $this->exchangeRatesService->validateConversionInput($amount, $fromCurrency, $toCurrency);
            if ($validationResult['error']) {
                // Return validation error in JSON format
                header('Content-Type: application/json');
                echo json_encode(['error' => $validationResult['message']]);
                exit;
            }

            // Prepare the response data
            $responseData = [
                'success' => true,
                'result' => $this->exchangeRatesService->convert($amount, $fromCurrency, $toCurrency)
            ];

            // Check if the conversion failed and update the response accordingly
            if ($responseData['result'] === '') {
                $responseData['success'] = false;
            }
            header('Content-Type: application/json');
            echo json_encode($responseData);
            exit;

        }
    }
}