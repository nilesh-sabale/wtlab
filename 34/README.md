use => https://hoppscotch.io/ for API TEST!!!
# Lab 34 - Blog Management REST API

A REST API built with Express.js for managing blog posts with full CRUD operations.

## Features
- ✅ Express server setup
- ✅ Create blog posts (POST)
- ✅ Read all blog posts (GET)
- ✅ Read single blog post (GET)
- ✅ Update blog posts (PUT)
- ✅ Delete blog posts (DELETE)
- ✅ In-memory data storage
- ✅ JSON responses
- ✅ Error handling

## Setup Instructions

1. Navigate to the project folder:
```bash
cd 34
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
- Create new blog posts
- View all blog posts
- Edit existing posts
- Delete posts
- Clean, minimal UI

## API Endpoints

### 1. Get All Blog Posts
```
GET http://localhost:3000/api/blogs
```

### 2. Get Single Blog Post
```
GET http://localhost:3000/api/blogs/1
```

### 3. Create New Blog Post
```
POST http://localhost:3000/api/blogs
Content-Type: application/json

{
  "title": "My Blog Title",
  "content": "Blog content here...",
  "author": "Author Name"
}
```

### 4. Update Blog Post
```
PUT http://localhost:3000/api/blogs/1
Content-Type: application/json

{
  "title": "Updated Title",
  "content": "Updated content...",
  "author": "Updated Author"
}
```

### 5. Delete Blog Post
```
DELETE http://localhost:3000/api/blogs/1
```

## Testing with Postman

1. **Install Postman** from https://www.postman.com/downloads/

2. **Test GET all blogs:**
   - Method: GET
   - URL: http://localhost:3000/api/blogs
   - Click Send

3. **Test POST create blog:**
   - Method: POST
   - URL: http://localhost:3000/api/blogs
   - Headers: Content-Type: application/json
   - Body (raw JSON):
   ```json
   {
     "title": "Test Blog",
     "content": "This is a test blog post",
     "author": "Test User"
   }
   ```
   - Click Send

4. **Test PUT update blog:**
   - Method: PUT
   - URL: http://localhost:3000/api/blogs/1
   - Headers: Content-Type: application/json
   - Body (raw JSON):
   ```json
   {
     "title": "Updated Blog Title"
   }
   ```
   - Click Send

5. **Test DELETE blog:**
   - Method: DELETE
   - URL: http://localhost:3000/api/blogs/1
   - Click Send

## Response Format

All responses follow this format:

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
- **In-memory storage** - Simple array for data storage
- **JSON** - Data format for requests and responses