ToDoList
========
<a href="https://codeclimate.com/github/jucarre/TodoList/maintainability"><img src="https://api.codeclimate.com/v1/badges/84b84550c11328957219/maintainability" /></a>
[![Build Status](https://travis-ci.org/jucarre/TodoList.svg?branch=master)](https://travis-ci.org/jucarre/TodoList)

Project 8: Improve an Existing Project


## Pre-requisites
- [Link](https://symfony.com/doc/current/setup.html#technical-requirements) to doc technical requirements
- Symfony Local Web Server or Configure your local server MAMP, WAMP
- PHP 7.3 or more
- MySQL 5.7 or more

## Installation

1. Copy repository 

        git clone https://github.com/jucarre/TodoList.git

2. Configure BDD connect on `.env` file

3. Install the dependencies

        composer install
        
4.  Create database

        bin/console doctrine:database:create
        
5. Migrate database table

        bin/console doctrine:schema:create
        
6. Load fixtures in database
        
        bin/console doctrine:fixtures:load -n

7. Start server
   
        symfony server:start
        
 8. Tests
    
        bin/phpunit
        or
        bin/phpunit --coverage-html docs/test-coverage
