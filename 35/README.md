# Lab 35 - Task Manager REST API

A REST API built with Express.js for managing daily tasks with full CRUD operations.

## Features
- ✅ Add new tasks
- ✅ Retrieve all tasks
- ✅ Update task status (pending/completed)
- ✅ **Auto-delete tasks when marked as completed**
- ✅ Delete tasks manually
- ✅ JSON responses
- ✅ Filter tasks by status
- ✅ In-memory storage

## Setup Instructions

1. Navigate to the project folder:
```bash
cd 35
```

2. Install dependencies:
```bash
npm install
```

3. Start the server:
```bash
npm start
```

Server will run on http://localhost:3000

## Web Interface

Open http://localhost:3000 in your browser to use the web interface.

**Features:**
- Add new tasks with title and description
- View all tasks
- Filter by status (All, Pending)
- **Mark tasks as complete (automatically removes from list)**
- Delete tasks manually
- Task counters
- Clean, minimal UI

## API Endpoints

### 1. Get All Tasks
```
GET http://localhost:3000/api/tasks
```

**Response:**
```json
{
  "success": true,
  "count": 2,
  "data": [
    {
      "id": 1,
      "title": "Complete project",
      "description": "Finish the project documentation",
      "status": "pending",
      "createdAt": "2024-01-01T10:00:00.000Z"
    }
  ]
}
```

### 2. Get Single Task
```
GET http://localhost:3000/api/tasks/1
```

### 3. Get Tasks by Status
```
GET http://localhost:3000/api/tasks/status/pending
GET http://localhost:3000/api/tasks/status/completed
```

### 4. Create New Task
```
POST http://localhost:3000/api/tasks
Content-Type: application/json

{
  "title": "Buy groceries",
  "description": "Milk, eggs, bread"
}
```

### 5. Update Task (Full Update)
```
PUT http://localhost:3000/api/tasks/1
Content-Type: application/json

{
  "title": "Updated title",
  "description": "Updated description",
  "status": "completed"
}
```

### 6. Update Task Status Only
```
PATCH http://localhost:3000/api/tasks/1/status
Content-Type: application/json

{
  "status": "completed"
}
```

### 7. Delete Task
```
DELETE http://localhost:3000/api/tasks/1
```

## Testing with Postman

### Test 1: Get All Tasks
- Method: GET
- URL: http://localhost:3000/api/tasks
- Click Send

### Test 2: Create Task
- Method: POST
- URL: http://localhost:3000/api/tasks
- Headers: Content-Type: application/json
- Body (raw JSON):
```json
{
  "title": "Learn Express.js",
  "description": "Complete Express.js tutorial"
}
```

### Test 3: Complete Task (Auto-deletes)
- Method: PATCH
- URL: http://localhost:3000/api/tasks/1/status
- Headers: Content-Type: application/json
- Body (raw JSON):
```json
{
  "status": "completed"
}
```
- **Note:** Task will be automatically deleted when marked as completed

### Test 4: Delete Task
- Method: DELETE
- URL: http://localhost:3000/api/tasks/1

### Test 5: Get Pending Tasks
- Method: GET
- URL: http://localhost:3000/api/tasks/status/pending

## Task Status Values
- `pending` - Task is not yet completed
- `completed` - Task is finished

## Response Format

**Success Response:**
```json
{
  "success": true,
  "message": "Operation message",
  "data": { ... }
}
```

**Error Response:**
```json
{
  "success": false,
  "message": "Error message"
}
```

## Technologies Used
- **Express.js** - Web framework
- **CORS** - Cross-origin resource sharing
- **In-memory storage** - Array for data storage
- **JSON** - Data format
