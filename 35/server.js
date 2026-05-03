const express = require('express');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(express.json());
app.use(express.static('public'));

// In-memory storage for tasks
let tasks = [
  {
    id: 1,
    title: 'Complete project documentation',
    description: 'Write comprehensive documentation for the project',
    status: 'pending',
    createdAt: new Date().toISOString()
  },
  {
    id: 2,
    title: 'Review pull requests',
    description: 'Review and merge pending pull requests',
    status: 'pending',
    createdAt: new Date().toISOString()
  }
];

let nextId = 3;

// GET all tasks
app.get('/api/tasks', (req, res) => {
  res.json({
    success: true,
    count: tasks.length,
    data: tasks
  });
});

// GET single task by ID
app.get('/api/tasks/:id', (req, res) => {
  const task = tasks.find(t => t.id === parseInt(req.params.id));
  
  if (!task) {
    return res.status(404).json({
      success: false,
      message: 'Task not found'
    });
  }
  
  res.json({
    success: true,
    data: task
  });
});

// POST create new task
app.post('/api/tasks', (req, res) => {
  const { title, description } = req.body;
  
  if (!title) {
    return res.status(400).json({
      success: false,
      message: 'Please provide task title'
    });
  }
  
  const newTask = {
    id: nextId++,
    title,
    description: description || '',
    status: 'pending',
    createdAt: new Date().toISOString()
  };
  
  tasks.push(newTask);
  
  res.status(201).json({
    success: true,
    message: 'Task created successfully',
    data: newTask
  });
});

// PUT update task status
app.put('/api/tasks/:id', (req, res) => {
  const taskIndex = tasks.findIndex(t => t.id === parseInt(req.params.id));
  
  if (taskIndex === -1) {
    return res.status(404).json({
      success: false,
      message: 'Task not found'
    });
  }
  
  const { status, title, description } = req.body;
  
  if (status && status !== 'pending' && status !== 'completed') {
    return res.status(400).json({
      success: false,
      message: 'Status must be either "pending" or "completed"'
    });
  }
  
  tasks[taskIndex] = {
    ...tasks[taskIndex],
    title: title || tasks[taskIndex].title,
    description: description !== undefined ? description : tasks[taskIndex].description,
    status: status || tasks[taskIndex].status,
    updatedAt: new Date().toISOString()
  };
  
  res.json({
    success: true,
    message: 'Task updated successfully',
    data: tasks[taskIndex]
  });
});

// PATCH update only task status
app.patch('/api/tasks/:id/status', (req, res) => {
  const taskIndex = tasks.findIndex(t => t.id === parseInt(req.params.id));
  
  if (taskIndex === -1) {
    return res.status(404).json({
      success: false,
      message: 'Task not found'
    });
  }
  
  const { status } = req.body;
  
  if (!status || (status !== 'pending' && status !== 'completed')) {
    return res.status(400).json({
      success: false,
      message: 'Status must be either "pending" or "completed"'
    });
  }
  
  // If marking as completed, delete the task
  if (status === 'completed') {
    const completedTask = tasks.splice(taskIndex, 1)[0];
    return res.json({
      success: true,
      message: 'Task completed and removed from list',
      data: completedTask
    });
  }
  
  // Otherwise just update status
  tasks[taskIndex].status = status;
  tasks[taskIndex].updatedAt = new Date().toISOString();
  
  res.json({
    success: true,
    message: `Task marked as ${status}`,
    data: tasks[taskIndex]
  });
});

// DELETE task
app.delete('/api/tasks/:id', (req, res) => {
  const taskIndex = tasks.findIndex(t => t.id === parseInt(req.params.id));
  
  if (taskIndex === -1) {
    return res.status(404).json({
      success: false,
      message: 'Task not found'
    });
  }
  
  const deletedTask = tasks.splice(taskIndex, 1)[0];
  
  res.json({
    success: true,
    message: 'Task deleted successfully',
    data: deletedTask
  });
});

// GET tasks by status
app.get('/api/tasks/status/:status', (req, res) => {
  const { status } = req.params;
  
  if (status !== 'pending' && status !== 'completed') {
    return res.status(400).json({
      success: false,
      message: 'Status must be either "pending" or "completed"'
    });
  }
  
  const filteredTasks = tasks.filter(t => t.status === status);
  
  res.json({
    success: true,
    count: filteredTasks.length,
    data: filteredTasks
  });
});

const PORT = 3000;
app.listen(PORT, () => {
  console.log(`Task Manager API running on http://localhost:${PORT}`);
  console.log('\nAvailable endpoints:');
  console.log('GET    /api/tasks              - Get all tasks');
  console.log('GET    /api/tasks/:id          - Get single task');
  console.log('GET    /api/tasks/status/:status - Get tasks by status');
  console.log('POST   /api/tasks              - Create new task');
  console.log('PUT    /api/tasks/:id          - Update task');
  console.log('PATCH  /api/tasks/:id/status   - Update task status only');
  console.log('DELETE /api/tasks/:id          - Delete task');
});
