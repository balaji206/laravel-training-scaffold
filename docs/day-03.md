# Day 03 – Blade Views & UI

## 1. What did I learn today

* Learned how Blade templating works in Laravel  
* Understood how to reuse layouts using `@extends` and `@section`  
* Used `{{ }}` to display dynamic data in views  
* Learned how to loop data using `@foreach`  
* Understood how to use `@if` for simple conditions  
* Got clarity on how controllers pass data to views  

---

## 2. What worked well / what didn’t

### ✅ Worked well

* Creating Blade files for different pages was simple  
* Connecting controller to views made the flow clear  
* Using dummy data helped understand how UI rendering works  
* Navigation between pages (list → detail) worked smoothly  

### ⚠️ Didn’t work initially

* Pages were showing plain text because controller was returning strings  
* Faced error while using `$project->name` because data was an array  
* Fixed it by switching to `$project['name']`  
* Got confused between when to use model binding and when not to  

---

## 3. Blockers

* Initially unsure whether to implement full logic or just UI  
* Understanding how Blade connects with controller data took some time  
* Minor confusion with syntax differences (array vs object access)  

---

## 4. Pages Implemented

| Page | URL | Purpose |
|------|-----|--------|
| Projects List | /projects | Display all projects |
| Project Detail | /projects/{id} | Show details of a project |
| Create Project | /projects/create | Show form UI |
| Edit Project | /projects/{id}/edit | Show edit form |
| Tasks List | /projects/{id}/tasks | Display tasks for a project |
| Task Detail | /projects/{id}/tasks/{task} | Show task details |
| Create Task | /projects/{id}/tasks/create | Show task form |
| Edit Task | /projects/{id}/tasks/{task}/edit | Show edit form |

---

## Final Status

* All required Blade pages are created and working  
* UI is rendering properly with dummy data  
* Navigation between pages is working correctly  
* Blade directives like `@extends`, `@section`, `@foreach`, and `@if` are used  
* No database or backend logic implemented yet (UI only)