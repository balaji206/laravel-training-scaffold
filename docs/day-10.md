# Day 10 – REST API Development with Sanctum Authentication

## Tasks Completed

* Installed Laravel Sanctum for API authentication
* Configured token-based authentication using Bearer Tokens
* Added `HasApiTokens` trait to the User model
* Created REST API endpoints for authentication, projects, and tasks
* Implemented login and logout APIs
* Protected API routes using `auth:sanctum`
* Built CRUD APIs for Projects
* Built CRUD APIs for Tasks
* Used API Resources for consistent JSON responses
* Reused existing Form Request validation classes inside API controllers
* Implemented ownership authorization checks for Projects and Tasks
* Prevented unauthorized users from accessing other users’ resources
* Tested all endpoints using Bruno/Postman
* Implemented secure token-based authentication workflow
* Added proper API status responses and validation handling

---

## What I Learned

* How Laravel Sanctum handles token-based authentication
* Difference between session authentication and token authentication
* How Bearer Tokens work in REST APIs
* How to secure APIs using `auth:sanctum`
* How API Resources standardize JSON responses
* How Route Model Binding improves controller readability
* How Form Requests can be reused inside APIs
* Importance of ownership authorization in multi-user applications
* How to test APIs using Bruno/Postman
* Why APIs are important for React, Vue, and mobile applications
* How REST APIs are structured in Laravel

---

## Sanctum Installation Steps

```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
User Model Configuration
```
Added Sanctum trait inside:
```php
app/Models/User.php
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
}
```
#### API Endpoints Implemented

| Method | Endpoint | Description |
| POST | /api/login | User login and token generation |
| POST | /api/logout | Logout and token revocation |
| GET | /api/projects | Get authenticated user's projects |
| POST | /api/projects | Create project |
| GET | /api/projects/{project} | Show project |
| PUT | /api/projects/{project} | Update project |
| DELETE | /api/projects/{project} | Delete project |
| GET | /api/tasks | Get authenticated user's tasks |
| POST | /api/tasks | Create task |
| GET | /api/tasks/{task} | Show task |
| PUT | /api/tasks/{task} | Update task |
| DELETE | /api/tasks/{task} | Delete task |


#### Sanctum Authentication Flow

Client

→ Login API
→ Sanctum Token Generated
→ Bearer Token Stored
→ Token Sent in Authorization Header
→ auth:sanctum Middleware
→ API Controller
→ Database
→ JSON Response

### API Resources Implemented

Created:

app/Http/Resources/ProjectResource.php
app/Http/Resources/TaskResource.php

Purpose:

Standardized JSON responses
Controlled exposed fields
Improved frontend integration
Centralized API formatting logic

Example Response:
```php
{
    "id": 1,
    "name": "API Project",
    "description": "Testing API",
    "status": "active"
}
```

* Authorization Logic Implemented
* Project Authorization
* Users can only access their own projects
* Unauthorized access returns:
* 403 Forbidden
* Task Authorization
* Users can only access tasks belonging to their own projects
* Prevented task creation inside unauthorized projects
* Added ownership checks before update/delete operations
* Form Request Reuse

Reused validation classes:

* StoreProjectRequest
* UpdateProjectRequest
* StoreTaskRequest
* UpdateTaskRequest

Benefits:

* Cleaner controllers
* Reusable validation logic
* Reduced duplicate validation code
* Better project maintainability
* Route Protection

Protected API routes using:
```php
Route::middleware('auth:sanctum')
```
Result:

* Only authenticated users can access protected APIs
* Invalid or missing tokens return:
* 401 Unauthorized
* Testing Performed

### Challenges Faced
Problem | Solution
Sanctum authentication confusion  | Learned Bearer Token workflow
Unauthorized API access | Added auth:sanctum middleware
Missing imports in API controllers | Added proper namespaces
Route model binding confusion | Replaced string $id with model binding
Tasks accessible across users | Added ownership authorization
Validation duplicated in controllers | Reused Form Requests
API responses inconsistent | Used API Resources


## Final Outcome

* Fully functional REST API implemented successfully
* Sanctum token authentication working correctly
* Secure Bearer Token authentication implemented
* Projects and Tasks APIs completed
* Ownership-based authorization implemented
* API Resources standardized all JSON responses
* CRUD APIs tested successfully using Bruno/Postman
* Secure token revocation implemented
* Application became frontend-ready for React/Vue/mobile integration
* Production-style Laravel API architecture achieved