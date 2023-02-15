# Local Setup

Config:

1. Copy .env.example and rename it to .env
2. Modify .env with your set up (ex. DB_DATABASE, DB_USERNAME, DB_PASSWORD, etc).

Run This Command to Migrate Your Migration and Seeder:
```
php artisan migrate --seed
```

Run This Command to Create Symlink Storage to Public:
```
php artisan storage:link
```

Run This Command to Running The Server App:
```
php artisan serve
```

Or Run This Command to Running The Server App With Specific Port:
```
php artisan serve --port=8080
```
