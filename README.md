# Alqa

Galeria de expresiones andinas
*"gallery of andean expressions"*

## Requirements

* Laravel
* Vue.js
* Tailwindcss
* PostgreSQl

## Deployment instructions

1. Generate APP_KEY
2. Install composer dependencies:

        composer install

3. Install npm dependencies:

        npm install

4. Add MIX_APP_URL variable to .env file (if using valet: http://alqa.test/)
5. Add AWS Credentials to .env file
6. Create PostgreSQL database
7. Run migrations and seeders:
        
        php artisan migrate:fresh --seed

8. Build assets and keep watching over changes:
        
        npm run watch

