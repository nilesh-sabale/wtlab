# Q13 - PHP Login Module with Cookies

## Problem Statement
Design PHP login module with user registration form, login form. System should use cookies to track users. Use session handling and database MySQL for login.

## Features
- User registration with username, email, password
- Login with session handling
- "Remember me" checkbox using cookies
- Protected home page
- Logout functionality

## How to Run

1. **Setup Database**
   ```
   http://localhost/q13/setup.php
   ```

2. **Access Application**
   ```
   http://localhost/q13/
   ```

3. **Register New User**
   - Click "Register"
   - Fill in username, email, password
   - Submit form

4. **Login**
   - Enter username and password
   - Check "Remember me" to save username in cookie
   - Click Login

## Files
- `index.php` - Home page
- `register.php` - User registration
- `login.php` - Login with cookie support
- `home.php` - Protected page after login
- `logout.php` - Logout and clear session
- `config.php` - Database connection
- `setup.php` - Database setup

## Database
- Database: `login_db`
- Table: `users` (id, username, email, password)

## Technologies
- PHP
- MySQL
- Sessions
- Cookies
