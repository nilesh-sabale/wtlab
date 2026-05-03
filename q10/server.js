const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");
const connectDB = require("./config/db");
const Student = require("./models/Student");

const app = express();

const path = require("path");

app.use(express.static(path.join(__dirname, "public")));

// Middleware
app.use(bodyParser.json());
app.use(cors());

// Connect DB
connectDB();

// Insert Student (POST API)
app.post("/students", async (req, res) => {
  try {
    const { name, email, course } = req.body;

    const student = new Student({ name, email, course });
    await student.save();

    res.status(201).json({ message: "Student Registered Successfully", student });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Update Student
app.put("/students/:id", async (req, res) => {
  try {
    const updated = await Student.findByIdAndUpdate(
      req.params.id,
      req.body,
      { new: true }
    );
    res.json(updated);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Delete Student
app.delete("/students/:id", async (req, res) => {
  try {
    await Student.findByIdAndDelete(req.params.id);
    res.json({ message: "Deleted successfully" });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

//Get All Students (GET API)
app.get("/students", async (req, res) => {
  try {
    const students = await Student.find();
    res.json(students);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Server Start
const PORT = 5000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));


// # Navigate to project
// cd q10

// # Install dependencies
// npm install

// # Run the server
// node server.js

// http://localhost:5000 OUTPUT

/*

# Student Registration System

A full-stack web application for managing student registrations with CRUD operations.

## 🚀 Technologies Used

### Backend
- **Node.js** - JavaScript runtime environment
- **Express.js** - Web application framework
- **MongoDB** - NoSQL database for data storage
- **Mongoose** - MongoDB object modeling tool
- **Body-Parser** - Parse incoming request bodies
- **CORS** - Enable Cross-Origin Resource Sharing
- **UUID** - Generate unique student IDs

### Frontend
- **HTML5** - Structure and markup
- **CSS3** - Styling with gradients and animations
- **JavaScript (Vanilla)** - Client-side logic and DOM manipulation
- **Fetch API** - HTTP requests to backend

### Development Tools
- **Nodemon** - Auto-restart server on file changes

## 📋 Features Implemented

✅ **Create** - Register new students with name, email, and course
✅ **Read** - Display all registered students in a table
✅ **Update** - Edit existing student information
✅ **Delete** - Remove students from the database
✅ **Unique ID Generation** - Auto-generate unique student IDs using UUID
✅ **Responsive Design** - Clean UI with gradient backgrounds
✅ **Form Validation** - Required fields validation
✅ **Hover Effects** - Interactive table rows and buttons
✅ **Real-time Updates** - Instant feedback on actions

## 🗂️ Project Structure

```
q10/
├── config/
│   └── db.js              # MongoDB connection configuration
├── models/
│   └── Student.js         # Mongoose schema for Student
├── public/
│   └── index.html         # Frontend UI
├── node_modules/          # Dependencies
├── package.json           # Project metadata and dependencies
├── server.js              # Express server and API routes
└── README.md             # This file
```

## 🛠️ API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/students` | Get all students |
| POST | `/students` | Register new student |
| PUT | `/students/:id` | Update student by ID |
| DELETE | `/students/:id` | Delete student by ID |

## 📦 Installation & Setup

### Prerequisites
- Node.js (v14 or higher)
- MongoDB (local or Atlas)

### Step 1: Install Dependencies
```bash
cd q10
npm install
```

### Step 2: Configure Database
Update `config/db.js` with your MongoDB connection string if needed.

### Step 3: Start MongoDB
Make sure MongoDB is running on your system.

### Step 4: Run the Application
```bash
node server.js
```

Or with auto-restart:
```bash
npx nodemon server.js
```

### Step 5: Access the Application
Open your browser and navigate to:
```
http://localhost:3000
```

## 🔧 Configuration

**Default Port:** 3000  
**Database:** MongoDB (localhost:27017)  
**Database Name:** studentDB

To change the port, modify `server.js`:
```javascript
const PORT = process.env.PORT || 3000;
```

## 📱 Usage

1. **Register Student:** Fill in the form and click "Register"
2. **View Students:** All registered students appear in the table
3. **Edit Student:** Click the ✏️ Edit button, modify details, and submit
4. **Delete Student:** Click the 🗑️ Delete button and confirm

## 🌐 Setup on Another PC

1. Install Node.js from https://nodejs.org/
2. Install MongoDB from https://www.mongodb.com/try/download/community
3. Copy the project folder
4. Run `npm install` in the project directory
5. Start MongoDB service
6. Run `node server.js`
7. Open http://localhost:3000

## 🔒 Database Schema

```javascript
{
  studentId: String (UUID),
  name: String (required),
  email: String (required),
  course: String (required),
  createdAt: Date (auto-generated)
}
```

## 🎨 UI Features

- Gradient purple background
- White card-based design
- Smooth hover animations
- Responsive table layout
- Color-coded action buttons (Green for Edit, Red for Delete)
- Clean typography using Poppins font

## 📝 Notes

- Student IDs are auto-generated using UUID v4
- All fields are required for registration
- Email validation is performed on the frontend
- Delete action requires confirmation
- Edit mode scrolls to the form automatically

## 🐛 Troubleshooting

**MongoDB Connection Error:**
- Ensure MongoDB is running
- Check connection string in `config/db.js`

**Port Already in Use:**
- Change port in `server.js`
- Or kill the process using port 3000

**Dependencies Error:**
- Delete `node_modules` folder
- Run `npm install` again

## 📄 License

This project is open source and available for educational purposes.


*/