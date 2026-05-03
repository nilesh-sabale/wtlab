# Student Feedback Form - React Application

A React-based student feedback form with validation, controlled components, useRef, and dynamic feedback display.

## Features Implemented

✅ **Feedback Form with Validation**
- Student name validation (required)
- Subject selection validation (required)
- Rating validation (required, 1-5 stars)
- Feedback text validation (required, minimum 10 characters)

✅ **Controlled Components (useState)**
- All form inputs are controlled using useState
- Real-time state management for form data
- Error state management

✅ **useRef() for DOM Access**
- Used to focus the feedback textarea after form submission
- Direct DOM manipulation when needed

✅ **List Rendering with Keys**
- Each feedback item uses unique key (timestamp-based ID)
- Proper React list rendering practices

✅ **Display Submitted Feedback**
- Shows all submitted feedbacks in cards
- Displays student name, subject, rating, feedback text, and timestamp
- Delete functionality for each feedback

## Subjects Available

1. **DT** - Design Thinking
2. **EDI** - Entrepreneurship Development & IPR
3. **DAA** - Design & Analysis of Algorithms
4. **SDAM** - Software Design & Architecture Modeling
5. **WT** - Web Technology
6. **SPECIAL** - Extra/Special/Guest Session

## How to Run

### Prerequisites
- Node.js (v14 or higher)
- npm (comes with Node.js)

### Installation & Running

1. **Navigate to the q8 folder:**
   ```bash
   cd q8
   ```

2. **Install dependencies:**
   ```bash
   npm install
   ```

3. **Start the development server:**
   ```bash
   npm start
   ```

4. **Open in browser:**
   - The app will automatically open at `http://localhost:3000`
   - If it doesn't open automatically, manually navigate to `http://localhost:3000`

### Building for Production

To create an optimized production build:
```bash
npm run build
```

## Project Structure

```
q8/
├── public/
│   └── index.html          # HTML template
├── src/
│   ├── App.js              # Main component with all logic
│   ├── App.css             # Styling
│   └── index.js            # React entry point
├── package.json            # Dependencies and scripts
└── README.md              # This file
```

## Usage

1. Fill in your name
2. Select a subject from the dropdown
3. Choose a rating (1-5 stars)
4. Write your feedback (minimum 10 characters)
5. Click "Submit Feedback"
6. View all submitted feedbacks below the form
7. Delete any feedback using the delete button

## Technologies Used

- React 18
- React Hooks (useState, useRef)
- CSS3 with Gradient Backgrounds
- Responsive Design

## Notes

- All form validations are real-time
- Feedbacks are stored in component state (will reset on page refresh)
- Each feedback has a unique ID based on timestamp
- Fully responsive design for mobile and desktop
