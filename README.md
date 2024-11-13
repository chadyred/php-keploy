# Keploy MF

To reproduce :

1. `cd symfony`
2. `make clean-all`
3. swithc the config with `containerName: "php-book-sf"` to record mocks at init
4. `keploy start`
5. Open another tab or shell
6. `make init-db`
7. Look at the folder keploy and see the mock
8. Try a curl like : 

    ```shell
    curl --location --request POST 'http://localhost:8080/employee' \
    --header 'Content-Type: application/json' \
    --data-raw '{
        "firstName": "Myke",
        "lastName": "Tyson",
        "email": "mt2@gmail.com",
        "timestamp":1
    }'
    ```
    
    And nothing appear because the load balancing of nginx to PHP is not record

9. switch the config with `containerName: "nginx-book-sf"` to record mocks at init
10. stop keploy and run again `keploy record`
11. Try a curl like :

    ```shell
    curl --location --request POST 'http://localhost:8080/employee' \
    --header 'Content-Type: application/json' \
    --data-raw '{
        "firstName": "Myke",
        "lastName": "Tyson",
        "email": "mt2@gmail.com",
        "timestamp":1
    }'
    ```

12. Look at the folder keploy and see the tests but no mock