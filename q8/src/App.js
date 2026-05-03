import React, { useState, useRef, useEffect } from 'react';

function App() {
  const [formData, setFormData] = useState({
    studentName: '',
    subject: '',
    rating: '',
    feedback: '',
    email: ''
  });
  
  const [errors, setErrors] = useState({});
  const [feedbackList, setFeedbackList] = useState([]);
  const [editingId, setEditingId] = useState(null);
  const [showSuccess, setShowSuccess] = useState(false);
  const feedbackInputRef = useRef(null);

  // Load feedbacks from localStorage on mount
  useEffect(() => {
    const saved = localStorage.getItem('feedbacks');
    if (saved) {
      setFeedbackList(JSON.parse(saved));
    }
  }, []);

  // Save feedbacks to localStorage whenever they change
  useEffect(() => {
    if (feedbackList.length > 0) {
      localStorage.setItem('feedbacks', JSON.stringify(feedbackList));
    }
  }, [feedbackList]);

  const subjects = [
    { value: 'DT', label: 'Design Thinking' },
    { value: 'EDI', label: 'Entrepreneurship Development & IPR' },
    { value: 'DAA', label: 'Design & Analysis of Algorithms' },
    { value: 'SDAM', label: 'Software Design & Architecture Modeling' },
    { value: 'WT', label: 'Web Technology' },
    { value: 'SPECIAL', label: 'Extra/Special/Guest Session' }
  ];

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
    
    if (errors[name]) {
      setErrors(prev => ({
        ...prev,
        [name]: ''
      }));
    }
  };

  const validate = () => {
    const newErrors = {};
    
    if (!formData.studentName.trim()) {
      newErrors.studentName = 'Student name is required';
    }
    
    if (formData.email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
      newErrors.email = 'Please enter a valid email';
    }
    
    if (!formData.subject) {
      newErrors.subject = 'Please select a subject';
    }
    
    if (!formData.rating) {
      newErrors.rating = 'Please select a rating';
    }
    
    if (!formData.feedback.trim()) {
      newErrors.feedback = 'Feedback is required';
    } else if (formData.feedback.trim().length < 10) {
      newErrors.feedback = 'Feedback must be at least 10 characters';
    }
    
    return newErrors;
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    
    const newErrors = validate();
    
    if (Object.keys(newErrors).length > 0) {
      setErrors(newErrors);
      return;
    }
    
    if (editingId) {
      // Update existing feedback (disabled)
      return;
    } else {
      // Add new feedback
      const newFeedback = {
        id: Date.now(),
        ...formData,
        submittedAt: new Date().toLocaleString()
      };
      setFeedbackList(prev => [newFeedback, ...prev]);
    }
    
    setFormData({
      studentName: '',
      subject: '',
      rating: '',
      feedback: '',
      email: ''
    });
    
    setErrors({});
    setShowSuccess(true);
    setTimeout(() => setShowSuccess(false), 3000);
    
    feedbackInputRef.current.focus();
  };

  const handleDelete = (id) => {
    if (window.confirm('Are you sure you want to delete this feedback?')) {
      setFeedbackList(prev => prev.filter(item => item.id !== id));
    }
  };

  // const handleEdit = (feedback) => {
  //   setFormData({
  //     studentName: feedback.studentName,
  //     subject: feedback.subject,
  //     rating: feedback.rating,
  //     feedback: feedback.feedback,
  //     email: feedback.email || ''
  //   });
  //   setEditingId(feedback.id);
  //   window.scrollTo({ top: 0, behavior: 'smooth' });
  // };

  // const cancelEdit = () => {
  //   setFormData({
  //     studentName: '',
  //     subject: '',
  //     rating: '',
  //     feedback: '',
  //     email: ''
  //   });
  //   setEditingId(null);
  //   setErrors({});
  // };

  const clearAllFeedbacks = () => {
    if (window.confirm('Are you sure you want to delete all feedbacks? This cannot be undone.')) {
      setFeedbackList([]);
      localStorage.removeItem('feedbacks');
    }
  };

  return (
    <div className="container">
      <h1>📝 Student Feedback Form</h1>
      
      {showSuccess && (
        <div className="success-message">
          ✅ Feedback submitted successfully!
        </div>
      )}
      
      <form onSubmit={handleSubmit} className="feedback-form">
        {/* {editingId && (
          <div className="edit-banner">
            ✏️ Editing Feedback
            <button type="button" onClick={cancelEdit} className="cancel-edit-btn">Cancel</button>
          </div>
        )} */}

        <div className="form-row">
          <div className="form-group">
            <label htmlFor="studentName">Student Name *</label>
            <input
              type="text"
              id="studentName"
              name="studentName"
              value={formData.studentName}
              onChange={handleChange}
              className={errors.studentName ? 'error' : ''}
              placeholder="Enter your name"
            />
            {errors.studentName && <span className="error-msg">{errors.studentName}</span>}
          </div>

          <div className="form-group">
            <label htmlFor="email">Email (Optional)</label>
            <input
              type="email"
              id="email"
              name="email"
              value={formData.email}
              onChange={handleChange}
              className={errors.email ? 'error' : ''}
              placeholder="your.email@example.com"
            />
            {errors.email && <span className="error-msg">{errors.email}</span>}
          </div>
        </div>

        <div className="form-group">
          <label htmlFor="subject">Subject *</label>
          <select
            id="subject"
            name="subject"
            value={formData.subject}
            onChange={handleChange}
            className={errors.subject ? 'error' : ''}
          >
            <option value="">-- Select Subject --</option>
            {subjects.map(sub => (
              <option key={sub.value} value={sub.value}>
                {sub.label}
              </option>
            ))}
          </select>
          {errors.subject && <span className="error-msg">{errors.subject}</span>}
        </div>

        <div className="form-group">
          <label>Rating *</label>
          <div className="rating-group">
            {[1, 2, 3, 4, 5].map(num => (
              <label key={num} className="radio-label">
                <input
                  type="radio"
                  name="rating"
                  value={num}
                  checked={formData.rating === String(num)}
                  onChange={handleChange}
                />
                {num} {'⭐'.repeat(num)}
              </label>
            ))}
          </div>
          {errors.rating && <span className="error-msg">{errors.rating}</span>}
        </div>

        <div className="form-group">
          <label htmlFor="feedback">Feedback *</label>
          <textarea
            id="feedback"
            name="feedback"
            ref={feedbackInputRef}
            value={formData.feedback}
            onChange={handleChange}
            className={errors.feedback ? 'error' : ''}
            placeholder="Share your feedback (minimum 10 characters)"
            rows="4"
          />
          <div className="char-count">{formData.feedback.length} characters</div>
          {errors.feedback && <span className="error-msg">{errors.feedback}</span>}
        </div>

        <button type="submit" className="submit-btn">
           Submit Feedback
        </button>
      </form>

      {feedbackList.length > 0 && (
        <div className="feedback-list">
          <div className="list-header">
            <h2>📋 Submitted Feedbacks ({feedbackList.length})</h2>
            <div className="action-buttons">
              <button onClick={clearAllFeedbacks} className="action-btn clear-btn">
                🗑️ Clear All
              </button>
            </div>
          </div>

          {feedbackList.map(item => (
            <div key={item.id} className="feedback-card">
              <div className="feedback-header">
                <div>
                  <h3>{item.studentName}</h3>
                  {item.email && <p className="email-text">📧 {item.email}</p>}
                  <p className="subject-badge">{subjects.find(s => s.value === item.subject)?.label}</p>
                </div>
                <div className="rating-display">
                  {'⭐'.repeat(Number(item.rating))} ({item.rating}/5)
                </div>
              </div>
              <p className="feedback-text">{item.feedback}</p>
              <div className="feedback-footer">
                <div>
                  <span className="timestamp">📅 {item.submittedAt}</span>
                  {item.editedAt && <span className="edited-badge">✏️ Edited</span>}
                </div>
                <div className="button-group">
                  {/* <button onClick={() => handleEdit(item)} className="edit-btn">✏️ Edit</button> */}
                  {/* <button onClick={() => handleDelete(item.id)} className="delete-btn">🗑️ Delete</button> */}
                </div>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}

export default App;