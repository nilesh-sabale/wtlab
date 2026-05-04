import React, { useState } from 'react';
import './App.css';

function App() {
  const [theme, setTheme] = useState('light');

  const toggleTheme = () => {
    setTheme(prevTheme => prevTheme === 'light' ? 'dark' : 'light');
  };

  return (
    <div className={`app ${theme}`}>
      <div className="container">
        <h1>🌓 Theme Toggle App</h1>
        <p className="current-theme">Current Theme: <strong>{theme.toUpperCase()}</strong></p>
        
        <button onClick={toggleTheme} className="toggle-btn">
          {theme === 'light' ? '🌙 Switch to Dark Mode' : '☀️ Switch to Light Mode'}
        </button>

        <div className="content">
          <h2>Welcome!</h2>
          <p>This application demonstrates theme switching using React Hooks.</p>
          <p>Click the button above to toggle between light and dark modes.</p>
        </div>
      </div>
    </div>
  );
}

export default App;
