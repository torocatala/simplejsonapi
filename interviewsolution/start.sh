#!/bin/bash

docker compose down --volumes --remove-orphans

#docker compose build --no-cache
docker compose build

docker compose up --pull always -d --wait

echo "Project running in https://localhost"

echo "Check the main endpoint in https://localhost/api/users"

echo "And the documentation in https://localhost/api/doc"

echo "Run docker compose down --remove-orphans to kill the project"
