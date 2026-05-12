# Day 12 – Testing, Deployment & Portfolio Preparation

## Tasks Completed

* Implemented Feature Tests for:

  * Project CRUD operations
  * Authentication and API authentication
  * Authorization and policy protection
  * Eloquent relationships
* Configured isolated testing database using SQLite memory database
* Used RefreshDatabase trait for clean automated tests
* Used Laravel Factories for test data generation
* Successfully executed all feature tests using:

  ```bash
  php artisan test
  ```
* Fixed failing relationship factory issue
* Prepared application for production deployment
* Deployed Laravel application publicly using Render
* Configured PostgreSQL production database
* Configured environment variables for production
* Configured queue worker for background jobs
* Configured public storage handling
* Improved README documentation
* Added live deployment URL to README
* Added screenshots and setup instructions
* Added ER diagram
* Added testing proof
* Created GitHub release tag:

  ```bash
  git tag v1.0
  ```

---

# What I Learned

* Importance of automated testing in backend development
* Difference between Unit Tests and Feature Tests
* How Feature Tests simulate real application behavior
* How RefreshDatabase keeps tests isolated
* How Laravel Factories simplify test data creation
* How Sanctum authentication can be tested using:

  ```php
  Sanctum::actingAs($user)
  ```
* How to test APIs using:

  ```php
  postJson()
  getJson()
  ```
* Importance of testing authorization rules
* How relationship testing validates Eloquent associations
* How deployment works in production environments
* Importance of environment variables
* Why deployment is important for portfolio projects
* How queue workers operate in production
* Why README quality matters for recruiters
* Importance of version tagging in Git workflows

---

# Feature Testing

## What Are Feature Tests?

Feature tests validate complete application workflows from the user perspective.

They test:

* routes
* middleware
* controllers
* validation
* database operations
* authentication
* authorization
* APIs

Feature tests improve:

* reliability
* confidence
* maintainability
* production readiness

---

# RefreshDatabase Trait

Used:

```php
use RefreshDatabase;
```

Purpose:

* creates fresh database for every test
* prevents data contamination between tests
* keeps tests isolated and deterministic

---

# SQLite In-Memory Database

Updated inside:

```text
phpunit.xml
```

Configuration:

```xml
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

Purpose:

* fast testing
* isolated environment
* prevents affecting real development database

Advantages:

* extremely fast
* temporary database
* safer automated testing

---

# Tests Implemented

## 1. API Authentication Tests

File:

```text
tests/Feature/ApiAuthTest.php
```

Tested:

* user login
* Sanctum token generation
* authenticated API access

Example Concepts:

```php
postJson()
getJson()
Sanctum::actingAs()
```

Purpose:

* verify API authentication workflow
* validate protected API routes

---

## 2. Authorization Tests

File:

```text
tests/Feature/AuthorizationTest.php
```

Tested:

* guest redirection
* protected route access
* admin access control

Purpose:

* ensure authorization rules work correctly
* validate middleware protection

---

## 3. Project CRUD Tests

File:

```text
tests/Feature/ProjectCrudTest.php
```

Tested:

* viewing projects
* creating projects
* updating projects
* deleting projects
* preventing unauthorized updates

Purpose:

* validate core business workflows
* ensure database persistence works correctly

---

## 4. Relationship Tests

File:

```text
tests/Feature/RelationshipTest.php
```

Tested:

* Project hasMany Tasks
* User hasMany Projects

Purpose:

* verify Eloquent relationship correctness
* validate relational integrity

---

# Factory Improvements

## Problem Faced

Earlier implementation:

```php
'user_id' => User::inRandomOrder()->first()->id
```

Problem:

* tests failed when database was empty
* factories depended on existing data

Error:

```text
Attempt to read property "id" on null
```

---

# Solution

Updated factory:

```php
'user_id' => User::factory()
```

Benefits:

* self-contained factories
* independent test execution
* safer automated testing

---

# Automated Test Execution

Command Used:

```bash
php artisan test
```

Result:

* all feature tests passing successfully

Purpose:

* validate production reliability
* ensure application stability

---

# API Testing Concepts

## postJson()

Used for:

* sending JSON POST requests during tests

Example:

```php
$this->postJson('/api/login', [...])
```

---

## getJson()

Used for:

* testing JSON API responses

Example:

```php
$this->getJson('/api/projects')
```

---

## assertOk()

Verifies:

```text
HTTP 200 response
```

---

## assertJsonStructure()

Validates:

* expected JSON response format

Example:

```php
->assertJsonStructure(['token'])
```

---

## assertDatabaseHas()

Checks:

* whether data exists in database

Example:

```php
$this->assertDatabaseHas('projects', [...])
```

---

## assertForbidden()

Verifies:

* unauthorized users cannot perform protected actions

---

# Sanctum Testing

Used:

```php
Sanctum::actingAs($user)
```

Purpose:

* simulate authenticated API user
* avoid manual token generation during testing

Benefits:

* cleaner tests
* simpler API authentication testing

---

# Deployment

## Platform Used

Render

Why Render?

* simple deployment workflow
* GitHub integration
* production hosting support
* beginner-friendly deployment process

---

# Deployment Workflow

## 1. GitHub Push

```bash
git add .
git commit -m "Complete Day 12 testing and deployment"
git push origin day-12
```

---

## 2. Render Web Service

Configured:

* build command
* start command
* environment variables

---

# Build Command

```bash
composer install --optimize-autoloader --no-dev
```

---

# Start Command

```bash
php artisan serve --host=0.0.0.0 --port=$PORT
```

---

# Environment Variables

Configured:

* APP_KEY
* APP_ENV
* DB credentials
* MAIL settings
* QUEUE settings

Purpose:

* secure production configuration
* avoid hardcoding sensitive data

---

# Database Migration

Executed:

```bash
php artisan migrate --force
```

Purpose:

* create production database tables safely

---

# Storage Link

Executed:

```bash
php artisan storage:link
```

Purpose:

* make uploaded attachments publicly accessible

---

# Queue Worker

Configured queue worker:

```bash
php artisan queue:work
```

Purpose:

* process queued jobs asynchronously
* handle queued emails in production

---

# README Improvements

README updated with:

* project description
* features
* tech stack
* screenshots
* ER diagram
* setup instructions
* API information
* deployment URL
* test proof

---

# Features Added to README

* Authentication
* Authorization
* REST APIs
* Sanctum token auth
* File uploads
* Queued emails
* API Resources
* Feature testing
* Deployment

---

# Version Tagging

Created release tag:

```bash
git tag v1.0
git push origin v1.0
```

Purpose:

* version tracking
* release management
* professional Git workflow

---

# Key Backend Concepts Learned

## Feature Testing

Feature testing validates complete application behavior instead of isolated functions.

---

## Authentication vs Authorization

Authentication:

* verifies user identity

Authorization:

* verifies user permissions

---

# Sanctum

Used for:

* token-based API authentication

Benefits:

* lightweight
* Laravel integration
* SPA/mobile support

---

# Policies

Used for:

* centralized authorization logic

Benefits:

* cleaner controllers
* reusable security rules
* maintainability

---

# Factories

Used for:

* generating fake test data

Benefits:

* easier testing
* isolated environments
* reusable test setup

---

# RefreshDatabase

Used for:

* clean database state during testing

Benefits:

* deterministic test behavior
* prevents data contamination

---

# Queues

Used for:

* asynchronous background jobs

Benefits:

* better scalability
* improved response times
* non-blocking operations

---

# Challenges Faced

| Problem                       | Solution                                   |
| ----------------------------- | ------------------------------------------ |
| Tests affecting real DB risk  | Configured SQLite memory database          |
| Relationship test failing     | Fixed ProjectFactory using User::factory() |
| Unauthorized test failures    | Corrected policy authorization logic       |
| Queue worker not processing   | Configured background worker correctly     |
| Deployment environment issues | Added proper ENV variables                 |
| PostgreSQL migration issues   | Verified Render DB configuration           |
| File access issues            | Ran storage:link                           |

---

# Final Outcome

The Laravel Task Management System now supports:

* Authentication
* Authorization
* REST APIs
* Sanctum API authentication
* File uploads
* Queued emails
* Automated Feature Testing
* Relationship handling
* Public deployment
* Production-style architecture

The project is now:

* portfolio-ready
* deployment-ready
* recruiter-ready
* interview-ready

---

# Key Takeaway

Day 12 transformed the project from:

```text
learning project
```

into:

```text
production-style portfolio backend application
```

This day demonstrated:

* testing practices
* deployment workflow
* backend engineering principles
* scalability concepts
* production readiness
* real-world Laravel development
