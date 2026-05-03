# Lab 4 - PHP Form Processing, Sessions & Cookies

## All Tasks Completed:

### ✅ Task 1: HTML Form with Name, Email, Password
**File:** `index.php`
- Form has 3 input fields: Name, Email, Password
- Two forms: one using POST, one using GET

### ✅ Task 2: Process form using GET and POST methods
**File:** `process.php` (Lines 4-7)
```php
$name = isset($_POST['name']) ? $_POST['name'] : $_GET['name'];
```
- POST method: Data hidden (secure)
- GET method: Data visible in URL (for demo)

### ✅ Task 3: Validate email format
**File:** `process.php` (Lines 10-18)
```php
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Show error
}
```
- Uses PHP's `filter_var()` function
- Test with invalid email like "test" or "test@" to see validation

### ✅ Task 4: Create cookie to store username
**File:** `process.php` (Line 30)
```php
setcookie('username', $name, time() + (86400 * 30), "/");
```
- Cookie stores username for 30 days
- Check "Remember Me" to enable
- Cookie is read on next visit (see index.php line 10)

### ✅ Task 5: Session-based login
**What it means:** User data stored on server, protected pages check if logged in

**Implementation:**
1. **Create Session** (process.php lines 23-26): Store user data
2. **Protect Pages** (dashboard.php lines 4-7): Check if session exists
3. **Logout** (logout.php): Destroy session

**How to test session-based login:**

**Test 1 - Access without login:**
1. Open browser: `http://localhost/LAB2/q4/dashboard.php`
2. Result: Redirected to login page
3. Why? No session exists, so access denied

**Test 2 - Login and access:**
1. Go to: `http://localhost/LAB2/q4/index.php`
2. Login with any name, valid email, password
3. Now try: `http://localhost/LAB2/q4/dashboard.php`
4. Result: Dashboard accessible!
5. Why? Session exists with your login data

**Test 3 - Logout and try again:**
1. Click "Logout" button on dashboard
2. Try accessing dashboard again
3. Result: Redirected to login
4. Why? Session was destroyed

**Visual Demo:**
- Both POST and GET methods now support "Remember Me" cookie option

## Files:

- `index.php` - Login form (GET & POST)
- `process.php` - Form processing & validation
- `dashboard.php` - Protected page (session-based)
- `logout.php` - Session & cookie cleanup
- `README.md` - This file

## How to Run:

1. Install XAMPP/WAMP
2. Copy `q4` folder to `htdocs`
3. Start Apache
4. Open: `http://localhost/LAB2/q4/index.php`

## Quick Demo Steps:

1. Try opening `dashboard.php` directly → You'll be blocked
2. Login via `index.php` (use POST or GET method) → Session created
3. Check "Remember Me" to save cookie
4. Now `dashboard.php` works → Session verified
5. Logout → Session destroyed → Can't access dashboard again
