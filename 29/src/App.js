import React, { useState, useEffect } from 'react';
import './App.css';

function App() {
  const [time, setTime] = useState(new Date());
  const [isRunning, setIsRunning] = useState(true);

  useEffect(() => {
    let interval;
    if (isRunning) {
      interval = setInterval(() => {
        setTime(new Date());
      }, 1000);
    }
    return () => clearInterval(interval);
  }, [isRunning]);

  const formatTime = (date) => {
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const seconds = String(date.getSeconds()).padStart(2, '0');
    return `${hours}:${minutes}:${seconds}`;
  };

  const toggleClock = () => {
    setIsRunning(!isRunning);
  };

  return (
    <div className="app">
      <div className="clock-container">
        <h1>⏰ Digital Clock</h1>
        <div className="clock-display">
          {formatTime(time)}
        </div>
        <div className="date-display">
          {time.toLocaleDateString('en-US', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
          })}
        </div>
        <button onClick={toggleClock} className="control-btn">
          {isRunning ? '⏸ Stop Clock' : '▶ Start Clock'}
        </button>
        <p className="status">
          Status: <strong>{isRunning ? 'Running' : 'Stopped'}</strong>
        </p>
      </div>
    </div>
  );
}

export default App;
