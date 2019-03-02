<a href="https://travis-ci.com/rosstafarian/spendy"><img src="https://img.shields.io/travis/rosstafarian/spendy/master.svg?style=for-the-badge" alt="Build Status"></a>
<a href="https://codecov.io/gh/rosstafarian/spendy"><img src="https://img.shields.io/codecov/c/github/rosstafarian/spendy/master.svg?style=for-the-badge" alt="codecov"></a>

# Spendy

Spendy is a super simple budget and expense tracker

Track expenses in your own custom budget categories and get your spending under control!

## Built on:

<img src="https://laravel.com/assets/img/components/logo-laravel.svg" height="60px">

* Laravel 5.8
* PHP 7.2
* MySQL (or database of your choice)
* ReactJS/Redux (coming soon)

## Installation

1. Install PHP >= 7.1 `brew install php`
2. Install [Composer](https://getcomposer.org/) `brew install composer`
3. Install local web server and database
    * [Valet](https://laravel.com/docs/5.8/valet) or [Valet Plus for Mac](https://github.com/weprovide/valet-plus#installation)
are recommended for local hosting/development

4. Run the following commands in the project's directory:

```bash
composer install
```
```bash
php artisan migrate
```
```bash
php artisan db:seed
```
```bash
php artisan voyager:install
```
```bash
php artisan passport:install
```
