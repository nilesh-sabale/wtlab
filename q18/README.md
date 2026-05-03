# Q18 - Complaint Management System

## Problem Statement
Write a program in PHP for a complaint management system where users can make complaints about services they are getting from organizations like PMC, PMT or any institution.

## Features
- Submit complaints about various organizations
- Select organization (PMC, PMT, Water, Electricity, Other)
- Admin login to view all complaints
- Mark complaints as resolved
- Track status (pending/resolved)

## How to Run

1. **Setup Database**
   ```
   http://localhost/q18/setup.php
   ```

2. **Access Application**
   ```
   http://localhost/q18/
   ```

3. **Submit Complaint**
   - Enter name, email
   - Select organization
   - Write complaint
   - Submit

4. **Admin Login**
   - Username: admin
   - Password: admin123
   - View all complaints
   - Mark as resolved using checkboxes

## Files
- `index.php` - Home page
- `submit_complaint.php` - Submit complaint form
- `admin_login.php` - Admin login
- `admin_dashboard.php` - View and manage complaints
- `config.php` - Database connection
- `setup.php` - Database setup
- `logout.php` - Logout handler

## Database
- Database: `complaint_system_db`
- Table: `complaints` (id, name, email, organization, complaint, status, created_at)

## Organizations
- PMC (Pune Municipal Corporation)
- PMT (Pune Mahanagar Transport)
- Water Department
- Electricity Board
- Other Institution

## Admin Credentials
- Username: admin
- Password: admin123
