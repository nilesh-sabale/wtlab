export const ADD_NOTIFICATION = 'ADD_NOTIFICATION';
export const REMOVE_NOTIFICATION = 'REMOVE_NOTIFICATION';

export const addNotification = (message, type = 'info') => ({
  type: ADD_NOTIFICATION,
  payload: {
    id: Date.now(),
    message,
    type,
    timestamp: new Date().toLocaleTimeString()
  }
});

export const removeNotification = (id) => ({
  type: REMOVE_NOTIFICATION,
  payload: id
});
