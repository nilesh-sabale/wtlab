export const FILTER_BY_CATEGORY = 'FILTER_BY_CATEGORY';
export const FILTER_BY_PRICE = 'FILTER_BY_PRICE';
export const RESET_FILTERS = 'RESET_FILTERS';

export const filterByCategory = (category) => ({
  type: FILTER_BY_CATEGORY,
  payload: category
});

export const filterByPrice = (minPrice, maxPrice) => ({
  type: FILTER_BY_PRICE,
  payload: { minPrice, maxPrice }
});

export const resetFilters = () => ({
  type: RESET_FILTERS
});
