// ========== CHILD COMPONENT START ==========
import React, { useState, useEffect } from 'react';
import Result from './Result';

function Student({ name, course, marks }) {
  // ========== STATE FOR EDITABLE MARKS ==========
  const [editableMarks, setEditableMarks] = useState([
    { name: 'Web Technology', mse: marks.subject1.mse, ese: marks.subject1.ese },
    { name: 'Data Structures', mse: marks.subject2.mse, ese: marks.subject2.ese },
    { name: 'Database Management', mse: marks.subject3.mse, ese: marks.subject3.ese },
    { name: 'Operating Systems', mse: marks.subject4.mse, ese: marks.subject4.ese }
  ]);

  // ========== UPDATE MARKS WHEN USER SWITCHES ==========
  useEffect(() => {
    setEditableMarks([
      { name: 'Web Technology', mse: marks.subject1.mse, ese: marks.subject1.ese },
      { name: 'Data Structures', mse: marks.subject2.mse, ese: marks.subject2.ese },
      { name: 'Database Management', mse: marks.subject3.mse, ese: marks.subject3.ese },
      { name: 'Operating Systems', mse: marks.subject4.mse, ese: marks.subject4.ese }
    ]);
  }, [marks]);

  // Handle mark change
  const handleMarkChange = (index, field, value) => {
    const newMarks = [...editableMarks];
    let numValue = parseInt(value) || 0;
    
    // Validate mark limits
    if (field === 'mse' && numValue > 30) {
      alert('❌ MSE marks cannot exceed 30!');
      numValue = 30;
    }
    if (field === 'ese' && numValue > 70) {
      alert('❌ ESE marks cannot exceed 70!');
      numValue = 70;
    }
    
    newMarks[index][field] = numValue;
    setEditableMarks(newMarks);
  };

  // Save to database
  const saveMarks = () => {
    const data = {
      name: name,
      marks: editableMarks.map(subject => ({
        mse: parseInt(subject.mse) || 0,
        ese: parseInt(subject.ese) || 0
      }))
    };

    console.log('Sending data:', data); // Debug log

    fetch('http://localhost/q7/backend/update.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    })
    .then(res => {
      console.log('Response status:', res.status); // Debug log
      return res.json();
    })
    .then(data => {
      console.log('Response data:', data); // Debug log
      if (data.success) {
        alert('✅ Marks updated successfully!');
        // Reload the page to fetch fresh data from database
        window.location.reload();
      } else {
        alert('❌ Failed to update marks: ' + (data.message || 'Unknown error'));
      }
    })
    .catch(err => {
      console.error('Fetch error:', err); // Debug log
      alert('❌ Error: Make sure XAMPP is running and q7 folder is in htdocs!\n\nDetails: ' + err.message);
    });
  };

  return (
    <div className="student-card">
      <div className="student-info">
        <h2>{name}</h2>
        <p className="course">{course}</p>
      </div>

      <table className="marks-table">
        <thead>
          <tr>
            <th>Subject</th>
            <th>MSE (30)</th>
            <th>ESE (70)</th>
            <th>Total (100)</th>
            <th>Grade</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          {editableMarks.map((subject, index) => {
            const total = subject.mse + subject.ese;
            const status = total >= 40 ? 'PASS' : 'FAIL';
            
            // Calculate grade based on total marks
            let grade = '';
            if (total >= 90) grade = 'A+';
            else if (total >= 80) grade = 'A';
            else if (total >= 70) grade = 'B+';
            else if (total >= 60) grade = 'B';
            else if (total >= 50) grade = 'C+';
            else if (total >= 40) grade = 'C';
            else if (total >= 35) grade = 'D';
            else grade = 'F';
            
            return (
              <tr key={index}>
                <td>{subject.name}</td>
                <td>
                  <input 
                    type="number" 
                    value={subject.mse}
                    onChange={(e) => handleMarkChange(index, 'mse', e.target.value)}
                    min="0" 
                    max="30"
                    className="mark-input"
                  />
                </td>
                <td>
                  <input 
                    type="number" 
                    value={subject.ese}
                    onChange={(e) => handleMarkChange(index, 'ese', e.target.value)}
                    min="0" 
                    max="70"
                    className="mark-input"
                  />
                </td>
                <td><strong>{total}</strong></td>
                <td><strong className={`grade-${grade.replace('+', 'plus')}`}>{grade}</strong></td>
                <td>
                  <span className={`status ${status.toLowerCase()}`}>
                    {status}
                  </span>
                </td>
              </tr>
            );
          })}
        </tbody>
      </table>

      <button onClick={saveMarks} className="save-btn">
        💾 Save Marks to Database
      </button>

      {/* Pass marks to Result component */}
      <Result marks={editableMarks} />
    </div>
  );
}

export default Student;
// ========== CHILD COMPONENT END ==========
