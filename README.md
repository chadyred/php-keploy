# Keploy MF

To reproduce (on `ghcr.io/keploy/keploy:v2.3.0-beta38`):

1. `cd symfony`
2. `make install`
3. `make clean`
4. `keploy start`
5. Open another tab or shell
6. `make init-db` to play migrations of the BDD to init it
7. Look at the folder keploy and see the mock
8. Try a curl like : 

    ```shell
    curl --location --request POST 'http://localhost:8000/employee' \
    --header 'Content-Type: application/json' \
    --data-raw '{
        "firstName": "Myke",
        "lastName": "Tyson",
        "email": "mt2@gmail.com",
        "timestamp":1
    }'
    ```
    Logs are good : `php-book-sf       | 172.21.0.2 -  13/Nov/2024:06:26:08 +0000 "POST /index.php" 200`

9. Comment in "compose.yaml" the postgres server and the "deponds_on" of the standalone PHP servuce
10. Run `keploy test`
11. See the error

Is it possible to record many container ? A full network ?

---  

- I we forget a 404 or to identify asset calls which generate a 404 everytime, it is nice to play this test with all data and assets
installed to be closer of the production server
- Record only what we failed like a page access
- Docker seems to be used and created without taking "compose.yaml" and the "healthcheck" seems to block the record...don't know why

To test : 

```
The rerecordcmd allow user to record new keploy testcases/mocks from the existing test cases for the given testset(s)
Usage:

keploy rerecord -c "node src/app.js" -t "test-set-0"
```
- the configuration have onn ly on ncommand:  use a "make start" is not possible, this is the direct command and nnothing else 
which will be detected : "docker compose --env-file .env-compose up --build" is a docker command and interprete like this "curl XXX"
is another command, even if their start something else
- Inn "test-xx we have "assertion" in whiuch we have to ignore "X-Cookie" : because it is a variable annd it is
- problematic ito the cache / test context because we have a diff...it is specified also for the cache, so we have to
use "ESI" to cache only the static block and not the variables to be able to ot create systématically the cache
- LAUNCH TEST IN A NEW AND CONFIDETIAL TAB : FIELDS COULD BE PREFILLED BECAUSE OF THE BROWSER
- 

Idea : 
- try to add fields to show the "rerecord" option with the new filed and without create a new test

TODO : 

- check slack to know how to replace / assert but ignore in body form as string

DEMO : 

1. make ENV=test start && sleep 2 && make init-db && make fixtures && make ENV=test keploy-record
2. Open browser in ghost mode
2. go to "/"
3. go to "/login" : test@test.com / test
4. stop record
5. m ENV=test keploy-test

