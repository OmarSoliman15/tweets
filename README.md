Tweeting system - Backend
===
Tweeting system is a social media for small blogs.

## Requirements
The project is based on the version `6.x` of the Laravel framework, 
so make sure that you are satisfying the requirements
listed in the [framework's documentation](https://laravel.com/docs/6.x#server-requirements)

## Installation
Run the following commands in order to get a ready to use clone of the application:

1. Clone the repository 
```bash
git@github.com:OmarSoliman15/tweets.git```
2. Get into the directory 
```bash
cd tweets
```
3. Check that your environment satisfy the requirements 
```bash
composer check-platform-reqs
```
4. Install composer dependencies 
```bash
composer install
```
5. Setup your envorinment 
```bash
cp .env.example .env
```
6. Generate app secret key 
```bash
php artisan key:generate
```

Now you have a ready to use clone of the application.

### Running Automated Tests
> Note: The project is covered by Feature (API) tests.

Run the following command to run the tests:
```bash
./vendor/bin/phpunit
```


### Use The API

You can use the `tweets` service that you can register,
simply make a post request to the following endpoint:
```
http://localhost:8000/api/auth/register
```

