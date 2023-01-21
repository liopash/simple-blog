# Task

## Build a simple blog in Symfony.

### The blog should contain the following:

Overview of blog messages with title, description, date, author with email and number of comments
Blog detail page with title, content, date, an overview of comments with content, author with email and date
Page to add a blog post with the above data and validation in the form
Form to add comments
Nothing else, authentication is not needed.

### Constraints

Use a MySQL database
Use pagination for the overviews
There is no need to care about frontend, plain HTML is enough
Write your code as clean and straightforward as possible, feel free to use DDD tactical patterns, if you know how
Use Doctrine ORM as persistence layer
Write a readme for local installation

Bonus points: The site should run on Docker
Bonus points: Write Unit tests for code from the Model layer

Hand in assignment

A public GitHub, GitLab or BitBucket repository
symfony_assignment.txt
Displaying symfony_assignment.txt.

---

## Solution

The app is built using Symfony 6 and uses a MySQL 8 database. User authentication is handled by email and a user is only created during the creation of a blog post or comment. The app has a simple user interface that allows users to create new blog posts or comments. Pagination is set to display 5 blog posts per page and 7 comments per blog post. The application can be run using the `docker-compose up` command after that it will be available via browser (`http://127.0.0.1:8008`), and there is also a Makefile available with additional scripts. The database is prepopulated with data defined in fixtures, and tests can be run inside a docker container using the `make test` command or by running phpunit after a local composer install. The app is dockerized. The docker-compose command will run 4 services: php-fpm with the application, nginx, mysql, and adminer for a database client (as used during development). Note that some additional tooling may be needed to run the app with make command but docker, docker-compose will be sufficient for docker-compose run.