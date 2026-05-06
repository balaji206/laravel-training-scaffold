# Day 07 – Form Requests & Validation

## Tasks Completed

* Created Form Request classes:
  - StoreProjectRequest
  - UpdateProjectRequest
  - StoreTaskRequest
  - UpdateTaskRequest

* Moved validation logic out of controllers into Form Request classes
* Added validation rules for:
  - Projects
  - Tasks
* Added custom validation rule:
  - `not_in:test,dummy`
* Added custom validation error messages
* Implemented `old()` helper to preserve form input
* Added inline validation error display using `@error`
* Updated all create/edit Blade forms with validation support

---

## What I Learned

* How Form Requests work in Laravel
* How Laravel automatically validates requests before controller execution
* Why validation should be separated from controllers
* How to preserve old form input using `old()`
* How to display inline validation errors using `@error`
* How custom validation rules improve data quality
* How validation improves user experience and application reliability

---

## Validation Rules Implemented

### Project Validation

| Field | Rules |
|---|---|
| name | required, string, min:3, max:255, not_in:test,dummy |
| description | nullable, string, min:5 |
| status | nullable, in:active,archived,completed |

---

### Task Validation

| Field | Rules |
|---|---|
| title | required, string, min:3, max:255, not_in:test,dummy |
| description | nullable, string, min:5 |
| status | required, in:todo,in_progress,done |

---

## Custom Validation Rule

Implemented custom validation rule:

```php
not_in:test,dummy

```

## Validation Flow

### Before

* Validation logic written directly inside controllers
* Controllers became larger and harder to maintain

Example:
```php
$request->validate([
    'name' => 'required'
]);
```
###After

* Validation moved into dedicated Form Request classes
* Controllers became cleaner and easier to manage

Example:

```php
public function store(StoreProjectRequest $request)
old() Helper

```
Used Laravel’s old() helper to preserve form input when validation fails.

Example:
```
value="{{ old('name') }}"
```

This prevents users from retyping data after validation errors.

### Inline Validation Errors

Added inline validation error handling using:

```php
@error('name')
    <p>{{ $message }}</p>
@enderror
```
#### Implemented in:

* projects/create.blade.php
* projects/edit.blade.php
* tasks/create.blade.php
* tasks/edit.blade.php

### Screenshots

![Validation Error State](./images/validation-error.png)


## Challenges Faced

| Problem | Solution | 
| ----|----|
Validation silently failed  | Changed status from required to nullable
Form reloaded without saving | Debugged Form Request validation
Errors not visible          | Added @error directives
Old input not preserved     | Added old() helper correctly

## Final Outcome

* Form Request classes implemented successfully
* Validation logic separated from controllers
* Inline validation errors displayed correctly
* old() helper preserved user input
* Custom validation rules implemented
* Forms became cleaner and more user-friendly
* Application validation structure became production-ready