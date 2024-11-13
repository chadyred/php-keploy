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

Is it possible to record many conntainer ? A full network ?
