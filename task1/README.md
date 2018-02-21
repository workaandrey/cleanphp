## Clone the repository

~~~
cd /some/location
git clone git@github.com:workaandrey/cleanphpschoolstore.git
~~~

## Install dependencies

~~~
composer install
~~~

## Create database from dump `database/school_store.sql`

## Update database config in `config/app.php`

## Run `php -S localhost:8888` in `public` directory

### Example urls:

1. [All Products](http://localhost:8888)
2. [Products by category](http://localhost:8888/byCategory/2)
3. [Search Example #1](http://localhost:8888/search?filter[manufacturer]=Erich%20Krause)
4. [Search Example #2](http://localhost:8888/search?filter[year]=1913&filter[isbn]=9781539014447)