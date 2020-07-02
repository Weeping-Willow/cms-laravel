# About project
<img src="Media\Capture.PNG"></img>
\n
# Things used in this project
- Routes
- Views
- Database migarations
- Models
- Controllers resource
- Route resource 
- Using route names instead
- Flash messages
- Requests


# Requirement 
- Git
- Docker
- Docker-compose
- php in path

# Installation guide

1. Git clone the project

2. Cd to the folder where docker-compose file is located using the terminal

3. Use this command: docker-compose up -d --build

4. Then cd into web folder

5. Here you need to create .env file from .env.example and set these variables like this:

    - DB_DATABASE=laravel_todo_db
    - DB_USERNAME=root
    - DB_PASSWORD=root


6. Use this command: php artisan migrate --seed

7. Proceed to this link: http://localhost:8001/