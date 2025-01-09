const state = () => ({
    techniques: [],
    links: {},
    loading: false,
    selectedTechnique: null,
    detailsVisible: false,
    formModalVisible: false,
    gearOptions: []
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
    TOGGLE_FORM_MODAL(state, isVisible) {
        state.formModalVisible = isVisible;
    },
    ADD_GEAR_OPTION(state, gear) {
        state.gearOptions.push({...gear, id: Date.now() });
    }
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
    openFormModal({ commit }, technique = null) {
        commit('SET_SELECTED_TECHNIQUE', technique);
        commit('TOGGLE_FORM_MODAL', true)
    },
    closeFormModal({ commit }) {
        commit('TOGGLE_FORM_MODAL', false);
        commit('SET_SELECTED_TECHNIQUE', null);
    },
    saveTechnique({ commit }, technique = null) {
        const isEditing = !!technique.id;
        if (isEditing) {
            const index = state.techniques.findIndex((t) => t.id === technique.id);
            if (index > -1) state.techniques.splice(index, 1, technique);
        } else {
            technique.id = Date.now();
            state.techniques.push(technique);
        }
        commit('TOGGLE_FORM_MODAL', false);
    },
    addGear({ commit }, gear) {
        commit('ADD_GEAR_OPTION', gear);
    }
};

const getters = {
    techniques: (state) => state.techniques,
    selectedTechnique: (state) => state.selectedTechnique,
    detailsVisible: (state) => state.detailsVisible,
    links: (state) => state.links,
    loading: (state) => state.loading,
    gearOptions: (state) => state.gearOptions,
    formModalVisible: (state) => state.formModalVisible
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
};