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

# Permission System
## Permissions
- There is a small number of global Permissions
- Permissions have a scope (for now): global, system, module
- [scope, name] must be unique

## Roles
- Roles are either
  - Global (system_id is null), or
  - Belong to a specific System

## During migration
- All Permissions are created
- A global 'admin' Role is created and all global Permissions attached

## On User creation
- The user is assigned the global 'admin' Role - TODO!!!

## On System creation
- The 'core' Module is created
- An 'admin' Role is created, all 'system' Permissions are attached
- A 'module-admin' Role is created, all 'module' Permissions are attached
- The user is assigned the admin and module-admin Roles TODO!!! multiple Roles?

## Memberships and Subscriptions
- A User can be a member of a System
  - In and of itself, this is just a container for Modules
- Within a System, a User can be subscribed to any of its Modules

The table role_user holds foreign Keys to the four relevant Tables
- User: The user that is a member or subscriber
- Role: His/Her Role for the given context
- System and Module = Context:
  - S: null, M: null: User: Global Role
  - S: id,   M: null: Membership - System/Module Role
  - M: id,   M: id:   Subscription - Module Roles require a Subscription
