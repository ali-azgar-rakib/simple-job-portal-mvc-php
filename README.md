# 🧑‍💼 Simple Job Portal (Vanilla PHP MVC)

A **simple job portal** built from scratch using **Vanilla PHP**, following the **MVC architecture**. This project is designed to help understand how web applications work **without relying on any frameworks**.

It includes essential features like **CRUD operations**, **authentication/authorization**, **search functionality**, and a **custom routing system** — all written in plain PHP.

🔗 **Live Demo**: [https://test-jobportal.great-site.net/](https://test-jobportal.great-site.net/)

---

## ✨ Features

- 🧱 Pure PHP (no frameworks used)
- 📁 Follows the MVC (Model-View-Controller) structure
- 🔐 User authentication and authorization
- 🔎 Search job listings by keyword
- 📝 CRUD operations for job listings
- 🌐 Custom-built router
- 🧹 Clean URLs using `.htaccess`

---
```text
## 📁 Project Structure

Root
├── public/ # Entry point of the app (index.php)
├── App/ # Core app logic: controllers, models, views, DB connection
├── Framework/ # Reusable components: router, session, validation, middleware
├── config/ # Configuration files (e.g., db.php)

```

---

## 🚀 Getting Started

1. Clone the repository  
   ```bash
   git clone https://github.com/your-username/simple-job-portal.git


2. Move the project to your web server (e.g., XAMPP, WAMP, Laravel Valet).

3. Set the DocumentRoot of your server to the /public folder.

4. Import the SQL file into your database.

5. Update your database credentials in config/db.php.

🙋‍♂️ Why This Project?
This project is ideal for beginners who want to:

Understand PHP behind the scenes

Learn how routing, MVC, and authentication work

Build a complete PHP project from scratch without relying on Laravel or CodeIgniter


