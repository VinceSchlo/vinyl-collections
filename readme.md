## Configuration

1. Run : composer install
2. Create file "database.sqlite" inside database folder
3. Edit your .env file : 
    ````
    DB_CONNECTION=sqlite
    DB_HOST=path/to/your/database/database.sqlite
4. Run : php artisan migrate
