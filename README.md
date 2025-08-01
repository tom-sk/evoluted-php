Steps to run code:
1. run `composer install`
2. run `php script-1.php` This will created `output.json`
2. run `php script-2.php` This will read `output.json` and create score.json with the results for each card and the total results
3. run ` ./vendor/bin/pest tests/Unit` to run all Unit tests. I created my tests using teh Pest testing suite