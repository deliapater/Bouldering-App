import apiClient from "../apiClient";

const state = () => ({
    techniques: [],
    links: {},
    loading: false,
    selectedTechnique: null,
    detailsVisible: false,
    formModalVisible: false,
    gearOptions: [],
});

const mutations = {
    SET_TECHNIQUES(state, techniques) {
        state.techniques = techniques;
    },
    SET_GEAR_OPTIONS(state, gearOptions) {
        state.gearOptions = gearOptions;
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
        state.gearOptions.push({ ...gear, id: Date.now() });
    },
};

const actions = {
    async fetchTechniques({ commit }, url = "/api/techniques") {
        const token = localStorage.getItem("auth_token");
        console.log("Token:", token);
        commit("SET_LOADING", true);
        try {
            const response = await fetch(url, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${token}`,
                },
            });

            if (!response.ok) {
                throw new Error("Error fetching techniques");
            }

            const data = await response.json();
            commit("SET_TECHNIQUES", data.data);

            const gearOptions = [];
            const gearMap = new Map();

            data.data.forEach((technique) => {
                technique.gear.forEach((gear) => {
                    if (!gearMap.has(gear.id)) {
                        gearMap.set(gear.id, gear);
                        gearOptions.push(gear);
                    }
                });
            });
            commit("SET_GEAR_OPTIONS", gearOptions);
            commit("SET_LINKS", data.links);
        } catch (error) {
            console.error("Error fetching techniques:", error);
        } finally {
            commit("SET_LOADING", false);
        }
    },
    selectTechnique({ commit }, technique) {
        commit("SET_SELECTED_TECHNIQUE", technique);
    },
    updateDetailsVisible({ commit }, visible) {
        commit("SET_DETAILS_VISIBLE", visible);
    },
    openFormModal({ commit }, technique = null) {
        commit("SET_SELECTED_TECHNIQUE", technique);
        commit("TOGGLE_FORM_MODAL", true);
    },
    closeFormModal({ commit }) {
        commit("TOGGLE_FORM_MODAL", false);
        commit("SET_SELECTED_TECHNIQUE", null);
    },
    saveTechnique: async ({ commit, state, dispatch }, technique) => {
        if (!technique) {
            console.error("Technique object is missing!");
            return;
        }
        console.log("Technique payload:", technique);
        const isEditing = !!technique.id;
        const endpoint = isEditing
            ? `/techniques/${technique.id}`
            : `/techniques`;
        const method = isEditing ? "PUT" : "POST";
        try {
            const response = await apiClient({
                method,
                url: endpoint,
                data: technique,
            });

            const data = response.data;

            if (isEditing) {
                // Update the existing technique in the state
                const index = state.techniques.findIndex(
                    (t) => t.id === technique.id
                );
                if (index > -1) state.techniques.splice(index, 1, data);
            } else {
                state.techniques.push(data);
            }

            commit("TOGGLE_FORM_MODAL", false);

            dispatch(
                "snackbar/show",
                {
                    message: "Technique saved successfully!",
                    color: "success",
                },
                { root: true }
            );
        } catch (error) {
            console.error("An error occurred while saving technique:", error);

            const errorMessage = error.response?.data?.message || "An error occurred. Please try again later.";

            dispatch(
                "snackbar/show",
                {
                    message: errorMessage,
                    color: "error",
                },
                { root: true }
            );
        }
    },

    addGear({ commit }, gear) {
        commit("ADD_GEAR_OPTION", gear);
    },
};

const getters = {
    techniques: (state) => state.techniques,
    selectedTechnique: (state) => state.selectedTechnique,
    detailsVisible: (state) => state.detailsVisible,
    links: (state) => state.links,
    loading: (state) => state.loading,
    gearOptions: (state) => state.gearOptions,
    formModalVisible: (state) => state.formModalVisible,
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
};
