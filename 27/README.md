# Lab 27 - Library Management System

A Node.js application for managing library book records with MongoDB.

## Features
- Add books with book_id, title, author, and year
- View all books in the library
- RESTful API with Express
- MongoDB database storage

## Setup

1. Install dependencies:
```bash
cd 27
npm install
```

2. Make sure MongoDB is running on localhost:27017

3. Start the server:
```bash
npm start
```

4. Open browser at http://localhost:3000

## API Endpoints
- POST /api/books - Add a new book
- GET /api/books - Get all books
