# Setup Guide - Running on Another PC

This guide will help you clone and run this repository on a new computer.

## 📋 Prerequisites

Before you start, install these on your new PC:

### 1. Node.js and npm
- Download from: https://nodejs.org/
- Recommended: LTS version (v18 or higher)
- Verify installation:
```bash
node --version
npm --version
```

### 2. MongoDB (Only for Labs 27 and q10)
- Download from: https://www.mongodb.com/try/download/community
- Install MongoDB Community Edition
- Start MongoDB service:

**Windows:**
```bash
# MongoDB should start automatically as a service
# Or manually start:
net start MongoDB
```

**Mac:**
```bash
brew services start mongodb-community
```

**Linux:**
```bash
sudo systemctl start mongod
```

### 3. Git
- Download from: https://git-scm.com/
- Verify installation:
```bash
git --version
```

### 4. Code Editor (Optional but recommended)
- VS Code: https://code.visualstudio.com/

## 🚀 Step-by-Step Setup

### Step 1: Clone the Repository

```bash
# Clone the repository
git clone https://github.com/user-asdfghjkl/asdf.git

# Navigate into the folder
cd asdf
```

### Step 2: Choose Which Lab to Run

You have two types of labs:

#### **React Labs** (Use Vite - Port 5173)
- q7, q8, 28, 29, 30, 31

#### **Node.js/Express Labs** (Port 3000)
- q10, 27, 34, 35

### Step 3: Install Dependencies for Your Lab

Navigate to the specific lab folder and install:

```bash
# Example: Running Lab 28 (React)
cd 28
npm install

# This will download all dependencies from package.json
# Wait for installation to complete (may take 1-2 minutes)
```

### Step 4: Run the Lab

#### For React Labs (q7, q8, 28, 29, 30, 31):
```bash
npm run dev
```
- Opens on: **http://localhost:5173**
- Browser should open automatically
- If not, manually open the URL

#### For Node.js Labs (q10, 27, 34, 35):
```bash
npm start
```
- Opens on: **http://localhost:3000**
- Open browser manually to the URL

### Step 5: For MongoDB Labs (27, q10)

**Before running these labs:**

1. Make sure MongoDB is running:
```bash
# Windows
net start MongoDB

# Mac
brew services start mongodb-community

# Linux
sudo systemctl start mongod
```

2. Verify MongoDB is running:
```bash
# Should connect without errors
mongosh
# or
mongo
```

3. Then run the lab:
```bash
cd 27  # or q10
npm install
npm start
```

## 📝 Complete Example Walkthrough

### Example 1: Running Lab 28 (Theme Toggle - React)

```bash
# 1. Clone repo
git clone https://github.com/user-asdfghjkl/asdf.git
cd asdf

# 2. Go to lab 28
cd 28

# 3. Install dependencies
npm install

# 4. Run the app
npm run dev

# 5. Open browser to http://localhost:5173
```

### Example 2: Running Lab 27 (Library - Node.js + MongoDB)

```bash
# 1. Clone repo
git clone https://github.com/user-asdfghjkl/asdf.git
cd asdf

# 2. Start MongoDB first
net start MongoDB  # Windows
# or
brew services start mongodb-community  # Mac

# 3. Go to lab 27
cd 27

# 4. Install dependencies
npm install

# 5. Run the server
npm start

# 6. Open browser to http://localhost:3000
```

### Example 3: Running Lab 34 (Blog API - Express)

```bash
# 1. Clone repo
git clone https://github.com/user-asdfghjkl/asdf.git
cd asdf

# 2. Go to lab 34
cd 34

# 3. Install dependencies
npm install

# 4. Run the server
npm start

# 5. Open browser to http://localhost:3000
```

## 🔧 Troubleshooting

### Issue 1: "npm: command not found"
**Solution:** Node.js is not installed or not in PATH
- Reinstall Node.js from https://nodejs.org/
- Restart terminal/command prompt

### Issue 2: "Port 5173 already in use" (React labs)
**Solution:** Another app is using the port
```bash
# Kill the process or change port in vite.config.js
# Or just close other apps using that port
```

### Issue 3: "Port 3000 already in use" (Node.js labs)
**Solution:** Another app is using the port
```bash
# Windows - Find and kill process
netstat -ano | findstr :3000
taskkill /PID <PID_NUMBER> /F

# Mac/Linux
lsof -ti:3000 | xargs kill -9
```

### Issue 4: "MongoDB connection failed"
**Solution:** MongoDB is not running
```bash
# Start MongoDB service
net start MongoDB  # Windows
brew services start mongodb-community  # Mac
sudo systemctl start mongod  # Linux
```

### Issue 5: "Module not found" errors
**Solution:** Dependencies not installed
```bash
# Delete node_modules and reinstall
rm -rf node_modules package-lock.json  # Mac/Linux
# or
rmdir /s node_modules  # Windows
del package-lock.json  # Windows

# Then reinstall
npm install
```

### Issue 6: React app shows blank page
**Solution:** Check browser console for errors
- Press F12 to open developer tools
- Check Console tab for errors
- Make sure you're using `npm run dev` not `npm start`

## 📊 Quick Reference Table

| Lab | Type | Command | Port | Requires MongoDB? |
|-----|------|---------|------|-------------------|
| q7 | React | `npm run dev` | 5173 | No (uses PHP) |
| q8 | React | `npm run dev` | 5173 | No |
| q10 | Node.js | `npm start` | 3000 | Yes |
| 27 | Node.js | `npm start` | 3000 | Yes |
| 28 | React | `npm run dev` | 5173 | No |
| 29 | React | `npm run dev` | 5173 | No |
| 30 | React | `npm run dev` | 5173 | No |
| 31 | React | `npm run dev` | 5173 | No |
| 34 | Node.js | `npm start` | 3000 | No |
| 35 | Node.js | `npm start` | 3000 | No |

## 🎯 Summary

**For React Labs:**
1. Clone repo
2. `cd <lab-folder>`
3. `npm install`
4. `npm run dev`
5. Open http://localhost:5173

**For Node.js Labs:**
1. Clone repo
2. Start MongoDB (if needed)
3. `cd <lab-folder>`
4. `npm install`
5. `npm start`
6. Open http://localhost:3000

## 💡 Tips

- Always run `npm install` first in each lab folder
- Each lab is independent - install dependencies separately
- Don't copy node_modules between labs
- If something doesn't work, try deleting node_modules and running `npm install` again
- Check the lab's README.md for specific instructions

## 📞 Need Help?

1. Check the lab's specific README.md file
2. Check VITE_SETUP.md for React/Vite issues
3. Verify all prerequisites are installed
4. Make sure you're in the correct lab folder
5. Ensure MongoDB is running (for labs 27 and q10)

---

**Happy Coding! 🚀**
