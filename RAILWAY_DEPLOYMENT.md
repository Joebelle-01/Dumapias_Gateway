# Railway deployment (Gateway + Site1 + Site2)

This repo is the **Gateway** service (`ddsgateway`).

Your microservices are in separate repos/paths:

- Site1: `C:\Users\Legion\Documents\GitHub\Dumapias_Act3\ddsbe`
- Site2: `C:\Users\Legion\Documents\GitHub\Dumapias_Site2\ddsbe`

## Service setup (Railway UI)

Create **3 Railway services** (recommended: one Railway project containing 3 services):

1) **Site1** (root directory: `ddsbe`)
2) **Site2** (root directory: `ddsbe`)
3) **Gateway** (root directory: `ddsgateway`)

Each service should use the start command:

`php -S 0.0.0.0:$PORT -t public`

(`nixpacks.toml` is provided to enforce this.)

## Environment variables

### Site1

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=<railway site1 url>`
- `ACCEPTED_SECRETS=<same as USERS1_SERVICE_SECRET in Gateway>`
- `DB_CONNECTION=mysql` + `DB_HOST/DB_PORT/DB_DATABASE/DB_USERNAME/DB_PASSWORD` (from Railway MySQL plugin)

### Site2

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=<railway site2 url>`
- `ACCEPTED_SECRETS=<same as USERS2_SERVICE_SECRET in Gateway>`
- `DB_CONNECTION=mysql` + `DB_HOST/DB_PORT/DB_DATABASE/DB_USERNAME/DB_PASSWORD` (from Railway MySQL plugin)

### Gateway

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=<railway gateway url>`
- `USERS1_SERVICE_BASE_URL=<railway site1 url>`
- `USERS2_SERVICE_BASE_URL=<railway site2 url>`
- `USERS1_SERVICE_SECRET=<random secret>`
- `USERS2_SERVICE_SECRET=<random secret>`
- `DB_CONNECTION=mysql` + `DB_HOST/DB_PORT/DB_DATABASE/DB_USERNAME/DB_PASSWORD` (from Railway MySQL plugin)

## One-time commands (Railway shell)

Run these on each deployed service:

### Site1 / Site2

- `php artisan migrate --force`

### Gateway

- `php artisan migrate --force`
- `php artisan passport:install --force --no-interaction`
- `php artisan passport:client --client --name "Gateway Client"`

## Smoke tests

- `GET <gateway-url>/health` should return JSON with `services.users1` and `services.users2`.
- `POST <gateway-url>/oauth/token` should return an `access_token`.
- `GET <gateway-url>/api/users1` with `Authorization: Bearer <access_token>` should return users.
