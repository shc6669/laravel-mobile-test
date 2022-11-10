## Vanguard - Advanced PHP (Laravel) Login and User Management

- Developed and Crafted by [Chandrayana Putra]
- Laravel Version (8.52.0)

# How to use
- Download or clone this repo
- After finish clone this repo, use syntax "composer install" in terminal
- Copy and paste .env.example. And rename it to ".env"
- In .env file, matching to your database environment. Start from "DB_DATABASE, DB_USERNAME, DB_PASSWORD" 
- Import raw database in folder "Database" with filename "database.sql" to your database
- Create storage link with syntax "php artisan storage:link"
- Run with syntax "php artisan serve"

# Backend Access
- This backend feature also can use it to input the data as well.
- The link for backend : http:localhost:8000/login

Superadmin Role
- Use this credentials for admin role:
- username: admin
- password: admin123

Manager Role
- Use this credentials for user role:
- username: chandra
- password: chandra123

 Admin Role
- Use this credentials for user role:
- username: keanu
- password: password123

User Role
- Use this credentials for user role:
- username: john.wick
- password: password123

# API Accessible and Documentation
- To enable API. Copy variable '#EXPOSE_API=true' in .env.example to 'EXPOSE_API=true', to your .env.
- [API DOC](https://documenter.getpostman.com/view/5936761/2s8YekQurf#6fd4377f-a8bc-455d-9038-b5be39d869dc)