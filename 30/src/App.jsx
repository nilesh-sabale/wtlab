import React, { useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { filterByCategory, filterByPrice, resetFilters } from './redux/actions';
import './App.css';

function App() {
  const dispatch = useDispatch();
  const { filteredProducts, selectedCategory, priceRange } = useSelector(state => state);
  
  const [minPrice, setMinPrice] = useState(0);
  const [maxPrice, setMaxPrice] = useState(1000);

  const categories = ['All', 'Electronics', 'Clothing', 'Accessories'];

  const handleCategoryChange = (category) => {
    dispatch(filterByCategory(category));
  };

  const handlePriceFilter = () => {
    dispatch(filterByPrice(Number(minPrice), Number(maxPrice)));
  };

  const handleReset = () => {
    dispatch(resetFilters());
    setMinPrice(0);
    setMaxPrice(1000);
  };

  return (
    <div className="app">
      <div className="container">
        <h1>🛍️ Product Filter</h1>
        
        <div className="filters">
          <div className="filter-section">
            <h3>Category</h3>
            <div className="category-buttons">
              {categories.map(cat => (
                <button
                  key={cat}
                  className={selectedCategory === cat ? 'active' : ''}
                  onClick={() => handleCategoryChange(cat)}
                >
                  {cat}
                </button>
              ))}
            </div>
          </div>

          <div className="filter-section">
            <h3>Price Range</h3>
            <div className="price-inputs">
              <input
                type="number"
                placeholder="Min"
                value={minPrice}
                onChange={(e) => setMinPrice(e.target.value)}
              />
              <span>to</span>
              <input
                type="number"
                placeholder="Max"
                value={maxPrice}
                onChange={(e) => setMaxPrice(e.target.value)}
              />
              <button onClick={handlePriceFilter}>Apply</button>
            </div>
          </div>

          <button className="reset-btn" onClick={handleReset}>
            Reset Filters
          </button>
        </div>

        <div className="products">
          <h2>Products ({filteredProducts.length})</h2>
          <div className="product-grid">
            {filteredProducts.map(product => (
              <div key={product.id} className="product-card">
                <h3>{product.name}</h3>
                <p className="category">{product.category}</p>
                <p className="price">${product.price}</p>
              </div>
            ))}
          </div>
          {filteredProducts.length === 0 && (
            <p className="no-products">No products found</p>
          )}
        </div>
      </div>
    </div>
  );
}

export default App;
