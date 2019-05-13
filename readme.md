## Configuration

1. Run : composer install
2. Run : npm install
3. Run : npm run dev
4. Create file "database.sqlite" inside database folder
5. Edit your .env file : 
    ````
    DB_CONNECTION=sqlite
    DB_HOST=path/to/your/database/database.sqlite
6. Run : php artisan migrate
