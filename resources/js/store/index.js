import { createStore } from 'vuex';
import techniques from './modules/techniques';
import snackbar from './modules/snackbar';


export default createStore({
    modules: {
        techniques,
        snackbar
    },
});