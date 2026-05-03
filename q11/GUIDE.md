# Lab 11 - Complete Guide
## PHP Session Management with Concurrent Session Limit & Timeout

---

## 📋 Lab Requirements

✅ Limit maximum concurrent sessions to **3 per user**  
✅ Set session expiration timeout to **5 minutes**  
✅ Automatic cleanup of expired sessions  
✅ Track and display active sessions  

---

## 🚀 Setup Instructions

### Step 1: Start XAMPP
1. Open XAMPP Control Panel
2. Start **Apache** (for PHP)
3. Start **MySQL** (for database)

### Step 2: Copy Project Files
Copy the `q11` folder to:
```
C:\xampp\htdocs\q11
```

### Step 3: Run Database Setup
Open your browser and go to:
```
http://localhost/q11/setup.php
```

You should see:
```
✅ Database setup completed successfully!
📝 Demo users created:
- Username: user1, Password: password123
- Username: user2, Password: password123
- Username: admin, Password: password123
```

### Step 4: Access Login Page
Navigate to:
```
http://localhost/q11/login.php
```

---

## 🧪 Testing Guide

### Test 1: Basic Login
1. Go to `http://localhost/q11/login.php`
2. Enter credentials:
   - Username: `user1`
   - Password: `password123`
3. Click **Login**
4. You should see the dashboard with:
   - Active Sessions: 1
   - Session timer counting down from 5:00

### Test 2: Concurrent Sessions (SAME USER)
**Important: Use SAME credentials in different browsers!**

1. **Browser 1 (Chrome):**
   - Login as `user1` / `password123`
   - Dashboard shows: Active Sessions = 1

2. **Browser 2 (Firefox):**
   - Login as `user1` / `password123`
   - Dashboard shows: Active Sessions = 2

3. **Browser 3 (Edge or Incognito):**
   - Login as `user1` / `password123`
   - Dashboard shows: Active Sessions = 3

4. **Browser 4 (Try 4th session):**
   - Login as `user1` / `password123`
   - Dashboard shows: Active Sessions = 3 (still!)
   - **Oldest session (Browser 1) is automatically removed**
   - Go back to Browser 1 and refresh - you'll be logged out!

### Test 3: Session Timeout (5 Minutes)
1. Login to dashboard
2. Watch the timer: "⏱️ Session expires in: 4m 59s"
3. Wait for 5 minutes (or change timeout in config.php for faster testing)
4. After 5 minutes, you'll see alert: "Session expired!"
5. Automatically redirected to login page

### Test 4: Different Users (No Limit)
**Different users don't affect each other's session limits**

1. **Browser 1:** Login as `user1`
2. **Browser 2:** Login as `user2`
3. **Browser 3:** Login as `admin`
4. Each user can have their own 3 sessions independently

---

## 🔧 Configuration

### Change Session Limit
Edit `config.php`:
```php
define('MAX_SESSIONS', 5);  // Change from 3 to 5
```

### Change Timeout Duration
Edit `config.php`:
```php
define('SESSION_TIMEOUT', 120);  // 2 minutes (for faster testing)
define('SESSION_TIMEOUT', 600);  // 10 minutes
```

---

## 📊 Understanding the Dashboard

### Statistics Cards
- **Active Sessions:** Current number of active sessions for logged-in user
- **Max Allowed:** Maximum sessions allowed (3)
- **Session Timeout:** Time before session expires (5 minutes)

### Session Table Columns
- **Session ID:** Unique identifier (truncated for display)
- **IP Address:** User's IP address
- **Browser:** User agent information
- **Last Activity:** Timestamp of last activity
- **Status:** 
  - ✅ Current (your current session - highlighted in green)
  - 🔵 Active (other sessions)

### Real-time Timer
- Counts down from 5:00 to 0:00
- Updates every second
- Shows alert when expired
- Auto-redirects to login

---

## 🗂️ Database Structure

### Database Name
`session_limit_db`

### Tables

**users table:**
```
id          INT (Primary Key)
username    VARCHAR(50) UNIQUE
password    VARCHAR(255) - hashed
created_at  TIMESTAMP
```

**user_sessions table:**
```
id              INT (Primary Key)
user_id         INT (Foreign Key → users.id)
session_id      VARCHAR(255) UNIQUE
ip_address      VARCHAR(45)
user_agent      VARCHAR(255)
last_activity   TIMESTAMP
created_at      TIMESTAMP
```

---

## 🔍 How It Works

### Session Creation Flow
```
1. User enters credentials
2. System validates username/password
3. Check active sessions count
4. If count >= 3:
   - Find oldest session
   - Delete oldest session
5. Create new session record in database
6. Store user_id in PHP session
7. Redirect to dashboard
```

### Session Validation Flow
```
1. Every page load checks session
2. Verify session exists in database
3. Check if last_activity < 5 minutes ago
4. If expired:
   - Delete from database
   - Destroy PHP session
   - Redirect to login
5. If valid:
   - Update last_activity timestamp
   - Continue to page
```

### Automatic Cleanup
```
- Runs on every login attempt
- Deletes sessions where:
  last_activity < (current_time - 5 minutes)
```

---

## 🎯 Key Features Demonstrated

### 1. Concurrent Session Limiting
- Tracks all active sessions per user
- Enforces maximum of 3 sessions
- Removes oldest when limit exceeded

### 2. Session Timeout
- 5-minute inactivity timeout
- Real-time countdown display
- Automatic expiration and cleanup

### 3. Session Tracking
- IP address logging
- Browser/device identification
- Last activity timestamp

### 4. Security Features
- Password hashing (bcrypt)
- SQL injection prevention
- Session hijacking protection
- XSS prevention

---

## 🐛 Troubleshooting

### Problem: "Connection failed"
**Solution:**
- Make sure MySQL is running in XAMPP
- Check database credentials in `config.php`
- Run `setup.php` again

### Problem: "Session not working"
**Solution:**
- Clear browser cookies
- Check PHP session is enabled
- Restart Apache in XAMPP

### Problem: "Timer not updating"
**Solution:**
- Enable JavaScript in browser
- Check browser console for errors
- Refresh the page

### Problem: "Can't login with 4th session"
**Solution:**
- This is correct behavior!
- Check Browser 1 - it should be logged out
- Only 3 sessions allowed at a time

---

## 📝 Testing Checklist

- [ ] Database setup successful
- [ ] Can login with demo credentials
- [ ] Dashboard displays correctly
- [ ] Timer counts down properly
- [ ] Can open 3 concurrent sessions
- [ ] 4th session removes oldest
- [ ] Session expires after 5 minutes
- [ ] Logout works correctly
- [ ] Different users have separate limits

---

## 💡 Tips for Demonstration

1. **Use different browsers** to show concurrent sessions clearly
2. **Change timeout to 60 seconds** in config.php for faster demo
3. **Open all browsers side-by-side** to show real-time updates
4. **Refresh Browser 1** after 4th login to show it was logged out
5. **Point out the green highlight** for current session in table

---

## 📚 Code Explanation

### SessionManager Class Methods

**createSession($userId)**
- Creates new session in database
- Checks and enforces session limit
- Removes oldest if limit exceeded

**isValidSession()**
- Validates current session
- Checks timeout
- Updates last activity

**getActiveSessions($userId)**
- Returns all active sessions for user
- Filters out expired sessions

**cleanExpiredSessions()**
- Removes sessions older than 5 minutes
- Runs automatically on login

**destroySession()**
- Removes session from database
- Destroys PHP session
- Called on logout

---

## 🎓 Learning Outcomes

After completing this lab, you understand:
- How to implement session management in PHP
- How to limit concurrent sessions per user
- How to implement session timeouts
- How to track session activity
- How to clean up expired sessions
- Database-backed session storage
- Security best practices for sessions

---

## 📄 Files Overview

| File | Purpose |
|------|---------|
| config.php | Database and session configuration |
| session_manager.php | Session management logic |
| setup.php | Database initialization |
| login.php | User authentication |
| dashboard.php | Main user interface |
| logout.php | Session termination |
| README.md | Project documentation |
| GUIDE.md | This testing guide |

---

## ✅ Submission Checklist

- [ ] All files present in q11 folder
- [ ] Database created successfully
- [ ] Can demonstrate 3 concurrent sessions
- [ ] Can demonstrate session timeout
- [ ] Code is well-commented
- [ ] README.md included
- [ ] Screenshots of testing (optional)

---

**Good luck with your lab! 🚀**
