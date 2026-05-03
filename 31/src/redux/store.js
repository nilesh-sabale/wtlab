import { createStore } from 'redux';
import notificationReducer from './reducer';

const store = createStore(notificationReducer);

export default store;
