// ========== CHILD COMPONENT START ==========
import React, { useState, useEffect } from 'react';

function Result({ marks }) {
  // ========== STATE MANAGEMENT USING useState() ==========
  const [totalMarks, setTotalMarks] = useState(0);
  const [percentage, setPercentage] = useState(0);
  const [status, setStatus] = useState('');

  // ========== DYNAMIC UI UPDATE BASED ON STATE ==========
  useEffect(() => {
    // Calculate total marks
    const total = marks.reduce((sum, subject) => sum + subject.mse + subject.ese, 0);
    setTotalMarks(total);

    // Calculate percentage
    const percent = (total / 400) * 100;
    setPercentage(percent.toFixed(2));

    // Overall pass: total marks > 35% of 400 (which is 140)
    const overallPassed = total > 140;

    // Determine grade based on percentage
    let grade = '';
    if (percent >= 90) grade = 'A+';
    else if (percent >= 80) grade = 'A';
    else if (percent >= 70) grade = 'B+';
    else if (percent >= 60) grade = 'B';
    else if (percent >= 50) grade = 'C+';
    else if (percent >= 40) grade = 'C';
    else if (percent >= 35) grade = 'D';
    else grade = 'F';

    // Update status dynamically - only based on overall marks
    if (overallPassed) {
      setStatus('PASS');
    } else {
      setStatus('FAIL');
    }
  }, [marks]);

  return (
    <div className="result-card">
      <h3>📊 Final Result</h3>
      <div className="result-details">
        <div className="result-item">
          <span>Total Marks:</span>
          <strong>{totalMarks} / 400</strong>
        </div>
        <div className="result-item">
          <span>Percentage:</span>
          <strong>{percentage}%</strong>
        </div>
        <div className="result-item">
          <span>Overall Status:</span>
          <span className={`status-badge ${status.toLowerCase()}`}>
            {status}
          </span>
        </div>
      </div>
    </div>
  );
}

export default Result;
// ========== CHILD COMPONENT END ==========
