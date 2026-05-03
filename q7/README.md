# Lab 7 - VIT Student Result System (React + PHP + MySQL)

## Features Implemented:

✅ **Task 1: Multiple Components**
- App.jsx (Parent Component)
- Student.jsx (Child Component)
- Result.jsx (Child Component)

✅ **Task 2: Props (Parent to Child)**
- App passes: Student Name, Course, Marks to Student component
- Student passes: Marks data to Result component

✅ **Task 3: useState() for State Management**
- Manages marks for 4 subjects (MSE 30% + ESE 70%)
- Dynamic calculation of total and percentage
- **Editable marks with real-time updates**

✅ **Task 4: Dynamic UI Updates**
- Pass/Fail status updates automatically when marks change
- Passing criteria: 40% in each subject + 50% overall
- **Save updated marks to database**

## New Features:

🎯 **Editable Marks**
- Click on MSE/ESE marks to edit
- Pass/Fail status updates instantly
- Total recalculates automatically

💾 **Save to Database**
- Click "Save Marks to Database" button
- Updates MySQL database
- Shows success/error message

## Project Structure:

```
q7/
├── backend/
│   ├── db.php          # Database connection
│   ├── api.php         # API to fetch student data
│   └── setup.php       # Database setup
├── src/
│   ├── App.jsx         # Parent Component
│   ├── Student.jsx     # Child Component
│   ├── Result.jsx      # Child Component
│   └── App.css         # Styling
├── public/
│   └── index.html
├── package.json
└── README.md
```

## How to Run:

### Step 1: Setup Backend (PHP + MySQL)

1. Copy `q7` folder to `C:\xampp\htdocs\`
2. Start XAMPP (Apache + MySQL)
3. Open browser: `http://localhost/q7/backend/setup.php`
4. This creates database and sample student data

### Step 2: Setup React Frontend

1. Open terminal in `q7` folder
2. Install dependencies:
   ```bash
   npm install
   ```
3. Start React app:
   ```bash
   npm start
   ```
4. App opens at: `http://localhost:3000`

## Database Structure:

```sql
CREATE TABLE students (
    id INT PRIMARY KEY,
    name VARCHAR(100),
    course VARCHAR(50),
    subject1_mse INT,
    subject1_ese INT,
    subject2_mse INT,
    subject2_ese INT,
    subject3_mse INT,
    subject3_ese INT,
    subject4_mse INT,
    subject4_ese INT
);
```

## Subjects:

1. Web Technology (MSE: 30, ESE: 70)
2. Data Structures (MSE: 30, ESE: 70)
3. Database Management (MSE: 30, ESE: 70)
4. Operating Systems (MSE: 30, ESE: 70)

## Passing Criteria:

- Minimum 40% in each subject
- Minimum 50% overall percentage
- Status: PASS or FAIL

## Technologies Used:

- **Frontend:** React.js (useState, Props)
- **Backend:** PHP
- **Database:** MySQL
- **Styling:** CSS

## Quick Test:

After setup, you'll see sample student data with:
- Student Name
- Course
- 4 Subjects with marks
- Total marks and percentage
- Pass/Fail status (updates dynamically)
