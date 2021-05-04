# Cars API

## Getting Started
- First clone the repo: ``git@github.com:peter-fritchley/cars-api.git``
- Next, start the containers (from within the newly checked out repo): ``docker-compose up``
- Setup the database and seed the data: ``docker run -it cars-api php artisan migrate --seed --env=local``
- Run the test suite: ``docker run -it php vendor/bin/phpunit``
