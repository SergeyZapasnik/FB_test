# Currency Converter Module

## Project Description

The Currency Converter Module is a PHP module created as part of a test task.
Originally, the task required the development of a Drupal module, but this implementation is designed as a standalone PHP module.
It provides currency management and conversion functionality, along with a basic authentication system for admin-like pages.

## Features

- **Currency Management**: This module enables the management of a predefined list of currencies.
- **Currency Exchange Rates**: Exchange rates for all available currencies are fetched from the [fixer.io](http://fixer.io/) API and stored in a local database.
The module ensures daily updates of exchange rates.
- **Currency Conversion**: Users can convert currency amounts from one currency to another using a straightforward interface.
For example, `$converter->convert(123, 'USD', 'RUB')` will convert 123 USD to RUB.
- **Basic Authentication**: The module incorporates a basic authentication system that grants access to simulated admin pages, where you can manage and view currency exchange rates.

## File Structure

The project follows a structured file organization:

- `config/`: Configuration files, including database configuration.
- `src/`: Core module code, organized into subdirectories like `Currency` and `Auth`.
- `public/`: Publicly accessible files, including the main entry point, `index.php`.
- `templates/`: HTML templates for pages such as login and admin.
- `routes/`: Route definitions for web endpoints, e.g., `web.php`.
- `bootstrap/`: Initialization and dependency setup, e.g., `app.php`.
- `tests/`: Unit tests for various components.

## Getting Started

To use the Currency Converter Module:

1. Configure your database settings in `config/database.php`.
2. Ensure your PHP environment meets the project requirements.
3. Access the module through `public/index.php` and log in to the simulated admin area.
4. Use the admin interface to view currency exchange rates.
5. Utilize the currency conversion functionality.