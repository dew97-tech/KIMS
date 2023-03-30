Follow the mentioned instructions to run:

1. Open terminal
2. Run: `https://github.com/dew97-tech/KIMS.git`
3. Run: `cd KIMS`
4. Run: `composer install`
5. Run: `cp .env.example .env`
6. Update .env with you database information
7. Run: `php artisan key:generate`
8. Run: `php artisan migrate`
9. Run: `php artisan db:seed --class=UserRoleSeeder`
10. Run: `php artisan serve`
11. Open browser
12. Go to link http://localhost:8000
