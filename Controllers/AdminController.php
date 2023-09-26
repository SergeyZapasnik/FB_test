<?php

namespace App\Controllers;

class AdminController
{
    public function index()
    {
        // TODO Add logic for displaying the admin panel and the list of saved currency rates
        // Retrieve data from the Currency model or repository
        include '../templates/admin.php';
    }
}