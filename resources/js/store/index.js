import { createStore } from 'vuex';
import techniques from './modules/techniques';
import snackbar from './modules/snackbar';
import auth from './modules/auth';


export default createStore({
    modules: {
        techniques,
        snackbar,
        auth
    },
});