# Day 02 – Routing & Controllers

## 1. What did I learn today

* Learned how Laravel maps URLs to controller methods using routes  
* Understood resource routing using `Route::resource()`  
* Got clarity on nested routes like `/projects/{id}/tasks`  
* Learned how controllers handle requests and return responses  
* Understood the concept of Route Model Binding and why it caused 404 errors  

---

## 2. What worked well / what didn’t

### ✅ Worked well

* Setting up routes using `Route::resource` was straightforward  
* Replacing `abort(501)` with simple return statements helped understand flow  
* Testing routes in browser made things clearer  

### ⚠️ Didn’t work initially

* Faced 404 error while accessing `/projects/1`  
* Issue was due to using `Project $project` (model binding without DB data)  
* Fixed it by switching to `$project` (just ID)  

---

## 3. Blockers

* Confusion about when to follow TODO comments strictly vs adapting for current day  
* Understanding nested routing parameters (`project`, `task`) took some time  
* PowerShell didn’t support `grep`, had to use alternative command  

---

## 4. Route Table

| URL | Method | Controller@Method | Purpose |
|-----|--------|------------------|--------|
| /projects | GET | ProjectController@index | List all projects |
| /projects/create | GET | ProjectController@create | Show create project page |
| /projects/{id} | GET | ProjectController@show | Show a single project |
| /projects/{id}/tasks | GET | TaskController@index | List tasks for a project |
| /projects/{id}/tasks/{task} | GET | TaskController@show | Show a specific task |

---

## Final Status

* All routes are defined and accessible  
* Each controller method returns placeholder responses like `show project 5`  
* Verified routes in browser (`/projects`, `/projects/1`, `/projects/1/tasks`)  
* Documentation completed with route table  