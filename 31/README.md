# Lab 31 - Notification System

A React application that displays system notifications using Redux to manage notification state.

## Features
- Redux store for notifications
- Add Notification action
- Remove Notification action
- Reducer to update notification state
- Display notifications in UI
- Dismiss notifications
- Multiple notification types (Info, Success, Warning, Error)
- Timestamps for each notification

## Setup Instructions

1. Navigate to the project folder:
```bash
cd 31
```

2. Install all dependencies:
```bash
npm install
```

This will install:
- react & react-dom (v18.2.0)
- redux (v4.2.1) - State management
- react-redux (v8.0.5) - Redux bindings for React
- react-scripts (v5.0.1) - Build tools

3. Start the development server:
```bash
npm start
```

4. Open browser at http://localhost:3000

## How It Works
1. User enters notification message and selects type
2. Click "Add Notification" dispatches action to Redux
3. Reducer adds notification to state array
4. Component displays all notifications from Redux state
5. Click ✕ button dispatches remove action
6. Reducer filters out the notification from state

## Technologies Used
- **React 18** - UI library
- **Redux** - State management
- **React-Redux** - Redux bindings
- **Redux Actions** - ADD_NOTIFICATION, REMOVE_NOTIFICATION
- **Redux Reducer** - Manages notification array
