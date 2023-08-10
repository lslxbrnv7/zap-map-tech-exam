<h1>ZapMap</h1>

-   Add a .env file
-   Run `composer update`
-   Run `php artisan migrate`
-   Kindly run `php artisan app:import-data-from-csv` to import data to DB
-   Endpoint should be `{URL}/api/locations` accepts (longitude, latitude, and radius as parameters)
    Example : `127.0.0.1:8000/api/locations?longitude=51.47560393&latitude=-2.380716715&radius=6000`
