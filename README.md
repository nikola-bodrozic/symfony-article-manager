Symfony Article Manager
=======================

## Deployment
After checkout run 
* `composer install`
* import logan.sql
* rename file `app/config/parameters.yml.dist` to `app/config/parameters.yml` and add database credentials 

## Testing
From project root run
- PHPUnit: `phpunit -c app/phpunit.xml.dist -v`
- Methods in test files:  `phpunit -c app/phpunit.xml.dist --testdox`

## Description
A Symfony project with articles and users. Each article can be written by one or more users. Each user can write one or more articles. There are two roles admin and user.