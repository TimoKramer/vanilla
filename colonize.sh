#!/bin/bash

set -o pipefail
set -o errexit
set -o nounset

if [[ -z "${1+set}" ]]; then
    echo "Token is not passed as option 1";
    exit 1;
fi

TOKEN=$1

random_string() {
    head /dev/urandom | tr -dc A-Za-z0-9 | head -c 10; echo ''
}

for i in {1..100}
do
    curl "http://localhost:8888/api/v2/users" \
         --request POST \
         --header "Content-Type: application/json" \
         --header "Authorization: Bearer ${TOKEN}" \
         --data "{\"email\": \"$(random_string)@foo.bar\", \"name\": \"$(random_string)\", \"password\": \"$(random_string)\"}" \
         > /dev/null
done
