# Q16 - Currency Converter (ReactJS)

## Problem Statement
Develop a currency converter application using ReactJS that allows users to input an amount of dollars and convert it to rupees. Take advantage of React state and event handlers to manage the input and conversion calculations.

## Features
- Input field for dollar amount
- Real-time conversion to Indian Rupees
- Uses React useState hook for state management
- Event handlers for input changes
- Displays exchange rate
- Input validation (numbers only)

## How to Run

1. **Open in Browser**
   ```
   Simply open index.html in any web browser
   ```
   
   Or if using a local server:
   ```
   http://localhost/q16/index.html
   ```

2. **Usage**
   - Enter amount in dollars
   - See instant conversion to rupees
   - Exchange rate: 1 USD = 83.50 INR

## Technologies Used
- ReactJS 18
- React Hooks (useState)
- Babel (for JSX transformation)
- HTML5
- CSS3

## React Concepts Demonstrated
- **State Management**: Using `useState` hook to manage dollar input
- **Event Handlers**: `onChange` handler for input field
- **Controlled Components**: Input value controlled by React state
- **Real-time Updates**: Conversion happens instantly as user types
- **Conditional Rendering**: Shows 0.00 when input is empty

## Code Structure
- Single HTML file with embedded React
- Uses CDN for React libraries
- Babel standalone for JSX compilation
- No build process required

## Exchange Rate
- Fixed rate: 1 USD = 83.50 INR
- Can be easily modified in the code

## File
- `index.html` - Complete application (HTML + CSS + React)
