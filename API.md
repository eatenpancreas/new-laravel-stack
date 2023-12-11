
# Rules

* All routes are in JSON format.
* Types can be found in `web/app/lib`: `/errors/`, `/requests/` and `/responses/` respectively.
---
* NEEDS means that the route needs a body or request parameters.
* GIVES means that the route gives a json response.
* AUTHORIZED means that the route needs a bearer token in the header.
* ERROR means that the route can give an error response.
---
* ERROR `Error.Head` should always be handled because this is the error that will occur if anything goes fatally wrong.
* ERROR `Error.Unauthenticated` can always occur if the route is marked as AUTHORIZED. This can happen when the bearer 
  token is incorrect and should always be handled.


# Routes:
### Index
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

