# Simple JSON API that retrieves users and filters by multiple fields

## Dependencies
- A system that can run bash scripts
- Docker

## How to run
- Execute: `./start.sh`

## What does it include
- Self contained multi-service system infraestructure-as-code using docker. Runs with an idempotent start script
- A MySQL database with indexing optimized for data retrieval
- A Symfony 6.3 application running on top of PHP 8.2.12 that serves and endpoint that returns users in JSON format.
It can filter users by  `is_active`, `is_member`, `last_login_at` (from and to), `user_type` (multiple values).
- The Symfony application also uses in-memory caching achieving sub 10ms responses

## How to consume the API
- Interactive swagger OpenAPI documentation can be found at https://localhost/api/doc
- Query example: https://localhost/api/users?isActive=true&isMember=false&userType[]=3&userType[]=2&lastLoginAtFrom=2022-02-01

## Testing
- There are two unit tests. You can use `./exec.sh` to get a shell inside the app container and executing `vendor/bin/phpunit` should execute the unit tests.

## Things to consider
- The application creates and SSL certificate on start which you will need to accept on your machine in order to use it.
