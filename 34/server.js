const express = require('express');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(express.json());
app.use(express.static('public'));

// In-memory storage for blog posts
let blogs = [
  {
    id: 1,
    title: 'Getting Started with Node.js',
    content: 'Node.js is a powerful JavaScript runtime...',
    author: 'John Doe',
    createdAt: new Date().toISOString()
  },
  {
    id: 2,
    title: 'Understanding REST APIs',
    content: 'REST APIs are a standard way to build web services...',
    author: 'Jane Smith',
    createdAt: new Date().toISOString()
  }
];

let nextId = 3;

// GET all blog posts
app.get('/api/blogs', (req, res) => {
  res.json({
    success: true,
    count: blogs.length,
    data: blogs
  });
});

// GET single blog post by ID
app.get('/api/blogs/:id', (req, res) => {
  const blog = blogs.find(b => b.id === parseInt(req.params.id));
  
  if (!blog) {
    return res.status(404).json({
      success: false,
      message: 'Blog post not found'
    });
  }
  
  res.json({
    success: true,
    data: blog
  });
});

// POST create new blog post
app.post('/api/blogs', (req, res) => {
  const { title, content, author } = req.body;
  
  if (!title || !content || !author) {
    return res.status(400).json({
      success: false,
      message: 'Please provide title, content, and author'
    });
  }
  
  const newBlog = {
    id: nextId++,
    title,
    content,
    author,
    createdAt: new Date().toISOString()
  };
  
  blogs.push(newBlog);
  
  res.status(201).json({
    success: true,
    message: 'Blog post created successfully',
    data: newBlog
  });
});

// PUT update blog post
app.put('/api/blogs/:id', (req, res) => {
  const blogIndex = blogs.findIndex(b => b.id === parseInt(req.params.id));
  
  if (blogIndex === -1) {
    return res.status(404).json({
      success: false,
      message: 'Blog post not found'
    });
  }
  
  const { title, content, author } = req.body;
  
  blogs[blogIndex] = {
    ...blogs[blogIndex],
    title: title || blogs[blogIndex].title,
    content: content || blogs[blogIndex].content,
    author: author || blogs[blogIndex].author,
    updatedAt: new Date().toISOString()
  };
  
  res.json({
    success: true,
    message: 'Blog post updated successfully',
    data: blogs[blogIndex]
  });
});

// DELETE blog post
app.delete('/api/blogs/:id', (req, res) => {
  const blogIndex = blogs.findIndex(b => b.id === parseInt(req.params.id));
  
  if (blogIndex === -1) {
    return res.status(404).json({
      success: false,
      message: 'Blog post not found'
    });
  }
  
  const deletedBlog = blogs.splice(blogIndex, 1)[0];
  
  res.json({
    success: true,
    message: 'Blog post deleted successfully',
    data: deletedBlog
  });
});

const PORT = 3000;
app.listen(PORT, () => {
  console.log(`Blog API server running on http://localhost:${PORT}`);
  console.log('\nAvailable endpoints:');
  console.log('GET    /api/blogs       - Get all blog posts');
  console.log('GET    /api/blogs/:id   - Get single blog post');
  console.log('POST   /api/blogs       - Create new blog post');
  console.log('PUT    /api/blogs/:id   - Update blog post');
  console.log('DELETE /api/blogs/:id   - Delete blog post');
});
