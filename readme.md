# Bug proof for cached field values in laracasts/behat-laravel-extension

This project is meant to explain the bug mentioned here: 

https://github.com/laracasts/Behat-Laravel-Extension/issues/55

## Rough bug description

The bug affects testing mandatory form field behavior with behat scenarios.  

The following scenario should succeed:
1. Visit form page
2. Fill in form incompletely and submit
3. See error message
4. Switch to homepage
5. Switch to form page
6. Fill in the fields that were formerly missing
7. Press submit
8. See error message

When doing this manually and when you reach Step 5, you will notice that the form is empty. However, when testing this
with behat, the form fields will be filled with the old values.

## Setup
* Clone the project. 
* Run `cp .env.example .env` (copies example dotenv to `.env`)
* Run `php artisan key:generate` (generates your application key in `.env`)

### Test
* Run `phpunit`. The tests should succeed. This proves that laravel works as you would expect it
* Run `vendor/bin/behat`. The tests should fail. This proves that laracasts/behat-laravel-extension caches filled in form fields even if you change the pages in between.

If you wish to test the form behavior manually, just run `php artisan serve` and visit `localhost:8000/plain-form` in your browser.