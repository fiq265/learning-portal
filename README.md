<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Setup Instruction

Installation
- Clone repository.
- Setup environment by copy .env.example and rename to .env . Fill in database configuration.
- Download dependency package (~ composer install).
- Generate Application Key (~ php artisan key:generate).
- Migrate and seed database (~ php artisan migrate --seed).
- Create storage symbolic link (~ php artisan storage:link).
- Run application (~ php artisan serve).
- Run URL generated in the browser (http://localhost:8000).

Remarks
- Only User and Role/Permission tables got the data.
- The database has 1 administrator, 2 teachers and 10 students (Please ignore Administrator user).
- To login, please find information in the User seed file.
- Required to login or register a new user to get Bearer Token to use for API Authentication.
- API files can be found in API folder inside the project folder.




## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
