import React, { useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { addNotification, removeNotification } from './redux/actions';
import './App.css';

function App() {
  const dispatch = useDispatch();
  const notifications = useSelector(state => state.notifications);
  const [message, setMessage] = useState('');
  const [type, setType] = useState('info');

  const handleAddNotification = (e) => {
    e.preventDefault();
    if (message.trim()) {
      dispatch(addNotification(message, type));
      setMessage('');
    }
  };

  const handleRemove = (id) => {
    dispatch(removeNotification(id));
  };

  return (
    <div className="app">
      <div className="container">
        <h1>🔔 Notification System</h1>
        
        <form onSubmit={handleAddNotification} className="notification-form">
          <input
            type="text"
            placeholder="Enter notification message..."
            value={message}
            onChange={(e) => setMessage(e.target.value)}
            className="message-input"
          />
          
          <div className="form-controls">
            <select value={type} onChange={(e) => setType(e.target.value)} className="type-select">
              <option value="info">Info</option>
              <option value="success">Success</option>
              <option value="warning">Warning</option>
              <option value="error">Error</option>
            </select>
            
            <button type="submit" className="add-btn">Add Notification</button>
          </div>
        </form>

        <div className="notifications-section">
          <h2>Notifications ({notifications.length})</h2>
          
          {notifications.length === 0 ? (
            <p className="no-notifications">No notifications yet</p>
          ) : (
            <div className="notifications-list">
              {notifications.map(notification => (
                <div key={notification.id} className={`notification ${notification.type}`}>
                  <div className="notification-content">
                    <span className="notification-icon">
                      {notification.type === 'info' && 'ℹ️'}
                      {notification.type === 'success' && '✅'}
                      {notification.type === 'warning' && '⚠️'}
                      {notification.type === 'error' && '❌'}
                    </span>
                    <div className="notification-text">
                      <p className="notification-message">{notification.message}</p>
                      <span className="notification-time">{notification.timestamp}</span>
                    </div>
                  </div>
                  <button 
                    onClick={() => handleRemove(notification.id)} 
                    className="dismiss-btn"
                  >
                    ✕
                  </button>
                </div>
              ))}
            </div>
          )}
        </div>
      </div>
    </div>
  );
}

export default App;
