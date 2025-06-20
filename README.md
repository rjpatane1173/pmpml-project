# PMPML Login & Dashboard System

This is a simple PHP-based login and user management system with MySQL integration, built for the PMPML project.

---

## 🚀 Features

- User Registration and Login
- Session Management
- Static Admin Login (for dev/test)
- Dashboard Redirection on Success
- MySQL Database Integration
- Secure Password Hashing using `password_hash()`

---

## 🛠️ Tech Stack

- PHP (vanilla)
- MySQL
- HTML/CSS
- XAMPP (or any LAMP/WAMP stack)

---

## 🗃️ Database Setup

1. Open **phpMyAdmin** or use MySQL CLI.
2. Run the SQL file: `sql/setup_pmpml_db.sql`
3. This will create:
   - Database: `pmpml_db`
   - Table: `users`
   - Optional: One static user entry

---

## 🔐 Default Static Login

This is hardcoded inside `login.php` for dev/testing purposes:

- **Email**: `admin@example.com`
- **Password**: `admin123`

---

## 🧪 How to Run Locally

1. Clone the repo:

```bash
git clone https://github.com/your-username/pmpml-project.git
cd pmpml-project
```

2. Place the project inside your XAMPP htdocs folder.

3. Start Apache and MySQL from XAMPP.

4. Access in your browser:
   http://localhost/pmpml-project/login.php
