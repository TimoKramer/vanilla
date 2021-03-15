# Vanilla deploy with Docker Compose
## Usage
- `docker-compose up`
- change the permission of the folders `cache` `conf` and `uploads` to user 33 or do some namespace remapping
- go to localhost:8888
- enter
  - `vanilla_mysql_1`
  - `dbname`
  - `dbuser`
  - `dbpassword`
  - some user credentials
- add this line to `vanilla/conf/config.php`
 ```$Configuration['Garden']['RewriteUrls'] = true```
- retrieve personal access token from profile settings page
- `curl -X GET "http://localhost:8888/api/v2/users?page=1&limit=30" -H  "accept: application/json" -H "Authorization: Bearer yourpersonalaccesstoken"`

## Sample Users
Run `colonize.sh yourpersonalaccesstoken` to create 100 random sample users.

## Help
https://success.vanillaforums.com/kb/articles/41-authentication-with-personal-access-tokens

https://open.vanillaforums.com/discussion/comment/220157/#Comment_220157

https://github.com/vanilla/vanilla-docker
