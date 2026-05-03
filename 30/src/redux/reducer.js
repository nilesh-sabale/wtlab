import { FILTER_BY_CATEGORY, FILTER_BY_PRICE, RESET_FILTERS } from './actions';

const initialProducts = [
  { id: 1, name: 'Laptop', category: 'Electronics', price: 999 },
  { id: 2, name: 'Phone', category: 'Electronics', price: 699 },
  { id: 3, name: 'Shirt', category: 'Clothing', price: 29 },
  { id: 4, name: 'Jeans', category: 'Clothing', price: 49 },
  { id: 5, name: 'Watch', category: 'Accessories', price: 199 },
  { id: 6, name: 'Headphones', category: 'Electronics', price: 149 },
  { id: 7, name: 'Shoes', category: 'Clothing', price: 79 },
  { id: 8, name: 'Bag', category: 'Accessories', price: 89 }
];

const initialState = {
  allProducts: initialProducts,
  filteredProducts: initialProducts,
  selectedCategory: 'All',
  priceRange: { min: 0, max: 1000 }
};

const productReducer = (state = initialState, action) => {
  switch (action.type) {
    case FILTER_BY_CATEGORY:
      const category = action.payload;
      let filtered = state.allProducts;
      
      if (category !== 'All') {
        filtered = filtered.filter(p => p.category === category);
      }
      
      filtered = filtered.filter(p => 
        p.price >= state.priceRange.min && p.price <= state.priceRange.max
      );
      
      return {
        ...state,
        selectedCategory: category,
        filteredProducts: filtered
      };

    case FILTER_BY_PRICE:
      const { minPrice, maxPrice } = action.payload;
      let priceFiltered = state.allProducts;
      
      if (state.selectedCategory !== 'All') {
        priceFiltered = priceFiltered.filter(p => p.category === state.selectedCategory);
      }
      
      priceFiltered = priceFiltered.filter(p => 
        p.price >= minPrice && p.price <= maxPrice
      );
      
      return {
        ...state,
        priceRange: { min: minPrice, max: maxPrice },
        filteredProducts: priceFiltered
      };

    case RESET_FILTERS:
      return {
        ...state,
        filteredProducts: state.allProducts,
        selectedCategory: 'All',
        priceRange: { min: 0, max: 1000 }
      };

    default:
      return state;
  }
};

export default productReducer;
