# Day 09 – Authorization with Policies and Middleware

## Tasks Completed

* Implemented Laravel Authorization using Policies
* Protected project deletion using `$this->authorize()`
* Created custom role-based middleware (`CheckRole`)
* Restricted admin routes using middleware
* Added role handling in the `User` model
* Updated authenticated redirect path to `/projects`
* Used Blade `@can` directives for conditional UI rendering
* Protected project and task routes using `auth` middleware
* Removed completed TODO comments from implementation files
* Organized routes inside middleware groups

---

## What I Learned

* Difference between Authentication and Authorization
* How Laravel Policies work internally
* How `$this->authorize()` protects controller actions
* How to use `@can` in Blade templates
* How middleware intercepts requests before controllers
* How role-based access control works
* Why authorization is important for application security
* How Laravel automatically throws `403 Unauthorized`
* How middleware aliases are registered and used in routes
* Best practices for protecting routes and resources

---

## Authorization Implementation

### Project Authorization

Implemented authorization inside `ProjectController.php`:

```php
$this->authorize('delete', $project);
```
Result

Only authorized users can delete projects.

If unauthorized:

403 Unauthorized

Role-Based Middleware

Custom Middleware Created
```php
php artisan make:middleware CheckRole
```
Middleware Logic

if (!auth()->user() || auth()->user()->role !== $role) {
    abort(403, 'You are not authorized to perform this action');
}

Result

Only users with the required role can access protected routes.

#### Route Protection

Protected Routes

```php
Route::middleware('auth')->group(function () {

    Route::resource('projects', ProjectController::class);

    Route::resource('projects.tasks', TaskController::class);

});
```

Admin Route Protection

```php
Route::get('/admin', function () {
    return 'Admin Dashboard';
})->middleware(['auth', 'role:admin']);

```
Result

* Guests cannot access protected routes
* Only admins can access admin routes
* Blade Authorization
* Conditional Rendering

Used:

@can('update', $project)
Result

Only authorized users can see edit/delete buttons.

**Updating Redirect Path**

Updated:

public const HOME = '/projects';
Result

Users are redirected to the projects page after login.

User Model Update

Added role field to fillable array:
```php
protected $fillable = [
    'name',
    'email',
    'password',
    'role',
];
```
Result

Role data can now be mass assigned safely.

**Middleware Flow**

Browser
→ Route
→ Middleware
→ Authorization Check
→ Controller
→ Policy
→ Database
→ Blade View
→ Response

**Policies vs Middleware**

| Policies   ||  Middleware |
|---------------|--------------|
| Protect specific models/resources  || Protect routes |
| Used inside controllers/views  || Used before request reaches controller |
| Handles ownership/permissions  || Handles authentication/roles |
| Fine-grained authorization  || Broad route-level protection |
| Example: delete project  || Example: admin-only route |

### Challenges Faced

| Problem | Solution |
| --- | --- |
| Unauthorized users accessing routes | Added auth middleware |
| Need admin-only pages | Created role middleware |
| Users able to delete any project | Added policy authorization |
| Edit/Delete buttons visible to everyone | Used @can directives |
Duplicate project routes |  Moved routes inside auth middleware group
Git Commands Used

```bash
git checkout -b day-9

git add .

git commit -m "Day 9: Implemented Authorization with policies and middleware"

git push origin day-9
```
## Final Outcome

* Authorization system implemented successfully
* Policy-based access control working
* Role-based middleware implemented
* Admin routes protected
* Unauthorized actions blocked with 403 response
* Blade authorization implemented using @can
* Projects and tasks secured behind authentication
* Laravel application security improved significantly