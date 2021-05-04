# Cars API

## Getting Started
- First clone the repo: ``git clone git@github.com:peter-fritchley/cars-api.git``
- Next, start the containers (from within the newly checked out repo): ``docker-compose up``
- Setup the database and seed the data: ``docker exec -it cars-api php artisan migrate --seed --env=local``
- Run the test suite: ``docker exec -it cars-api php vendor/bin/phpunit``

## Potential improvements
- The make and model of the car could me moved out into their own tables (in the same way as colour) to make it easier to view all cars by a certain make.
- The API should be documented using OpenAPI - this would make it simple for others to use as you could auto generate an SDK using OpenAPI code gen (https://github.com/OpenAPITools/openapi-generator)
- There should also be consideration about using JSON-LD in order to make the data more semantic, possibly referencing the Schema.org datatype for Car (https://schema.org/Car)
