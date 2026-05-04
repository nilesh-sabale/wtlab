# Vite Setup Guide for React Labs

All React labs (q7, q8, q10, 28, 29, 30, 31) now use **Vite** instead of create-react-app for faster development.

## Why Vite?

- ⚡ **Faster** - Instant server start and lightning-fast HMR
- 🔥 **Modern** - Uses native ES modules
- 📦 **Smaller** - Optimized build sizes
- 🛠️ **Simple** - Minimal configuration needed

## Quick Start for Any React Lab

### 1. Navigate to the lab folder
```bash
cd 28  # or any React lab: q7, q8, q10, 28, 29, 30, 31
```

### 2. Install dependencies
```bash
npm install
```

### 3. Start development server
```bash
npm run dev
```

The app will run on **http://localhost:5173** (Vite's default port)

### 4. Build for production
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

## React Labs Using Vite

### Labs 28-31 (New Labs)
- **Lab 28** - Theme Toggle App
- **Lab 29** - Digital Clock App
- **Lab 30** - Product Filter App (React + Redux)
- **Lab 31** - Notification System (React + Redux)

### Previous Labs (q7, q8, q10)
- **q7** - Student Management (React + PHP backend)
- **q8** - Student Feedback Form
- **q10** - Student CRUD (React + Node.js + MongoDB)

## Node.js/Express Labs (No Changes)

These labs don't use Vite (they're backend APIs):
- **Lab 27** - Library Management (Node.js + MongoDB)
- **Lab 34** - Blog API (Express.js)
- **Lab 35** - Task Manager API (Express.js)

Run these with: `npm start` on port 3000

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

✅ All React labs converted to Vite
✅ Faster development experience
✅ Same React code, just different build tool
✅ Run with `npm run dev` instead of `npm start`
✅ Opens on port 5173 instead of 3000
