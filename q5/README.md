# Lab 5 - Student CRUD with PRN System

## Features:

✅ **PRN Number as Primary Key**
- PRN must be exactly 8 digits
- PRN is unique (no duplicates allowed)
- PRN cannot be changed after creation

✅ **Duplicate Prevention**
- System checks if PRN already exists
- Shows error message if duplicate PRN is entered
- Prevents multiple students with same PRN

✅ **Validation**
- Client-side: HTML5 pattern validation (8 digits only)
- Server-side: PHP regex validation
- Database: PRIMARY KEY constraint

✅ **CRUD Operations**
- Create: Add student with PRN
- Read: View all students
- Update: Edit name and email (PRN locked)
- Delete: Remove student by PRN

## Database Setup:

The table structure:

```sql
CREATE TABLE students (
    prn VARCHAR(8) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);
```

## How to Run:

1. Install XAMPP/WAMP
2. Start Apache and MySQL
3. Copy `q5` folder to `htdocs`
4. **IMPORTANT:** First run setup: `http://localhost/q5/setup.php`
5. Then open: `http://localhost/q5/index.php`

**Note:** If you get "Unknown column 'prn'" error, run setup.php first to create the correct table structure.

## Testing PRN Validation:

**Test 1 - Valid PRN:**
- Enter: 12345678 (8 digits)
- Result: ✅ Student added successfully

**Test 2 - Invalid PRN (less than 8 digits):**
- Enter: 123456 (6 digits)
- Result: ❌ Error: "PRN must be exactly 8 digits"

**Test 3 - Invalid PRN (more than 8 digits):**
- Enter: 123456789 (9 digits)
- Result: ❌ Error: "PRN must be exactly 8 digits"

**Test 4 - Duplicate PRN:**
- Add student with PRN: 12345678
- Try adding another student with same PRN: 12345678
- Result: ❌ Error: "PRN 12345678 already exists!"

**Test 5 - Edit Student:**
- PRN field is disabled (cannot be changed)
- Only name and email can be updated

## Files:

- `setup.php` - **RUN THIS FIRST** to create database table
- `index.php` - Main page with form and student list
- `add.php` - Add student with PRN validation
- `edit.php` - Edit student (PRN locked)
- `delete.php` - Delete student by PRN
- `db.php` - Database connection
- `style.css` - Styling
- `README.md` - This file
