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

## Setup with Vite

1. Navigate to the lab folder:
```bash
cd 31
```

2. Install dependencies:
```bash
npm install
```

This will install:
- react & react-dom (v18.2.0)
- redux (v4.2.1) - State management
- react-redux (v8.0.5) - Redux bindings for React
- vite (v5.0.8) - Fast build tool

3. Start the development server:
```bash
npm run dev
```

4. Open browser at the URL shown (usually http://localhost:5173)

## Build for Production

```bash
npm run build
```

The build output will be in the `dist` folder.

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
- **Vite** - Fast build tool and dev server
- **Redux Actions** - ADD_NOTIFICATION, REMOVE_NOTIFICATION
- **Redux Reducer** - Manages notification array
