import { createStore } from 'vuex';
import techniques from './modules/techniques';


export default createStore({
    modules: {
        techniques,
    },
});