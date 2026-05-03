# Q15 - College Complaint System

## Problem Statement
Write a web application for registering complaints for students in college. Use PHP and MySQL for frontend and backend.
- Create login page for student
- Create complaint page
- Create login page for admin
- List all complaints on admin login

## Features

### Student Features
- Student registration
- Student login
- Submit complaints with subject and description
- View own complaints and their status

### Admin Features
- Admin login (hardcoded credentials)
- View all complaints from all students
- Update complaint status (pending/resolved)

## How to Run

1. **Setup Database**
   ```
   http://localhost/q15/setup.php
   ```

2. **Access Application**
   ```
   http://localhost/q15/
   ```

3. **Student Flow**
   - Register as student
   - Login with email and password
   - Submit complaint
   - View complaint status

4. **Admin Flow**
   - Login with: admin / admin123
   - View all complaints
   - Update status to resolved or pending

## Files
- `index.php` - Home page
- `student_register.php` - Student registration
- `student_login.php` - Student login
- `complaint.php` - Submit and view complaints
- `admin_login.php` - Admin login
- `admin_dashboard.php` - View all complaints
- `config.php` - Database connection
- `setup.php` - Database setup
- `logout.php` - Logout handler

## Database
- Database: `complaint_db`
- Tables:
  - `students` (id, name, email, password)
  - `complaints` (id, student_id, subject, description, status, created_at)

## Admin Credentials
- Username: admin
- Password: admin123

## Technologies
- PHP
- MySQL
- Sessions
