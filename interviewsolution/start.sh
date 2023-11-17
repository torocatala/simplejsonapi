#!/bin/bash

docker compose build --no-cache

docker compose up --pull always -d --wait

echo "Project running in https://localhost"

echo "Run docker compose down --remove-orphans to kill the project"
