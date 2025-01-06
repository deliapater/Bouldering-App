import { createStore } from 'vuex';

export const createMockStore = () =>
  createStore({
    modules: {
      techniques: {
        namespaced: true,
        state: {
          techniques: [],
          loading: true,
        },
        getters: {
          techniques: (state) => state.techniques,
          loading: (state) => state.loading,
        },
        actions: {
          async fetchTechniques({ commit }) {
            setTimeout(() => {
              commit('setTechniques', [
                {
                  id: 1,
                  name: 'Technique 1',
                  description: 'A great technique.',
                  image: 'crimp.jpg',
                },
                {
                  id: 2,
                  name: 'Technique 2',
                  description: 'An advanced technique.',
                  image: 'mantle.jpg',
                },
              ]);
              commit('setLoading', false);
            }, 2000);
          },
        },
        mutations: {
          setTechniques(state, techniques) {
            state.techniques = techniques;
          },
          setLoading(state, loading) {
            state.loading = loading;
          },
        },
      },
    },
  });
