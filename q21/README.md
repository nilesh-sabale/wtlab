# Q21 - Student Records Management

## Problem Statement
Create Responsive website for showing EDIT and DELETE student records from database using PHP.

## Features
- View all student records in table
- Add new student
- Edit existing student
- Delete student with confirmation
- Responsive design (mobile-friendly)
- Clean, minimal UI

## How to Run

1. **Setup Database**
   ```
   http://localhost/q21/setup.php
   ```
   Creates database with 3 sample students.

2. **Access Application**
   ```
   http://localhost/q21/
   ```

3. **Operations**
   - **View**: See all students in table
   - **Add**: Click "+ Add New Student" button
   - **Edit**: Click "Edit" button on any row
   - **Delete**: Click "Delete" button (with confirmation)

## Files
- `index.php` - Main page showing all students
- `add.php` - Add new student form
- `edit.php` - Edit student form
- `config.php` - Database connection
- `setup.php` - Database setup

## Database
- Database: `q21_stud_db`
- Table: `students` (id, name, email, phone, course)

## Responsive Features
- Mobile-friendly layout
- Adjusts font sizes on small screens
- Touch-friendly buttons
- Viewport meta tag for proper scaling

## Technologies
- PHP
- MySQL
- Responsive CSS
- Media queries
