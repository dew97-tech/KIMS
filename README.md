Follow the mentioned instructions to run:

1. Open terminal
2. Run: `git clone https://github.com/abir-imtiaz/kes-augmenta.git`
3. Run: `cd kes-augmenta`
4. Run: `composer install`
5. Run: `cp .env.example .env`
6. Update .env with you database information
7. Run: `php artisan key:generate`
8. Run: `php artisan migrate`
9. Run: `php artisan db:seed --class=UserRoleSeeder`
10. Run: `php artisan db:seed --class=UserSeeder`
11. Run: `php artisan serve`
12. Open browser
13. Go to link http://localhost:8000
