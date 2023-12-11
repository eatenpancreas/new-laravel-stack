

# Routes:
* `GET /` - returns status of the server 
  * GIVES `Response.Status`


* `GET /api` - returns status of the server 
  * GIVES `Response.Status`

### Auth
* `POST /api/auth/register` - registers a user 
  * NEEDS `Request.Register` 
  * GIVES `Response.Authenticated`
  * ERROR `Error.Validation` if email is taken or password is too short


* `POST /api/auth/login` - logs in a user 
  * NEEDS `Request.Login` 
  * GIVES `Response.Authenticated`
  * ERROR `Error.Validation` if the login data is incorrect


* `POST /api/auth/logout` - logs in a user
    * AUTHORIZED
    * GIVES `Response.Success`
    * ERROR `Error.Unauthenticated` if the bearer token is invalid

