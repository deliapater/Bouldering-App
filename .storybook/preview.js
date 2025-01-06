/** @type { import('@storybook/vue3').Preview } */

import { createStore } from 'vuex';
import { setup } from '@storybook/vue3';
import vuetify from '../resources/js/plugins/vuetify';
import '../resources/css/app.css';
import { Description } from '@storybook/blocks';

const mockStore = createStore({
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
              {id: 1, name: 'Technique 1', description: 'A great technique.'},
              {id: 2, name: 'Technique 2', description: 'An advanced technique.'}
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
        }
      }
    }
  }
});

setup((app) => {
  app.use(vuetify);
  app.use(mockStore);
})

const preview = {
  parameters: {
    controls: {
      matchers: {
        color: /(background|color)$/i,
        date: /Date$/i,
      },
    },
  },
  decorators: [
    (story) => ({
      components: { story },
      setup() {
        return {};
      },
      template: ` 
      <v-app>
        <v-main>
          <story />
        </v-main>
      </v-app>
      `,
    })
  ],
};

export default preview;
