# Day 01 – Laravel Setup & PHP Refresher

## 5 things in PHP that surprised me as a JS dev

1. Variables in PHP use `$` (like `$name`) which is very different from JavaScript.
2. PHP runs on the server, unlike JavaScript which runs mostly in the browser.
3. Associative arrays in PHP behave like objects in JavaScript.
4. PHP has built-in functions for many tasks (like string and array handling).
5. Blade templating syntax (`{{ }}`) feels similar to JSX but runs on the server.

---


## Setup Gotchas I Faced

* PHP ZIP file download kept failing due to network/K7 antivirus.
* Fixed it by using XAMPP instead of manual PHP installation.
* Faced "Vite manifest not found" error → solved using:

  ```bash
  npm install
  npm run dev
  ```
* Composer needed PATH setup to work globally.
* MySQL connection required correct username/password in `.env`.

---


## Final Status

* Laravel app running successfully on `http://localhost:8000`
* Database connected and migrations working
* Frontend assets compiled using Vite

---

## 📸 Application Screenshot

![Laravel App Screenshot](images/day1-output.png)