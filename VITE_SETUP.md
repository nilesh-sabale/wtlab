✅ Updated VITE_SETUP.md with correct commands:

React Labs (Vite):

q7, q8, 28, 29, 30, 31 → npm run dev (Port 5173)
Node.js Labs:

q10 → node server.js (Port 3000)
27, 34, 35 → npm start (Port 3000)

===============================================================
# Vite Setup Guide for React Labs

All React labs (q7, q8, q10, 28, 29, 30, 31) now use **Vite** instead of create-react-app for faster development.

## Why Vite?

- ⚡ **Faster** - Instant server start and lightning-fast HMR
- 🔥 **Modern** - Uses native ES modules
- 📦 **Smaller** - Optimized build sizes
- 🛠️ **Simple** - Minimal configuration needed

## Quick Start Guide

### For React Labs (q7, q8, 28, 29, 30, 31)

```bash
# 1. Navigate to the lab folder
cd 28  # or q7, q8, 29, 30, 31

# 2. Install dependencies
npm install

# 3. Start development server
npm run dev

# Opens on http://localhost:5173
```

### For Node.js Labs (q10, 27, 34, 35)

```bash
# 1. Navigate to the lab folder
cd 27  # or q10, 34, 35

# 2. Install dependencies
npm install

# 3. Start server
npm start  # For labs 27, 34, 35
# OR
node server.js  # For lab q10

# Opens on http://localhost:3000
```

### Build for Production (React labs only)
```bash
npm run build
```
Output will be in the `dist` folder.

## What Changed from create-react-app?

### File Structure Changes:
- ✅ `index.html` moved to **root** (not in public/)
- ✅ `src/index.js` renamed to **src/main.jsx**
- ✅ Added `vite.config.js` in root
- ✅ Updated `package.json` with Vite scripts

### Port Change:
- ❌ Old: http://localhost:3000 (create-react-app)
- ✅ New: http://localhost:5173 (Vite)

### Commands:
| Task | Old (CRA) | New (Vite) |
|------|-----------|------------|
| Dev server | `npm start` | `npm run dev` |
| Build | `npm run build` | `npm run build` |
| Preview build | N/A | `npm run preview` |

## React Labs Using Vite (npm run dev)

### Labs 28-31 (New Labs)
- **Lab 28** - Theme Toggle App → `npm run dev` (Port 5173)
- **Lab 29** - Digital Clock App → `npm run dev` (Port 5173)
- **Lab 30** - Product Filter App (React + Redux) → `npm run dev` (Port 5173)
- **Lab 31** - Notification System (React + Redux) → `npm run dev` (Port 5173)

### Previous Labs (q7, q8)
- **q7** - Student Management (React + PHP backend) → `npm run dev` (Port 5173)
- **q8** - Student Feedback Form → `npm run dev` (Port 5173)

## Node.js/Express Labs (npm start)

These labs don't use Vite (they're backend APIs):
- **q10** - Student CRUD (Node.js + MongoDB) → `node server.js` (Port 3000)
- **Lab 27** - Library Management (Node.js + MongoDB) → `npm start` (Port 3000)
- **Lab 34** - Blog API (Express.js) → `npm start` (Port 3000)
- **Lab 35** - Task Manager API (Express.js) → `npm start` (Port 3000)

## Troubleshooting

### Issue: Port 5173 already in use
```bash
# Kill the process or change port in vite.config.js:
export default defineConfig({
  plugins: [react()],
  server: { port: 3000 }
})
```

### Issue: Module not found
```bash
# Delete node_modules and reinstall
rm -rf node_modules package-lock.json
npm install
```

### Issue: Old build files
```bash
# Clean and rebuild
rm -rf dist
npm run build
```

## Package.json Structure

All React labs now have this structure:

```json
{
  "name": "lab-name",
  "version": "1.0.0",
  "type": "module",
  "scripts": {
    "dev": "vite",
    "build": "vite build",
    "preview": "vite preview"
  },
  "dependencies": {
    "react": "^18.2.0",
    "react-dom": "^18.2.0"
  },
  "devDependencies": {
    "@vitejs/plugin-react": "^4.2.1",
    "vite": "^5.0.8"
  }
}
```

## Summary

### React Labs (Vite)
✅ **Labs:** q7, q8, 28, 29, 30, 31
✅ **Command:** `npm run dev`
✅ **Port:** 5173
✅ Faster development with Vite

### Node.js Labs
✅ **Labs:** q10, 27, 34, 35
✅ **Command:** `npm start` (or `node server.js` for q10)
✅ **Port:** 3000
✅ Backend APIs with Express/Node.js
