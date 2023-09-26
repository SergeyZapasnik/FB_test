<?php

namespace App\Controllers;

class CurrencyController
{
    public function listCurrencies()
    {
        // TODO Add logic for displaying a list of saved currency rates
        // Retrieve data from the Currency model or repository
        include '../templates/admin.php';
    }

    public function conversion()
    {
        // TODO Add logic for the currency conversion page
        include '../templates/conversion.php';
    }

    public function updateCurrencies()
    {
        // TODO Add logic for updating currency rates
        // Fetch and update currency rates
        // Redirect to the list of currencies or display a success message
    }
}