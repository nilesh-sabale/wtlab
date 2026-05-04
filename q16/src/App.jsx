import { useState } from 'react'
import './App.css'

function App() {
  const [dollars, setDollars] = useState('')
  const exchangeRate = 83.50

  const handleChange = (e) => {
    const value = e.target.value
    if (value === '' || (!isNaN(value) && !isNaN(parseFloat(value)))) {
      setDollars(value)
    }
  }

  const rupees = dollars && !isNaN(parseFloat(dollars)) 
    ? (parseFloat(dollars) * exchangeRate).toFixed(2) 
    : '0.00'

  return (
    <div className="app">
      <div className="card">
        <div className="header">
          <h1>Currency Converter</h1>
          <p>USD to INR</p>
        </div>
        
        <div className="converter">
          <div className="input-section">
            <label>USD</label>
            <input 
              type="text" 
              value={dollars}
              onChange={handleChange}
              placeholder="0.00"
            />
            <span className="currency">$</span>
          </div>
          
          <div className="arrow">↓</div>
          
          <div className="output-section">
            <label>INR</label>
            <div className="result">
              <span className="amount">{rupees}</span>
              <span className="currency">₹</span>
            </div>
          </div>
        </div>
        
        <div className="rate">
          1 USD = {exchangeRate} INR
        </div>
      </div>
    </div>
  )
}

export default App