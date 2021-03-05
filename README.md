# Vanilla deploy with Docker Compose
## Usage
- `docker-compose up`
- go to localhost:8888
- enter
  - `dbname`
  - `dbuser`
  - `dbpassword`
  - some user credentials
- retrieve personal access token from profile settings page
- `curl -X GET "http://localhost:8888/api/v2/users?page=1&limit=30&access_token=yourpersonalaccesstoken" -H  "accept: application/json"`

## Help
https://success.vanillaforums.com/kb/articles/41-authentication-with-personal-access-tokens

https://open.vanillaforums.com/discussion/comment/220157/#Comment_220157

https://github.com/vanilla/vanilla-docker
