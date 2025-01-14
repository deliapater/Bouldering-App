const state = {
    snackbar: {
        message: "",
        color: "",
        visible: false,
    },
};

const mutations = {
    SHOW_SNACKBAR(state, { message, color }) {
        state.snackbar = { message, color, visible: true };
    },
    HIDE_SNACKBAR(state) {
        state.snackbar.visible = false;
    },
};

const actions = {
    show({ commit }, payload) {
        commit("SHOW_SNACKBAR", payload);
        setTimeout(() => {
            commit("HIDE_SNACKBAR");
        }, 3000);
    },
};

const getters = {
    snackbar: (state) => state.snackbar,
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}