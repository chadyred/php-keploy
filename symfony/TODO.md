* deactivate authentification because we need a mix of stateful with custom authenticator and see with a Header API like
so it is not handfree
* allow everybody to create everything and create book
* prepare slide
  * expose the fact a custom authenticator with a custom header could be added with a bundle to enable keploy to be 
  * fully exploited with symfony
* main command : 
  make ENV=test start && sleep 2 && m init-db && m fixtures && m ENV=test keploy-record
  
* hard time...a payload of the requset match the postgres result : adding a header "on the fly" by copy paste will result on 
error, because the request will not be match...because of this new header
    maybe because of mocks and:

  postgresrequests:
    - header: [P, B, D, E]
    identifier: ClientRequest
    length: 8
    payload: UAAAAJcAU0VMRUNUIHQwLmlkIEFTIGlkXzEsIHQwLmVtYWlsIEFTIGVtYWlsXzIsIHQwLnJvbGVzIEFTIHJvbGVzXzMsIHQwLnBhc3N3b3JkIEFTIHBhc3N3b3JkXzQgRlJPTSBzZWN1cml0eV91c2VyIHQwIFdIRVJFIHQwLmVtYWlsID0gJDEgTElNSVQgMQAAAQAAAABCAAAAIQAAAAEAAAABAAAADXRlc3RAdGVzdC5jb20AAQAARAAAAAZQAEUAAAAJAAAAAABTAAAABA==
 
