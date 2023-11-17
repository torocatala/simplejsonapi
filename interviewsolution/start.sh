#!/bin/bash

docker compose down --volumes --remove-orphans

#docker compose build --no-cache
docker compose build

docker compose up --pull always -d --wait

echo "Project running in https://localhost"

echo "Run docker compose down --remove-orphans to kill the project"

docker compose logs -f
