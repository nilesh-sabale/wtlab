# Database Update Instructions

## Important: Run This First!

The database schema has been updated to include new fields (PRN, Department, Semester).

### Steps to Update:

1. **Make sure XAMPP is running** (Apache and MySQL)

2. **Run the setup script** to recreate the database with new schema:
   ```
   http://localhost/q7/backend/setup.php
   ```

3. **Start your React app**:
   ```bash
   npm start
   ```

### New Features Added:

✅ **Add New Student Form**
- Click "➕ Add New Student" button
- Enter Name
- Enter PRN Number
- Department is fixed as "Computer"
- Select Semester (5 or 6)
- All marks default to 0 (can be edited later)

✅ **Enhanced Student Selector**
- Shows student name, PRN, and semester
- Dynamically loads all students from database

✅ **Updated Database Schema**
- Added `prn` field (PRN Number)
- Added `department` field (default: Computer)
- Added `semester` field (5 or 6)
- Auto-increment ID for new students

### Usage:

1. Add a new student using the form
2. Select the student from dropdown
3. Edit their marks as needed
4. Save marks to database
5. View results automatically calculated
