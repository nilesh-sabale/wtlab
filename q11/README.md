✅ Lab 11 Complete Setup
Database Name: lab11_session_db (unique, won't conflict with other labs)

🎯 Quick Answer to Your Question:
Use SAME credentials in different browsers!

To test the 3-session limit:

Chrome: Login as user1 / password123
Firefox: Login as user1 / password123 (same user!)
Edge: Login as user1 / password123 (same user!)
Incognito: Login as user1 / password123 (4th attempt - oldest session removed!)
📖 Complete Guide Created:
I've created GUIDE.md with:

Step-by-step setup instructions
Testing procedures
How to demonstrate concurrent sessions
Troubleshooting tips
Code explanations
🚀 To Run:
Start XAMPP (Apache + MySQL)
Go to: http://localhost/q11/setup.php
Then: http://localhost/q11/login.php
Login: user1 / password123

=============================================================
# PHP Session Management System

A PHP application that limits concurrent user sessions to 3 and implements a 5-minute session timeout.

## 🎯 Features Implemented

✅ **Maximum 3 Concurrent Sessions** - Users can only have 3 active sessions at a time
✅ **5-Minute Session Timeout** - Sessions automatically expire after 5 minutes of inactivity
✅ **Automatic Session Cleanup** - Expired sessions are automatically removed
✅ **Session Tracking** - Track IP address, browser, and last activity
✅ **Real-time Timer** - Countdown timer showing remaining session time
✅ **Session Dashboard** - View all active sessions
✅ **Oldest Session Removal** - When limit is reached, oldest session is removed

## 🛠️ Technologies Used

- **PHP** - Server-side scripting
- **MySQL** - Database for session storage
- **HTML/CSS** - Frontend interface
- **JavaScript** - Real-time timer countdown

## 📁 Project Structure

```
q11/
├── config.php              # Database and session configuration
├── session_manager.php     # Session management class
├── setup.php              # Database setup script
├── login.php              # Login page
├── dashboard.php          # User dashboard
├── logout.php             # Logout handler
└── README.md             # This file
```

## 🚀 Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server (XAMPP, WAMP, or LAMP)

### Step 1: Copy Files
Copy the `q11` folder to your web server directory:
- XAMPP: `C:\xampp\htdocs\q11`
- WAMP: `C:\wamp\www\q11`
- LAMP: `/var/www/html/q11`

### Step 2: Configure Database
Edit `config.php` if needed (default settings work with XAMPP/WAMP):
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'lab11_session_db');
```

### Step 3: Run Setup
Open your browser and navigate to:
```
http://localhost/q11/setup.php
```

This will:
- Create the database
- Create required tables
- Insert demo users

### Step 4: Login
Navigate to:
```
http://localhost/q11/login.php
```

**Demo Credentials:**
- Username: `user1`
- Password: `password123`

## 📊 Database Schema

### users table
```sql
- id (INT, PRIMARY KEY)
- username (VARCHAR, UNIQUE)
- password (VARCHAR, hashed)
- created_at (TIMESTAMP)
```

### user_sessions table
```sql
- id (INT, PRIMARY KEY)
- user_id (INT, FOREIGN KEY)
- session_id (VARCHAR, UNIQUE)
- ip_address (VARCHAR)
- user_agent (VARCHAR)
- last_activity (TIMESTAMP)
- created_at (TIMESTAMP)
```

## ⚙️ Configuration

### Session Limits
Edit `config.php` to change limits:

```php
define('MAX_SESSIONS', 3);        // Maximum concurrent sessions
define('SESSION_TIMEOUT', 300);   // Timeout in seconds (5 minutes)
```

## 🔒 How It Works

### Session Creation
1. User logs in with credentials
2. System checks active sessions
3. If limit reached (3), oldest session is removed
4. New session is created and stored in database

### Session Validation
1. Every page load checks session validity
2. Verifies session hasn't expired (5 minutes)
3. Updates last activity timestamp
4. Redirects to login if invalid

### Session Timeout
1. JavaScript timer counts down remaining time
2. PHP validates timeout on each request
3. Expired sessions are automatically cleaned
4. User is redirected to login when expired

## 📱 Usage

### Login
1. Enter username and password
2. Click "Login"
3. Redirected to dashboard

### Dashboard
- View active session count
- See all active sessions with details
- Real-time countdown timer
- Logout button

### Testing Concurrent Sessions
1. Login in one browser (Chrome)
2. Login in another browser (Firefox)
3. Login in incognito mode
4. Try 4th login - oldest session will be removed

### Testing Timeout
1. Login and wait 5 minutes
2. Session will expire automatically
3. Redirected to login page

## 🎨 UI Features

- Gradient purple background
- Clean white cards
- Real-time countdown timer
- Color-coded session status
- Responsive design
- Current session highlighted in green

## 🐛 Troubleshooting

**Database Connection Error:**
- Check MySQL is running
- Verify credentials in `config.php`
- Run `setup.php` again

**Session Not Working:**
- Check PHP session is enabled
- Verify write permissions on session directory
- Clear browser cookies

**Timer Not Updating:**
- Enable JavaScript in browser
- Check browser console for errors

## 📝 Notes

- Sessions are stored in database, not files
- Expired sessions are cleaned automatically
- Password is hashed using PHP's `password_hash()`
- Session ID is generated by PHP's `session_id()`
- IP address and browser info are tracked

## 🔐 Security Features

- Password hashing with bcrypt
- SQL injection prevention (prepared statements)
- Session hijacking protection
- XSS prevention with `htmlspecialchars()`
- Automatic session cleanup

## 📄 License

This project is for educational purposes.
