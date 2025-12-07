# Olgur - Ollo's Game Utilty Repo

## Conventions
### Git Commits
Code
- feat : new feature
- test : adding or updating tests
- fix : bug fix
- refac : code restructure, no behavior change

Tooling
- chore : tooling, infra, cleanup
- style : formatting (Pint, Prettier)
- install: installation of packages
- conf : configuration of packages
- build : build scripts, CI config, Docker
- perf : performance improvements
- docs : documentation changes

## TODO
- Check which errors might leak data

## API & Authentication
### http.ts
A thin wrapper around axios

It provides a `request` function. This function
- Sends an axios request, and
- Returns the extracted data (res.data)

On Requests
- It sets the necessary headers for JSON
- It attaches the Bearer token

On Responses
- In calls an `errorHandler` that should handle all HTTP errors
  - As of now, it redirects on 401, notifies on 403, and maps errors on 422
  - This handler must return an `ApiError` or false if not handled
- If handled, the interceptor rejects the Promise with given ApiError  
- On non-HTTP errors it rejects with a different `ApiError`

### useApi.ts
A composable using http.ts to send requests

- It provides functions `get`, `post`, `put`, `delete` to send requests
- It provides reactive `loading` and `errors` states
- As of now, it handles 'validation' errors and rethrows all other errors
