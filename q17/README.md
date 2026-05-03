# Q17 - Waste Management System

## Problem Statement
Write a PHP program to collect waste like plastic or paper. System should accept location where the waste material is present and it should direct concerned authority to collect and manage the waste.

## Features
- Report waste with location and type
- Select waste type (plastic, paper, metal, organic, other)
- Authority login to view reports
- Mark waste as collected
- Track status (pending/collected)

## How to Run

1. **Setup Database**
   ```
   http://localhost/q17/setup.php
   ```

2. **Access Application**
   ```
   http://localhost/q17/
   ```

3. **Report Waste**
   - Click "Report Waste"
   - Enter name, location, waste type, description
   - Submit

4. **Authority Login**
   - Username: authority
   - Password: auth123
   - View all reports
   - Mark as collected using checkboxes

## Files
- `index.php` - Home page
- `report_waste.php` - Report waste form
- `authority_login.php` - Authority login
- `authority_dashboard.php` - View and manage reports
- `config.php` - Database connection
- `setup.php` - Database setup
- `logout.php` - Logout handler

## Database
- Database: `waste_db`
- Table: `waste_reports` (id, name, location, waste_type, description, status, created_at)

## Authority Credentials
- Username: authority
- Password: auth123
