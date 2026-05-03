const mongoose = require("mongoose");
const { v4: uuidv4 } = require("uuid");

const studentSchema = new mongoose.Schema({
  studentId: {
    type: String,
    default: uuidv4,
  },
  name: {
    type: String,
    required: true,
  },
  email: {
    type: String,
    required: true,
    unique: true,
  },
  course: {
    type: String,
    required: true,
  },
});

module.exports = mongoose.model("Student", studentSchema);