# Attendance System

Simple PHP attendance management system for students and teachers.

## Features

### Student Features
- Self-registration with roll number, name, email, and password
- Unique roll number and email validation

### Teacher Features
- Login to teacher dashboard
- View all registered students
- Mark attendance using checkboxes
- Shows roll number and name for each student
- Save attendance for the current date

## Setup Instructions

1. **Run Setup**
   ```
   http://localhost/q12/setup.php
   ```
   This will create the database and tables automatically.

2. **Student Registration**
   ```
   http://localhost/q12/student_register.php
   ```
   Students can register themselves.

3. **Teacher Login**
   ```
   http://localhost/q12/teacher_login.php
   ```
   Default credentials:
   - Username: `teacher`
   - Password: `teacher123`

## Database Structure

### Tables
- **students**: Stores student information (roll_no, name, email, password)
- **attendance**: Stores daily attendance records
- **teachers**: Stores teacher login credentials

## Usage

1. Students register themselves
2. Teacher logs in
3. Teacher marks attendance by checking boxes next to present students
4. Attendance is saved for the current date
5. Teacher can update attendance on the same day

## Files

- `index.php` - Home page
- `student_register.php` - Student registration form
- `teacher_login.php` - Teacher login page
- `teacher_dashboard.php` - Attendance marking interface
- `setup.php` - Database setup script
- `config.php` - Database configuration
- `logout.php` - Logout handler
