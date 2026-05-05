# Day 05 – Eloquent & Project CRUD

## 1. What did I learn today

* Understood how Eloquent ORM works in Laravel  
* Learned about mass assignment and the purpose of `$fillable`  
* Used Eloquent methods like `create()`, `update()`, `delete()`, `findOrFail()`  
* Understood how Route Model Binding automatically fetches models  
* Connected database data to Blade views instead of using dummy data  
* Implemented full CRUD operations for Projects through UI  
* Understood complete flow: Route → Controller → Model → View  

---

## 2. What worked well / what didn’t

### Worked well

* Replacing dummy data with real DB data made the app more realistic  
* Route Model Binding reduced manual querying  
* CRUD flow became clear after implementing each method step by step  
* Using `old()` improved form handling and user experience  
* Navigation between pages worked smoothly  

### Issues faced

* Initially used array syntax instead of object (`$project['name']`)  
* Faced 404 errors due to incorrect model binding  
* Form didn’t submit because of `type="button"` instead of `submit`  
* Update failed due to missing `@method('PUT')`  
* Delete required correct form method (`DELETE`)  

---

## 3. Blockers

* Confusion between using `$id` vs `Project $project`  
* Mixing manual queries with route model binding  
* Forgetting to pass variables to Blade views  
* Handling nested routes for tasks  

---

## 4. CRUD Implementation (Projects)

| Operation | Method | Description |
|----------|--------|------------|
| Create | store() | Insert new project into database |
| Read | index(), show() | Fetch and display projects |
| Update | update() | Modify existing project |
| Delete | destroy() | Remove project |

---

## 5. Eloquent vs Mongoose Mapping

| Mongoose | Eloquent |
|---------|----------|
| `Model.find()` | `Model::all()` |
| `Model.findById(id)` | `Model::findOrFail(id)` |
| `new Model().save()` | `Model::create()` |
| `Model.updateOne()` | `$model->update()` |
| `Model.deleteOne()` | `$model->delete()` |

---

## 6. Tinker Verification

```bash
php artisan tinker

```
Verified that:

* Users, Projects, Tasks, and Comments are seeded correctly
* CRUD operations reflect changes in database


## 7. Key Learnings

* $fillable protects against mass assignment
* Route Model Binding simplifies controller logic
* Blade uses object syntax (->) with Eloquent
* Forms must use correct HTTP methods (POST, PUT, DELETE)
* Backend and frontend are now connected
* CRUD is the foundation for all applications


## 8. Final Outcome

* Project CRUD fully working end-to-end
* Real data displayed in UI
* Clean MVC structure maintained
* Application behaves like a real-world system
* Ready for next step (validation, relationships, authorization)