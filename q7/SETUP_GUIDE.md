# Quick Setup Guide

## Problem: "Failed to fetch" Error

This means the backend PHP files are not accessible. Follow these steps:

## Solution:

### Step 1: Copy Files to htdocs
```
Copy entire q7 folder to: C:\xampp\htdocs\q7
```

Your structure should be:
```
C:\xampp\htdocs\q7\
├── backend\
│   ├── api.php
│   ├── db.php
│   ├── setup.php
│   └── update.php
├── src\
├── public\
└── package.json
```

### Step 2: Start XAMPP
1. Open XAMPP Control Panel
2. Start **Apache** (for PHP)
3. Start **MySQL** (for database)

### Step 3: Setup Database
Open browser: `http://localhost/q7/backend/setup.php`

You should see: "✅ Database Setup Complete!"

### Step 4: Test Backend
Open: `http://localhost/q7/backend/api.php?id=1`

You should see JSON data like:
```json
{"id":"1","name":"Nilesh Sabale",...}
```

### Step 5: Run React App
```bash
cd C:\xampp\htdocs\q7
npm install
npm start
```

## Still Getting Error?

### Check 1: Is Apache running?
- Open XAMPP, Apache should show green "Running"

### Check 2: Is q7 in htdocs?
- Check: `C:\xampp\htdocs\q7\backend\update.php` exists

### Check 3: Test update.php directly
- Open: `http://localhost/q7/backend/update.php`
- Should show blank page or JSON error (not 404)

### Check 4: Browser Console
- Press F12 in browser
- Check Console tab for error details

## Common Issues:

**Issue 1: "404 Not Found"**
- Solution: Copy q7 folder to htdocs

**Issue 2: "Connection refused"**
- Solution: Start Apache in XAMPP

**Issue 3: "Database error"**
- Solution: Run setup.php first

**Issue 4: "CORS error"**
- Solution: Already fixed in update.php headers

## Quick Test Commands:

```bash
# Test if Apache is running
curl http://localhost/q7/backend/api.php?id=1

# Should return JSON data
```

## Need Help?

1. Check XAMPP Apache logs
2. Check browser console (F12)
3. Make sure both React (port 3000) and Apache (port 80) are running
