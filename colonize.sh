#!/bin/bash

set -o pipefail
set -o errexit
set -o nounset

random_string() {
    head /dev/urandom | tr -dc A-Za-z0-9 | head -c 10; echo ''
}

for i in {1..100}
do
    curl "http://localhost:8888/api/v2/users" \
         --request POST \
         --header "Content-Type: application/json" \
         --header "Authorization: Bearer va.ut9MliNhjXhXl0iaawncfhSkIBcdpBzk.wtwVcw.DyDufid" \
         --data "{\"email\": \"$(random_string)@foo.bar\", \"name\": \"$(random_string)\", \"password\": \"$(random_string)\"}" \
         > /dev/null
done
