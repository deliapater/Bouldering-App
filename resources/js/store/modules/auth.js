import apiClient from "../apiClient";

export default {
    namespaced: true,
    state: {
        user: null,
        token: null,
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        },
        SET_TOKEN(state, token) {
            state.token = token;
        },
    },
    actions: {
        async login({ commit }, credentials) {
            try {
                const response = await apiClient.post("/login", credentials);
                const data = response.data;
                localStorage.setItem("auth_token", data.token);
                commit("SET_USER", data.user);
                commit("SET_TOKEN", data.user);
            } catch (error) {
                console.error("Login error:", error);
                throw error;
            }
        },
        logout({ commit }) {
            localStorage.removeItem("auth_token");
            commit("SET_USER", null);
            commit("SET_TOKEN", null);
            router.push("/login");
        },
    },
    getters: {
        isAuthenticated: (state) => !!state.token,
        currentUser: (state) => state.user,
    },
};
