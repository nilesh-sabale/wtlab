# Lab 30 - Product Filter App

A React application that allows users to filter products by category or price range using Redux to manage filter state.

## Features
- Product data stored in Redux state
- Filter by category (Electronics, Clothing, Accessories)
- Filter by price range
- Actions for filtering products
- Reducer for filter logic
- Display filtered products dynamically
- Reset filters functionality

## Setup with Vite

1. Navigate to the lab folder:
```bash
cd 30
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

## Technologies Used
- **React 18** - UI library
- **Redux** - State management (stores product data and filters)
- **React-Redux** - Connects Redux store to React components
- **Vite** - Fast build tool and dev server
- **Redux Store** - Centralized state container
- **Actions** - Define filter operations
- **Reducer** - Handles filter logic

## How It Works
1. Products are stored in Redux initial state
2. User selects category or price range
3. Actions are dispatched to Redux
4. Reducer processes the filter logic
5. Components re-render with filtered products
6. Reset button clears all filters
