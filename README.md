# Currency Converter Module

## Project Description

The Currency Converter Module is a PHP module created as part of a test task.
Originally, the task required the development of a Drupal module, but this implementation is designed as a mvc.
It provides currency management and conversion functionality, without a authentication system for admin-like pages.

## Features

- **Currency Management**: This module enables the management of a predefined list of currencies.
- **Currency Exchange Rates**: Exchange rates for all available currencies are fetched from the [fixer.io](http://fixer.io/) API and stored in a local database.
The module ensures daily updates of exchange rates.
- **Currency Conversion**: Users can convert currency amounts from one currency to another using a straightforward interface.
For example, `$converter->convert(123, 'USD', 'RUB')` will convert 123 USD to RUB.

## File Structure

The project follows a structured file organization:

- `config/`: Configuration files, including database configuration.
- `src/`: Core module code, organized into subdirectories like `Currency` and `Auth`.
- `public/`: Publicly accessible files, including the main entry point, `index.php`.
- `templates/`: HTML templates for pages such as login and admin.
- `routes/`: Route definitions for web endpoints, e.g., `web.php`.