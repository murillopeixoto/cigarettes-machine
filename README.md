# Cigarettes Machine
## Start the application
`docker-compose up -d`
### Run the command
`docker-compose exec php php cigarettes-machine/bin/console purchase-cigarettes 2 10.00`
### Run the tests
`docker-compose exec php php cigarettes-machine/vendor/bin/phpunit cigarettes-machine/tests`