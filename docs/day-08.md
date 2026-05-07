# Day 08 – Authentication & User Project Scoping

## Tasks Completed

* Installed Laravel Breeze authentication scaffolding
* Implemented authentication features:
  - Register
  - Login
  - Logout
  - Password Reset
* Added authentication middleware to protected routes
* Implemented `User -> projects()` relationship
* Scoped projects to authenticated users
* Prevented User A from viewing User B’s projects
* Linked newly created projects to logged-in users using `auth()->id()`
* Updated navigation to show:
  - Login/Register for guests
  - Logout/Profile for authenticated users
* Customized Breeze authentication UI while preserving backend functionality

---

## What I Learned

* How Laravel Breeze simplifies authentication setup
* Difference between authentication and authorization
* How session-based authentication works in Laravel
* How Laravel stores authenticated user sessions
* How to protect routes using `auth` middleware
* How to access authenticated users using `auth()`
* How relationships help scope data to users
* Why user-specific data access is important in production applications
* How Laravel automatically handles password hashing securely

---

## Breeze Installation Steps

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run dev
php artisan migrate

```

### Authentication Features Implemented

* Register	
* Login	
* Logout	
* Password Reset	
* Session Authentication	
* Route Protection	

### User Project Scoping	

**User Relationship**

Implemented relationship in User.php:

```php

public function projects()
{
    return $this->hasMany(Project::class);
}
```

### Project Scoping

**Before**

```php

Project::all()
```
**Problem:**

Every user could see all projects

**After**


Used:

```php

auth()->user()
    ->projects()
    ->with('tasks')
    ->get();
```

**Result:**

Each user can only see their own projects

**Associating Projects with Logged-In User**

**Before**

'user_id' => 1

**Problem:**

Every project belonged to the same user

**After**

```php

'user_id' => auth()->id()
```

**Result:**

Projects automatically belong to currently authenticated user


**Conditional Navigation**

Implemented conditional navbar rendering.

**Guest Users**

* Login
* Register

**Authenticated Users**

* Logout
* Dashboard
* Profile

**Authentication Flow**

Browser
→ Route
→ auth middleware
→ Controller
→ Model
→ Database
→ Blade View
→ Response

### Breeze vs JWT Authentication (Express)

| Laravel Breeze | JWT Auth in Express |
| --- | --- |
| Session-based authentication | Token-based authentication |
| Built-in authentication scaffolding | Must build manually |
| Password hashing included | Must configure manually |
| CSRF protection included | Must handle separately |
| Faster setup | More boilerplate |
| Uses Laravel middleware | Uses custom Express middleware |

### Challenges Faced

**Problem**

Projects not showing after login	Fixed User relationship
All projects belonged to same user	Replaced hardcoded user_id with auth()->id()
Users could access all projects	Scoped projects using auth()->user()->projects()
Breeze UI alignment issues	Replaced Breeze frontend with custom Blade UI
Protected routes accessible publicly	Added auth middleware


## Final Outcome

* Working authentication system implemented successfully
* User registration/login/logout functioning correctly
* Password reset functionality added
* Routes protected using auth middleware
* Projects scoped per authenticated user
* User-specific project ownership implemented
* Breeze integrated successfully
* Application security improved