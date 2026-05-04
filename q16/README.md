# Currency Converter - React with Vite

A responsive currency converter application built with React and Vite that converts USD to INR (Indian Rupees).

## Features

✅ **Real-time Conversion** - Instant USD to INR conversion  
✅ **Input Validation** - Only accepts valid numbers  
✅ **Responsive Design** - Works on all devices  
✅ **Clear Functionality** - Easy to clear input  
✅ **Calculation Display** - Shows conversion formula  
✅ **Modern UI** - Clean and professional design  

## Technologies Used

- **React 18** - Frontend framework
- **Vite** - Build tool and dev server
- **CSS3** - Styling with gradients and animations
- **JavaScript ES6+** - Modern JavaScript features

## Prerequisites

1. **Node.js 16+** - [Download here](https://nodejs.org/)
2. **npm** or **yarn** - Package manager

## Installation & Setup

### 1. Navigate to Project
```bash
cd q16
```

### 2. Install Dependencies
```bash
npm install
```

### 3. Start Development Server
```bash
npm run dev
```

### 4. Open in Browser
The app will automatically open at: **http://localhost:5173**

## Available Scripts

| Command | Description |
|---------|-------------|
| `npm run dev` | Start development server |
| `npm run build` | Build for production |
| `npm run preview` | Preview production build |
| `npm run lint` | Run ESLint |

## Project Structure

```
q16/
├── public/
├── src/
│   ├── App.jsx          # Main component
│   ├── App.css          # Component styles
│   ├── main.jsx         # Entry point
│   └── index.css        # Global styles
├── index.html           # HTML template
├── package.json         # Dependencies
├── vite.config.js       # Vite configuration
└── README.md           # This file
```

## How It Works

### Component Structure
```jsx
function App() {
  const [dollars, setDollars] = useState('')
  const exchangeRate = 83.50
  
  // Input validation and conversion logic
  // Real-time calculation display
}
```

### Key Features Implementation

#### 1. Input Validation
```javascript
const handleChange = (e) => {
  const value = e.target.value
  if (value === '' || (!isNaN(value) && !isNaN(parseFloat(value)))) {
    setDollars(value)
  }
}
```

#### 2. Real-time Conversion
```javascript
const rupees = dollars && !isNaN(parseFloat(dollars)) 
  ? (parseFloat(dollars) * exchangeRate).toFixed(2) 
  : '0.00'
```

#### 3. Responsive Design
- Mobile-first approach
- Flexible grid layout
- Touch-friendly buttons

## Exchange Rate

**Current Rate**: 1 USD = ₹83.50 INR

To update the exchange rate, modify the `exchangeRate` variable in `src/App.jsx`:

```javascript
const exchangeRate = 83.50 // Change this value
```

## Usage Examples

### Basic Conversion
1. Enter amount in dollars (e.g., `100`)
2. See instant conversion to rupees: `₹8,350.00`
3. View calculation: `$100 × 83.50 = ₹8,350.00`

### Input Validation
- ✅ Valid: `100`, `100.50`, `0.99`
- ❌ Invalid: `abc`, `100abc`, `$100`

### Clear Function
- Click "Clear" button to reset input
- Button appears only when there's input

## Customization

### Change Currency Pair
To convert different currencies, update:

1. **Exchange Rate**:
```javascript
const exchangeRate = 74.50 // New rate
```

2. **Currency Symbols**:
```jsx
<h2>€ {euros}</h2> {/* Change ₹ to € */}
```

3. **Labels**:
```jsx
<label>Enter Amount in Euros (€)</label>
```

### Styling
- **Colors**: Modify CSS variables in `src/App.css`
- **Layout**: Adjust container width and padding
- **Fonts**: Change font-family in `src/index.css`

## React Hooks Used

### useState
```javascript
const [dollars, setDollars] = useState('')
```
- Manages input state
- Triggers re-renders on change
- Enables controlled components

## Performance Features

- **Vite HMR** - Hot Module Replacement for fast development
- **Optimized Build** - Tree-shaking and minification
- **Modern JavaScript** - ES6+ features for better performance

## Browser Support

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+

## Development Tips

### Hot Reload
Changes to code automatically refresh the browser during development.

### Debugging
Use React Developer Tools browser extension for component inspection.

### Building for Production
```bash
npm run build
```
Creates optimized build in `dist/` folder.

## Troubleshooting

### Port Already in Use
Change port in `vite.config.js`:
```javascript
export default defineConfig({
  server: {
    port: 3000 // Change from 5173
  }
})
```

### Dependencies Issues
```bash
rm -rf node_modules package-lock.json
npm install
```

### Build Errors
```bash
npm run lint
```
Check for ESLint errors and fix them.

## Future Enhancements

- [ ] Multiple currency support
- [ ] Live exchange rate API integration
- [ ] Currency history charts
- [ ] Favorite currency pairs
- [ ] Offline support with PWA

## Lab Requirements Completed

✅ **React Application** - Built with React 18  
✅ **State Management** - Uses useState hook  
✅ **Event Handlers** - Input change handling  
✅ **Input Validation** - Number validation  
✅ **Real-time Updates** - Instant conversion  
✅ **Responsive Design** - Mobile-friendly  

---

**Author**: VIT Student  
**Course**: Web Technology Lab  
**Lab**: Q16 - Currency Converter with React & Vite  
**Framework**: React 18 + Vite 5