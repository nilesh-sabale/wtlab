// ========== PARENT COMPONENT START ==========
import React, { useState, useEffect } from 'react';
import Student from './Student';
import './App.css';

function App() {
  // ========== STATE MANAGEMENT USING useState() ==========
  const [studentData, setStudentData] = useState(null);
  const [studentId, setStudentId] = useState(1);
  const [allStudents, setAllStudents] = useState([]);
  const [showAddForm, setShowAddForm] = useState(false);
  const [newStudent, setNewStudent] = useState({
    name: '',
    prn: '',
    semester: '5'
  });

  // Fetch all students for dropdown
  useEffect(() => {
    fetch('http://localhost/q7/backend/get_all_students.php')
      .then(res => res.json())
      .then(data => {
        if (data.students) {
          setAllStudents(data.students);
          if (data.students.length > 0 && !studentId) {
            setStudentId(data.students[0].id);
          }
        }
      })
      .catch(err => console.error('Error fetching students:', err));
  }, []);

  // Fetch student data from PHP backend
  useEffect(() => {
    if (studentId) {
      fetch(`http://localhost/q7/backend/api.php?id=${studentId}`)
        .then(res => res.json())
        .then(data => setStudentData(data))
        .catch(err => console.error('Error:', err));
    }
  }, [studentId]);

  // Handle new student form submission
  const handleAddStudent = (e) => {
    e.preventDefault();
    
    fetch('http://localhost/q7/backend/add_student.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(newStudent)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('✅ Student added successfully!');
        setNewStudent({ name: '', prn: '', semester: '5' });
        setShowAddForm(false);
        // Refresh students list
        window.location.reload();
      } else {
        alert('❌ Failed to add student: ' + data.message);
      }
    })
    .catch(err => {
      console.error('Error:', err);
      alert('❌ Error adding student!');
    });
  };

  if (!studentData) {
    return <div className="loading">Loading...</div>;
  }

  // ========== PASSING DATA TO CHILD USING PROPS ==========
  return (
    <div className="App">
      <header>
        <h1>🎓 VIT Student Result System</h1>
      </header>

      <div className="student-selector">
        <label>Select Student: </label>
        <select value={studentId} onChange={(e) => setStudentId(e.target.value)}>
          {allStudents.map(student => (
            <option key={student.id} value={student.id}>
              {student.name} - {student.prn} (Sem {student.semester})
            </option>
          ))}
        </select>
        <button onClick={() => setShowAddForm(!showAddForm)} className="add-student-btn">
          {showAddForm ? '❌ Cancel' : '➕ Add New Student'}
        </button>
      </div>

      {/* Add Student Form */}
      {showAddForm && (
        <div className="add-student-form">
          <h3>Add New Student</h3>
          <form onSubmit={handleAddStudent}>
            <div className="form-group">
              <label>Name:</label>
              <input 
                type="text" 
                value={newStudent.name}
                onChange={(e) => setNewStudent({...newStudent, name: e.target.value})}
                required
                placeholder="Enter student name"
              />
            </div>
            <div className="form-group">
              <label>PRN Number:</label>
              <input 
                type="text" 
                value={newStudent.prn}
                onChange={(e) => setNewStudent({...newStudent, prn: e.target.value})}
                required
                placeholder="Enter 8-digit PRN number"
                pattern="\d{8}"
                maxLength="8"
                title="PRN must be exactly 8 digits"
              />
            </div>
            <div className="form-group">
              <label>Department:</label>
              <input 
                type="text" 
                value="Computer"
                disabled
                className="disabled-input"
              />
            </div>
            <div className="form-group">
              <label>Semester:</label>
              <select 
                value={newStudent.semester}
                onChange={(e) => setNewStudent({...newStudent, semester: e.target.value})}
                required
              >
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
            </div>
            <button type="submit" className="submit-btn">Add Student</button>
          </form>
        </div>
      )}

      {/* Pass props to Student component */}
      {studentData && (
        <Student 
          name={studentData.name}
          course={studentData.course}
          marks={{
            subject1: { mse: studentData.subject1_mse, ese: studentData.subject1_ese },
            subject2: { mse: studentData.subject2_mse, ese: studentData.subject2_ese },
            subject3: { mse: studentData.subject3_mse, ese: studentData.subject3_ese },
            subject4: { mse: studentData.subject4_mse, ese: studentData.subject4_ese }
          }}
        />
      )}
    </div>
  );
}

export default App;
// ========== PARENT COMPONENT END ==========
