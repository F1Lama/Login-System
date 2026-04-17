# PHP Login System with Validation & Authentication

## Overview

A secure and reusable full-stack login system built with PHP and MySQL.
This project demonstrates user authentication, input validation, password hashing, and session-based access control.

---

## Features

* User Registration & Login
* Secure Password Hashing
* Session-Based Authentication
* Protected Dashboard
* Logout Functionality
* Input Validation (Username, Email, Password)
* UI Alert Messages with Animation

---

## Technologies Used

* HTML5
* CSS3 (Bootstrap)
* PHP
* MySQL

---

## Validation Rules

* Username: 3–20 characters (letters, numbers, and symbols: _ . @ ! $ % -)
* Email: must be a valid email format
* Password:

  * Minimum 8 characters
  * At least one uppercase letter
  * At least one lowercase letter
  * At least one number
  * At least one special character

---

## How to Run Locally

1. Install XAMPP

2. Move the project folder to:

   ```
   C:\xampp\htdocs\
   ```

3. Start Apache & MySQL

4. Open phpMyAdmin

5. Create a database (e.g. `login_system`)

6. Import the SQL file

7. Update database connection in `db.php`

8. Open in browser:

   ```
   http://localhost/loginSystemProject/
   ```

---

## Project Structure

* index.php → Registration page
* login.php → Login page
* dashboard.php → User dashboard
* logout.php → Logout logic
* db.php → Database connection
* CSS/ → Styles

---

## Screenshots

### Register Page

<img src="https://github.com/user-attachments/assets/c79bf89d-2ec8-4ed7-9380-273f2e71c833" width="600"/>

### Login Page

<img src="https://github.com/user-attachments/assets/ae6d9d13-17d6-4a27-8d44-ec860930dd47" width="600"/>

### Dashboard

<img src="https://github.com/user-attachments/assets/3d77358b-b8d4-469a-8b9c-6675effc5fa3" width="600"/>

---

## Future Improvements

* Password reset feature
* Email verification
* Remember me functionality
* AJAX form submission
* Prepared statements for enhanced security

---

## Author

Lama Aldhafyan
