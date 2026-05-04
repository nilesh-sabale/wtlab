# LAB2 - Web Development Labs

This repository contains multiple lab assignments covering various web development topics including React, Node.js, Express.js, Redux, and REST APIs.

## 📁 Repository Structure

### React Labs (Using Vite ⚡)
- **q7** - Student Management System (React + PHP backend)
- **q8** - Student Feedback Form (React)
- **Lab 28** - Theme Toggle App (React Hooks)
- **Lab 29** - Digital Clock App (React Hooks)
- **Lab 30** - Product Filter App (React + Redux)
- **Lab 31** - Notification System (React + Redux)

### Node.js/Express Labs
- **q10** - Student CRUD (Node.js + MongoDB)
- **Lab 27** - Library Management System (Node.js + MongoDB + Web UI)
- **Lab 34** - Blog Management REST API (Express.js + Web UI)
- **Lab 35** - Task Manager REST API (Express.js + Web UI)

### Previous Labs (q1-q25)
Various web development exercises and assignments.

## 🚀 Quick Start

### For React Labs (q7, q8, 28, 29, 30, 31)

```bash
# Navigate to any React lab
cd 28  # or q7, q8, 29, 30, 31

# Install dependencies
npm install

# Start development server (Vite)
npm run dev

# Opens on http://localhost:5173
```

### For Node.js/Express Labs (q10, 27, 34, 35)

```bash
# Navigate to any Node.js lab
cd 27  # or q10, 34, 35

# Install dependencies
npm install

# Start server
npm start

# Opens on http://localhost:3000
```

## 📚 Lab Details

### React Labs (Vite)

#### q7 - Student Management System
- **Tech**: React (Vite), PHP backend
- **Port**: http://localhost:5173
- **Command**: `npm run dev`

#### q8 - Student Feedback Form
- **Tech**: React (Vite)
- **Port**: http://localhost:5173
- **Command**: `npm run dev`

#### Lab 28 - Theme Toggle App
- **Tech**: React, React Hooks (useState)
- **Features**: Light/Dark mode toggle
- **Port**: http://localhost:5173
- **Command**: `npm run dev`

#### Lab 29 - Digital Clock App
- **Tech**: React, React Hooks (useState, useEffect)
- **Features**: Real-time clock, start/stop functionality
- **Port**: http://localhost:5173
- **Command**: `npm run dev`

#### Lab 30 - Product Filter App
- **Tech**: React, Redux, React-Redux
- **Features**: Filter products by category and price
- **Port**: http://localhost:5173
- **Command**: `npm run dev`

#### Lab 31 - Notification System
- **Tech**: React, Redux, React-Redux
- **Features**: Add/remove notifications, multiple types
- **Port**: http://localhost:5173
- **Command**: `npm run dev`

### Node.js/Express Labs

#### q10 - Student CRUD
- **Tech**: Node.js, Express, MongoDB
- **Port**: http://localhost:3000
- **Command**: `npm start`
- **Note**: Requires MongoDB running

#### Lab 27 - Library Management System
- **Tech**: Node.js, Express, MongoDB
- **Features**: Add books, view books, edit, delete + Web UI
- **Port**: http://localhost:3000
- **Command**: `npm start`
- **Note**: Requires MongoDB running

#### Lab 34 - Blog Management API
- **Tech**: Express.js, REST API
- **Features**: CRUD operations for blog posts + Web UI
- **Port**: http://localhost:3000
- **Command**: `npm start`
- **Endpoints**: GET, POST, PUT, DELETE /api/blogs

#### Lab 35 - Task Manager API
- **Tech**: Express.js, REST API
- **Features**: Task management with auto-delete on completion + Web UI
- **Port**: http://localhost:3000
- **Command**: `npm start`
- **Endpoints**: GET, POST, PUT, PATCH, DELETE /api/tasks

## 🔧 Technologies Used

### Frontend
- **React 18** - UI library
- **Vite** - Fast build tool and dev server (for React labs)
- **Redux** - State management (Labs 30, 31)
- **React-Redux** - Redux bindings
- **HTML/CSS/JavaScript** - Core web technologies

### Backend
- **Node.js** - JavaScript runtime
- **Express.js** - Web framework
- **MongoDB** - Database (Labs 27, q10)
- **Mongoose** - MongoDB ODM

## ⚡ Why Vite?

All React labs now use **Vite** instead of create-react-app:

- ⚡ **Faster** - Instant server start and lightning-fast HMR
- 🔥 **Modern** - Uses native ES modules
- 📦 **Smaller** - Optimized build sizes
- 🛠️ **Simple** - Minimal configuration

### Key Differences from create-react-app:

| Aspect | create-react-app | Vite |
|--------|------------------|------|
| Dev command | `npm start` | `npm run dev` |
| Port | 3000 | 5173 |
| Entry file | `src/index.js` | `src/main.jsx` |
| HTML location | `public/` | root `/` |
| Speed | Slower | Much faster ⚡ |

## 📝 Important Notes

- **React labs** run on port **5173** with `npm run dev`
- **Node.js labs** run on port **3000** with `npm start`
- Each lab has its own `README.md` with detailed instructions
- `node_modules` folders are not included - run `npm install` in each lab
- Labs 27 and q10 require MongoDB to be running locally
- See `VITE_SETUP.md` for detailed Vite setup guide

## 🚫 .gitignore

The repository includes a `.gitignore` file that excludes:
- `node_modules/` - All dependency folders
- `build/` and `dist/` - Build outputs
- `.env` - Environment variables
- Log files and OS-specific files

## 📖 Additional Documentation

- **VITE_SETUP.md** - Comprehensive Vite setup guide
- Each lab folder contains its own README with specific instructions

## 🤝 Setup Instructions

### Quick Setup:
1. Clone the repository
2. Navigate to desired lab folder
3. Run `npm install`
4. For React labs: Run `npm run dev`
5. For Node.js labs: Run `npm start`
6. For MongoDB labs: Ensure MongoDB is running first

### 📖 Detailed Setup Guide for New PC:
**See [SETUP_ON_NEW_PC.md](SETUP_ON_NEW_PC.md) for complete step-by-step instructions including:**
- Prerequisites installation (Node.js, MongoDB, Git)
- Cloning the repository
- Running each lab type
- Troubleshooting common issues
- Complete examples for each lab

## 📄 License

Educational purposes only.
