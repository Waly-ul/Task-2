# Developing a RESTful API for a Task Management System

- Build a RESTful API for a task management system that supports CRUD operations for tasks (create, read, update, delete).

- Use Laravel's API resources to format responses consistently.

- Implement authentication for API endpoints using JWT.

- Include proper validation, error handling, and documentation (e.g., in the README or using tools like Swagger/OpenAPI).

# I used Laravel's own resource controller to solve the task. Below are the route identifiers:

## Auth Routes:

- POST `/api/register` - Register new user
- POST `/api/login` - Login and get JWT
- POST `/api/logout` - Logout (JWT Required)
- GET `/api/me` - Get authenticated user (JWT Required)

## Task Routes (JWT Required)

- GET `/api/tasks`
- POST `/api/tasks`
- GET `/api/tasks/{id}`
- PUT `/api/tasks/{id}`
- Delete `/api/tasks/{id}`

Each route has been checked with the postman, and all routes have run successfully. That is, the task has performed all operations: create, read, update, and delete.


## 🚀 Project Setup Guide

### Prerequisites
- PHP >= 8.0  
- Composer  
- MySQL (or compatible database)  
- Laravel CLI (optional)  
- JWT(JSON Web Token)

### Installation Steps

1. Clone the repository  
   ```bash
   https://github.com/Waly-ul/Task-2.git

2. Instal Composer dependencies
    ```bash
    composer install

3. Copy .env.example to .env
    ```bash
    cp .env.example .env

4. Generate Laravel application key
    ```bash
    php artisan key:generate

5. Create a database named task_manager on your local MySQL server.

6. Configure your database credentials in .env
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=task_manager
    DB_USERNAME=root
    DB_PASSWORD=your_db_password

7. Run database migrations
    ```bash
    php artisan migrate

10. Generate JWT Secret key
    ```bash
    php artisan jwt:secret

11. Start the Laravel development server:
    ```
    php artisan serve