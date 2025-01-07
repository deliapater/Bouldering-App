const state = () => ({
    techniques: [],
    links: {},
    loading: false,
    selectedTechnique: null,
    detailsVisible: false,
});

const mutations = {
    SET_TECHNIQUES(state, techniques) {
        state.techniques = techniques;
    },
    SET_LINKS(state, links) {
        state.links = links;
    },
    SET_LOADING(state, loading) {
        state.loading = loading;
    },
    SET_SELECTED_TECHNIQUE(state, technique) {
        state.selectedTechnique = technique;
    },
    SET_DETAILS_VISIBLE(state, visible) {
        state.detailsVisible = visible;
    },
};

const actions = {
    async fetchTechniques({ commit }, url = '/api/techniques') {
        commit('SET_LOADING', true);
        try {
            const response = await fetch(url);
            const data = await response.json();
            commit('SET_TECHNIQUES', data.data);
            commit('SET_LINKS', data.links);
        } catch (error) {
            console.error('Error fetching techniques:', error);
        } finally {
            commit('SET_LOADING', false);
        }
    },
    selectTechnique({ commit }, technique) {
        commit('SET_SELECTED_TECHNIQUE', technique);
    },
    updateDetailsVisible({ commit }, visible) {
        commit('SET_DETAILS_VISIBLE', visible);
    },
};

const getters = {
    techniques: (state) => state.techniques,
    selectedTechnique: (state) => state.selectedTechnique,
    detailsVisible: (state) => state.detailsVisible,
    links: (state) => state.links,
    loading: (state) => state.loading,
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
};