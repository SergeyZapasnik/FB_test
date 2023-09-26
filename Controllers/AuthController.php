<?php

namespace App\Controllers;

class AuthController
{
    public function login()
    {
        // TODO Add logic for displaying the login page
        include '../templates/login.php';
    }

    public function processLogin()
    {
        // TODO Add logic for processing login form submission
        // Validate user credentials and authenticate
        // Redirect to the admin panel on successful login or display an error message
    }

    public function logout()
    {
        // TODO Add logic for user logout (if applicable)
        // Redirect to the login page or display a success message
    }
}